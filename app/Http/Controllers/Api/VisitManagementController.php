<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use App\Models\VisitFollowUp;
use App\Models\VisitManagement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class VisitManagementController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_name' => 'required|string|max:255',
            'site_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'site_latitude' => 'nullable|numeric',
            'site_longitude' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'company_owner_name' => 'nullable|string|max:255',
            'company_office_address' => 'nullable|string|max:255',
            'company_mobile_number' => 'nullable|string|max:15',
            'company_gst' => 'nullable|string|max:15|regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[A-Z0-9]{3}$/',
            'purchaser_name' => 'nullable|string|max:255',
            'purchaser_mobile_number' => 'nullable|string|max:15',
            'supervisor_name' => 'nullable|string|max:255',
            'supervisor_mobile_number' => 'nullable|string|max:15',
            'requirements' => 'nullable|string|max:500',
            'remark' => 'nullable|string|max:500',
            'present_brand' => 'nullable|string|max:255',
            'follow_up_date' => 'nullable|date',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(1, config('error-codes.validation_error.message'), config('error-codes.validation_error.code'), $validator->errors());
        }
        $data = $validator->validated();
        $data['employee_id'] = auth()->user()->id;

        if ($request->hasFile('site_image')) {
            $image = $request->file('site_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('site_images', $imageName, 'public');  // saves to storage/app/public/site_images
            $data['site_image'] = $imagePath;
        }

        $visit = VisitManagement::create($data);

        return $this->apiResponse(0, config('error-codes.visit_create.message'), config('error-codes.visit_create.code'));
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = VisitManagement::with('user')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function ($data) {
                    return $data->user?->name ?? '-';
                })
                ->addColumn('action', function ($data) {
                    $return = '<div class="btn-group">';
                    // if (auth()->user()->can('')) {
                    //     $return .= '<a href="' .  '" class="btn btn-sm btn-icon btn-light btn-active-light-primary">
                    //                     <i class="ki-outline ki-pencil fs-3"></i>
                    //                 </a> &nbsp;';
                    // }
                    if (auth()->user()->can('visit view')) {
                        $return .= '<a href="' . route('visit.show', ['visit' => base64_encode($data->id)]) . '" class="btn btn-sm btn-icon btn-light btn-active-light-primary mx-2">
                                    <i class="ki-solid ki-eye fs-3"></i>
                                </a>';
                    }
                    if (auth()->user()->can('visit delete')) {
                        $return .= '<a class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                                    href="javascript:;"
                                    onclick="delete_service(this);"
                                    data-id="' . base64_encode($data->id) . '">
                                        <i class="ki-solid ki-trash fs-3"></i>
                                    </a>';
                    }

                    $return .= '</div>';

                    return $return;
                })
                ->rawColumns(['action', 'user_name'])
                ->make(true);
        }
        return view('admin.visits.index');
    }

    public function visitdetails(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:visit_management,id',
            ]);

            $visit = VisitManagement::select([
                'id',
                'site_name',
                'site_image',
                'site_latitude',
                'site_longitude',
                'address',
                'company_owner_name',
                'company_office_address',
                'company_mobile_number',
                'company_gst',
                'purchaser_name',
                'purchaser_mobile_number',
                'supervisor_name',
                'supervisor_mobile_number',
                'requirements',
                'remark',
                'present_brand',
                'follow_up_date',
                'created_at',
            ])
                ->where('id', $request->id)
                ->first();
            if ($visit) {
                $visit->created_at_formatted = $visit->created_at->format('d/m/Y h:i A');
            }
            return response()->json([
                'success' => true,
                'data' => $visit,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    public function shortdetails(Request $request)
    {
        $perPage = $request->input('limit', 10);
        $search = $request->input('search');

        // ✅ Use $query instead of $visits to build the query
        $query = VisitManagement::select([
            'id',
            'site_name',
            'employee_id',
            'address',
            'company_owner_name',
            'site_latitude',
            'site_longitude',
            'company_mobile_number',
            'purchaser_mobile_number',
            'supervisor_mobile_number',
        ]);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q
                    ->where('site_name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('company_owner_name', 'like', '%' . $search . '%')
                    ->orWhere('company_mobile_number', 'like', '%' . $search . '%')
                    ->orWhere('purchaser_mobile_number', 'like', '%' . $search . '%')
                    ->orWhere('supervisor_mobile_number', 'like', '%' . $search . '%');
            });
        }
        if (!auth()->user()->can('visit view') && !auth()->user()->hasRole('Super Admin')) {
            $query->where('employee_id', auth()->user()->id);
        }

        // ✅ Now run the query
        $visits = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $visits->items(),
            'limit' => $visits->perPage(),
            'current_page' => $visits->currentPage(),
            'total' => $visits->total(),
        ]);
    }

    public function filterFollowups(Request $request)
    {
        $request->validate([
            'type' => 'required|in:today,upcoming',
            'per_page' => 'sometimes|integer|min:1',
            'page' => 'sometimes|integer|min:1',
        ]);

        $type = $request->input('type');
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $query = VisitFollowUp::with(['visit:id,site_name,address,company_mobile_number,supervisor_mobile_number,purchaser_mobile_number'])
            ->select([
                'id',
                'title',
                'visit_management_id',
                'follow_up_datetime',
                'message as remark',
            ]);

        if ($type === 'today') {
            $query->whereDate('follow_up_datetime', Carbon::today());
        } else if ($type === 'upcoming') {
            $query->whereDate('follow_up_datetime', '>', Carbon::today());
        }

        $followups = $query
            ->orderBy('follow_up_datetime')
            ->paginate($perPage, ['*'], 'page', $page);

        $formatted = $followups->map(function ($item) use ($type) {
            $datetime = Carbon::parse($item->follow_up_datetime);

            return [
                'id' => $item->id,
                'visit_management_id' => $item->visit_management_id,
                'title' => $item->title,
                'remark' => $item->remark,
                'site_name' => $item->visit->site_name ?? null,
                'purchaser_mobile_number' => $item->visit->purchaser_mobile_number ?? null,
                'supervisor_mobile_number' => $item->visit->supervisor_mobile_number ?? null,
                'company_mobile_number' => $item->visit->company_mobile_number ?? null,
                'site_address' => $item->visit->address ?? null,
                'time' => $datetime->format('h:i A'),
                'date' => $type === 'upcoming' ? $datetime->format('d-m-Y') : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $formatted,
            'limit' => $followups->perPage(),
            'current_page' => $followups->currentPage(),
            'total' => $followups->total(),
        ]);
    }

    public function followupsByVisit(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'visit_management_id' => 'required|exists:visit_management,id',
            ]);

            $visitId = $validated['visit_management_id'];

            // Fetch follow-ups
            $followups = VisitFollowUp::with(['visit:id,site_name,address'])
                ->where('visit_management_id', $visitId)
                ->select([
                    'id',
                    'title',
                    'visit_management_id',
                    'follow_up_datetime',
                    'message as remark',
                ])
                ->orderBy('follow_up_datetime')
                ->get();

            if ($followups->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No follow-ups found for this visit.'
                ], 404);
            }

            // Format data
            $data = $followups->map(function ($item) {
                $datetime = Carbon::parse($item->follow_up_datetime);
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'remark' => $item->remark,
                    'date' => $datetime->format('d-m-Y'),
                    'time' => $datetime->format('h:i A'),
                ];
            })->values();

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('FollowupsByVisit error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.'
            ], 500);
        }
    }

    public function deleteFollowup(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:visit_follow_up,id',
            ]);

            $followup = VisitFollowUp::find($validated['id']);

            $followup->delete();

            return response()->json([
                'success' => true,
                'message' => 'Follow-up deleted successfully.'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('DeleteFollowup error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.'
            ], 500);
        }
    }

    public function show(Request $request, $id)
    {
        $id = base64_decode($id);

        $visit = VisitManagement::where('id', $id)->firstOrFail();

        $followUps = VisitFollowUp::where('visit_management_id', $id)->get();

        return view('admin.visits.view', compact('visit', 'followUps'));
    }

    public function addFollowUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'visit_management_id' => 'required|exists:visit_management,id',
            'follow_up_datetime' => 'required|date',
            'title' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(1, config('error-codes.validation_error.message'), config('error-codes.validation_error.code'), $validator->errors());
        }

        $followUp = VisitFollowUp::create([
            'visit_management_id' => $request->visit_management_id,
            'follow_up_datetime' => $request->follow_up_datetime,
            'title' => $request->title,
            'message' => $request->message,
        ]);

        return $this->apiResponse(0, config('error-codes.follow-up.message'), config('error-codes.follow-up.code'));
    }

    public function updateFollowup(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:visit_follow_up,id',
                'title' => 'nullable|string|max:255',
                'message' => 'nullable|string',
                'follow_up_datetime' => 'nullable|date_format:Y-m-d H:i:s',
            ]);

            $followup = VisitFollowUp::find($validated['id']);

            if (isset($validated['title'])) {
                $followup->title = $validated['title'];
            }
            if (isset($validated['message'])) {
                $followup->message = $validated['message'];
            }
            if (isset($validated['follow_up_datetime'])) {
                $followup->follow_up_datetime = $validated['follow_up_datetime'];
            }

            $followup->save();

            return response()->json([
                'success' => true,
                'message' => 'Follow-up updated successfully.'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('UpdateFollowup error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:users,id',
            'site_name' => 'required|string|max:255',
            'site_image' => 'nullable',
            'site_latitude' => 'nullable|numeric',
            'site_longitude' => 'nullable|numeric',
            'address' => 'nullable|string|max:255',
            'company_owner_name' => 'nullable|string|max:255',
            'company_office_address' => 'nullable|string|max:255',
            'company_mobile_number' => 'nullable|string|max:15',
            'company_gst' => 'nullable|required|string|max:15|regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[A-Z0-9]{3}$/',
            'purchaser_name' => 'nullable|string|max:255',
            'purchaser_mobile_number' => 'nullable|string|max:15',
            'supervisor_name' => 'nullable|string|max:255',
            'supervisor_mobile_number' => 'nullable|string|max:15',
            'requirements' => 'nullable|string|max:500',
            'remark' => 'nullable|string|max:500',
            'present_brand' => 'nullable|string|max:255',
            'follow_up_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(1, config('error-codes.validation_error.message'), config('error-codes.validation_error.code'), $validator->errors());
        }

        $visit = VisitManagement::find($id);

        if (!$visit) {
            return $this->apiResponse(1, 'Visit not found', 404);
        }

        $visit->update($validator->validated());

        return $this->apiResponse(0, config('error-codes.visit_update.message'), config('error-codes.visit_update.code'));
    }

    public function changeStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Taken,Cancelled,Delete',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(
                1,
                config('error-codes.validation_error.message'),
                config('error-codes.validation_error.code'),
                $validator->errors()
            );
        }

        $followUp = VisitFollowUp::find($id);

        if (!$followUp) {
            return $this->apiResponse(1, 'Follow-up not found', 404);
        }

        $followUp->status = $request->status;
        $followUp->save();

        return $this->apiResponse(0, config('error-codes.change_status.message'), config('error-codes.change_status.code'));
    }

    public function destroy($id)
    {
        $id = base64_decode($id);  // Decode the ID
        $visit = VisitManagement::find($id);

        if (!$visit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Visit not found',
            ], 404);
        }

        $visit->delete();  // Delete the record

        return response()->json([
            'status' => 'success',
            'message' => 'Visit deleted successfully.',
        ]);
    }

    public function dashboardCounts()
    {
        try {
            $today = Carbon::today();

            $todayVisitCount = VisitManagement::whereDate('created_at', $today)->count();
            $today = now()->toDateString();  // or Carbon::today()

            $currentMonthVisitCount = VisitManagement::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();
            $todayFollowupCount = VisitFollowUp::whereDate('follow_up_datetime', $today)->count();

            $upcomingFollowupCount = VisitFollowUp::whereDate('follow_up_datetime', '>', $today)->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'today_visits' => $todayVisitCount,
                    'today_followups' => $todayFollowupCount,
                    'upcoming_followups' => $upcomingFollowupCount,
                    'currentMonthVisitCount' => $currentMonthVisitCount,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to fetch counts.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function attendance_store_api(Request $request) {
        $update_login_date = User::where('id', auth()->user()->id)->first();
        $update_login_date->last_login_date = now()->toDateString();
        $update_login_date->save();

        $insert = Attendance::where('user_id', auth()->user()->id)->whereDate('created_at', now()->toDateString())->first();
        // dd($insert->toSql(), $insert->getBindings(), Auth::user()->id, now()->toDateString());
        if ($insert) {

            if ($request->attend == '0') {
                $insert->delete();

            }
        } else {
            if ($request->attend == '1') {
                $insert_att = new Attendance();
                $insert_att->status = $request->attend;
                $insert_att->user_id = auth()->user()->id;
                $insert_att->save();
            }
        }
        return response()->json(['status' => 'success', 'message' => 'Thank you'], 200);
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\User;
use App\Models\CompanySetting;

use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use DB;

class StateController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [

            new Middleware('permission:state delete', only: ['destroy']),
            new Middleware('permission:state view', only: ['index', 'show']),
            new Middleware('permission:state add', only: ['create', 'store']),
            new Middleware('permission:state edit', only: ['edit', 'update']),

        ];
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = State::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $return = '<div class="btn-group">';
                    if (auth()->user()->can('state edit')) {
                        $return .= '<a href="javascript:void(0)" data-id="' . base64_encode($data->id) . '" data-name="' . $data->name . '" class="btn btn-sm btn-icon btn-light btn-active-light-primary btn_method" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_new_target">
                                        <i class="ki-solid ki-pencil"></i>
                                    </a> &nbsp;';
                    }
                    if (auth()->user()->can('state delete')) {
                        $return .= '  <a class="btn btn-sm btn-icon btn-light btn-active-light-primary mx-3" href="javascript:;" onclick="delete_state(this);"  data-id="' . base64_encode($data->id) . '"><i class="ki-solid ki-trash"></i></a>';
                    }

                    $return .= '</div>';

                    return $return;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.state.index');
    }
    public function create()
    {
        return view('admin.state.create');
    }
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:255|unique:states',


        ];

        // Custom validation messages
        $messages = [
            'name.required' => 'The state field is required.',
            'name.unique' => 'The state already been exist.',
            'name.max' => 'The State may not be greater than 255 characters.',

        ];

        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {

            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }

        $add_state = new State();
        $add_state->name = $request->name;

        $add_state->save();

        return response()->json(['status' => 'success', 'message' => 'State Added'], 200);
    }

    public function edit(Request $request, $id)
    {
        $id = base64_decode($id);
        $data = State::where('id', $id)->first();
        return view('admin.state.create', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $id = base64_decode($request->id);
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('states')->ignore($id),
            ],


        ];

        // Custom validation messages
        $messages = [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name has already exist.',
            'name.max' => 'The name may not be greater than 255 characters.',

        ];

        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {

            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }

        $update_state = State::where('id', $id)->first();
        $update_state->name = $request->name;

        $update_state->save();

        return response()->json(['status' => 'success', 'message' => 'State Updated'], 200);
    }


    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) {
            return response()->json(['message' => 'No direct script access allowed', 'status' => 'error']);
        }
        $id = base64_decode($id);
        $select_user = User::where('state_id', $id)->get();
        if ($select_user->count() > 0) {
            return response()->json(['message' => 'Failed to delete State. Used in Employee', 'status' => 'error']);
        }
        $select_company = CompanySetting::where('state_id', $id)->get();
        if ($select_company->count() > 0) {
            return response()->json(['message' => 'Failed to delete State. Used in Company setting', 'status' => 'error']);
        }
        try {

            $states = State::findOrFail($id);
            $states->delete();

            return response()->json(['message' => 'State deleted successfully', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete State', 'status' => 'error']);
        }
    }
}

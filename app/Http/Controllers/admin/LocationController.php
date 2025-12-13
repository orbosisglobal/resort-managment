<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\City;
use App\Models\CompanySetting;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class LocationController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware('permission:location delete', only: ['destroy']),
            new Middleware('permission:location view', only: ['index', 'show']),
            new Middleware('permission:location add', only: ['create', 'store']),
            new Middleware('permission:location edit', only: ['edit', 'update']),

        ];
    }




    public function index(Request $request)
    {
        $cities = City::where('name','=','Indore')->get();
        if ($request->ajax()) {
            $data = Location::with('city')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('city_name', function ($data) {
                    return $data->city ? $data->city->name : 'N/A'; // Accessing the city name
                })
                ->addColumn('action', function ($data) {
                    $return = '<div class="btn-group">';
                    if (auth()->user()->can('location edit')) {
                        $return .= '<a href="javascript:void(0)" data-id="' . base64_encode($data->id) . '" data-name="' . $data->name . '" data-city_id="' . $data->city_id . '" class="btn btn-sm btn-icon btn-light btn-active-light-primary btn_method mx-3" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_new_target">
                                        <i class="ki-solid ki-pencil"></i>
                                    </a> &nbsp;';
                    }
                    if (auth()->user()->can('location delete')) {
                        $return .= '  <a class="btn btn-sm btn-icon btn-light btn-active-light-primary" href="javascript:;" onclick="delete_location(this);"  data-id="' . base64_encode($data->id) . '"><i class="ki-solid ki-trash"></i></a>';
                    }
                    $return .= '</div>';

                    return $return;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.location.index', compact('cities'));
    }
    public function create()
    {
        $cities =City::where('name','=','Indore')->get();
        return view('admin.location.create', compact('cities'));
    }
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:255|unique:cities',
            'city_id' => 'required|exists:cities,id'

        ];

        // Custom validation messages
        $messages = [
            'name.required' => 'The location field is required.',
            'name.unique' => 'The location already been exist.',
            'name.max' => 'The Location/Area may not be greater than 255 characters.',
            'city_id.required' => 'The city id field is required.',
            'city_id.exists' => 'The city id does not exist.',
        ];

        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {

            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }

        $add_location = new Location();

        $add_location->name = $request->name;
        $add_location->city_id = $request->city_id;

        $add_location->save();

        return response()->json(['status' => 'success', 'message' => 'Location/Area Added'], 200);
    }

    public function edit(Request $request, $id)
    {
        $cities = City::where('name','=','Indore')->get();
        $id = base64_decode($id);
        $data = Location::where('id', $id)->first();
        return view('admin.location.create', compact('data', 'cities'));
    }

    public function update(Request $request, $id)
    {

        $id = base64_decode($request->id);
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('cities')->ignore($id),
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

        $update_location = Location::where('id', $id)->first();
        $update_location->name = $request->name;

        $update_location->save();

        return response()->json(['status' => 'success', 'message' => 'Location/Area Updated'], 200);
    }


    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) {
            return response()->json(['message' => 'No direct script access allowed', 'status' => 'error']);
        }

        try {
            $id = base64_decode($id);
            $select_user = User::where('location_id', $id)->get();
            if ($select_user->count() > 0) {
                return response()->json(['message' => 'Failed to delete location. Used in Employee', 'status' => 'error']);
            }

            $locations = Location::findOrFail($id);
            $locations->delete();

            return response()->json(['message' => 'Location/Area deleted successfully', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete Location/Area', 'status' => 'error']);
        }
    }
}

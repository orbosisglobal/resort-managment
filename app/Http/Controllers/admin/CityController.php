<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
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

class CityController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware('permission:city delete', only: ['destroy']),
            new Middleware('permission:city view', only: ['index', 'show']),
            new Middleware('permission:city add', only: ['create', 'store']),
            new Middleware('permission:city edit', only: ['edit', 'update']),

        ];
    }




    public function index(Request $request)
    {
        $states = State::all();
        if ($request->ajax()) {
            $data = City::with('state')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('state_name', function ($data) {
                    return $data->state ? $data->state->name : 'N/A'; // Accessing the state name
                })
                ->addColumn('action', function ($data) {
                    $return = '<div class="btn-group">';
                    if (auth()->user()->can('city edit')) {
                        $return .= '<a href="javascript:void(0)" data-id="' . base64_encode($data->id) . '" data-name="' . $data->name . '" data-state_id="' . $data->state_id . '" class="btn btn-sm btn-icon btn-warning btn-active-light-primary btn_method " data-bs-toggle="modal"
                        data-bs-target="#kt_modal_new_target">
                                        <i class="ki-solid ki-pencil"></i>
                                    </a> &nbsp;';
                    }
                    if (auth()->user()->can('city delete')) {
                        $return .= '  <a class="btn btn-sm btn-icon btn-danger btn-active-light-primary" href="javascript:;" onclick="delete_city(this);"  data-id="' . base64_encode($data->id) . '"><i class="ki-solid ki-trash"></i></a>';
                    }
                    $return .= '</div>';

                    return $return;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.city.index', compact('states'));
    }
    public function create()
    {
        $states = State::all();
        return view('admin.city.create', compact('states'));
    }
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:255|unique:cities',
            'state_id' => 'required|exists:states,id'

        ];

        // Custom validation messages
        $messages = [
            'name.required' => 'The city field is required.',
            'name.unique' => 'The city already been exist.',
            'name.max' => 'The City may not be greater than 255 characters.',
            'state_id.required' => 'The state id field is required.',
            'state_id.exists' => 'The state id does not exist.',
        ];

        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {

            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }

        $add_city = new City();

        $add_city->name = $request->name;
        $add_city->state_id = $request->state_id;

        $add_city->save();

        return response()->json(['status' => 'success', 'message' => 'City Added'], 200);
    }

    public function edit(Request $request, $id)
    {
        $states = State::all();
        $id = base64_decode($id);
        $data = City::where('id', $id)->first();
        return view('admin.city.create', compact('data', 'states'));
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

        $update_city = City::where('id', $id)->first();
        $update_city->name = $request->name;

        $update_city->save();

        return response()->json(['status' => 'success', 'message' => 'City Updated'], 200);
    }


    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) {
            return response()->json(['message' => 'No direct script access allowed', 'status' => 'error']);
        }

        try {
            $id = base64_decode($id);
            $select_user = User::where('city_id', $id)->get();
            if ($select_user->count() > 0) {
                return response()->json(['message' => 'Failed to delete city. Used in Employee', 'status' => 'error']);
            }

            $citys = City::findOrFail($id);
            $citys->delete();

            return response()->json(['message' => 'City deleted successfully', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete City', 'status' => 'error']);
        }
    }
}

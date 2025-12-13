<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware('permission:permission delete', only: ['destroy']),
            new Middleware('permission:permission view', only: ['index', 'show']),
            new Middleware('permission:permission add', only: ['create', 'store']),
            new Middleware('permission:permission edit', only: ['edit', 'update']),

        ];
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $return = '<div class="btn-group">';
                    if (auth()->user()->can('permission edit')) {
                        $return .= '<a href="javascript:void(0)" data-id="' . base64_encode($data->id) . '" 
                        data-name="' . $data->name . '" 
                        data-display_name="' . $data->display_name . '" 
                        data-display_category="' . $data->display_category . '" 
                        class="btn btn-sm btn-icon btn-light btn-active-light-primary btn_method" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_new_target">
                                        <i class="ki-solid ki-pencil"></i>
                                    </a> &nbsp;';
                    }
                    if (auth()->user()->can('permission delete')) {
                        $return .= '  <a class="btn btn-sm btn-icon btn-light btn-active-light-primary" href="javascript:;" onclick="delete_permission(this);"  data-id="' . base64_encode($data->id) . '"><i class="ki-solid ki-trash"></i></a>';
                    }

                    $return .= '</div>';

                    return $return;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.permission.index');
    }
    public function create()
    {
        return view('admin.permission.create');
    }
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:255|unique:permissions',
            'display_name' => 'required|string|max:255|unique:permissions',
            'display_category' => 'required|string|max:255'


        ];

        // Custom validation messages
        $messages = [
            'name.required' => 'The permission field is required.',
            'name.unique' => 'The permission already exists.',
            'name.max' => 'The permission may not be greater than 255 characters.',
        
            'display_name.required' => 'The display name field is required.',
            'display_name.unique' => 'The display name has already been taken.',
            'display_name.max' => 'The display name may not be greater than 255 characters.',
        
            'display_category.required' => 'The display category field is required.',
            'display_category.max' => 'The display category may not be greater than 255 characters.',
        ];
        

        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {

            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }

        $add_permission = new Permission();
        $add_permission->name = $request->name;
        $add_permission->display_name = $request->display_name;
        $add_permission->display_category = $request->display_category;

        $add_permission->save();

        return response()->json(['status' => 'success', 'message' => 'Permission Added'], 200);
    }

    public function edit(Request $request, $id)
    {
        $id = base64_decode($id);
        $data = Permission::where('id', $id)->first();
        return view('admin.permission.create', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $id = base64_decode($request->id);
        

        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions')->ignore($id),
            ],
            'display_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions')->ignore($id),
            ],
            'display_category' => [
                'required',
                'string',
                'max:255',
            ],
        ];

        $messages = [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name has already exist.',
            'name.max' => 'The name may not be greater than 255 characters.',

            'display_name.required' => 'The display name field is required.',
            'display_name.unique' => 'The display name has already exist.',
            'display_name.max' => 'The display name may not be greater than 255 characters.',

            'display_category.required' => 'The display category field is required.',
            'display_category.max' => 'The display category may not be greater than 255 characters.',
        ];


        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {

            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }

        $update_permission = Permission::where('id', $id)->first();
        $update_permission->name = $request->name;
        $update_permission->display_name = $request->display_name;
        $update_permission->display_category = $request->display_category;

        $update_permission->save();

        return response()->json(['status' => 'success', 'message' => 'Permission Updated'], 200);
    }


    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) {
            return response()->json(['message' => 'No direct script access allowed', 'status' => 'error']);
        }

        try {
            $id = base64_decode($request->id);
            $invoice = Permission::findOrFail($id);
            $invoice->delete();

            return response()->json(['message' => 'Permission deleted successfully', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete Permission', 'status' => 'error']);
        }
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [

            new Middleware('permission:role delete', only: ['destroy']),
            new Middleware('permission:role view', only: ['index', 'show']),
            new Middleware('permission:role add', only: ['create', 'store']),
            new Middleware('permission:role edit', only: ['edit', 'update']),
            new Middleware('permission:give permission', only: ['add_permission_to_roles', 'store_permisson_for_role']),


        ];
    }




    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {

                    if (strtolower($data->name) === 'super admin') {
                        return ''; 
                    }
                
                    $return = '<div class="btn-group">';
                
                    if (auth()->user()->can('give permission')) {
                        $return .= '<a href="' . route('add_permission_to_roles', ['id' => base64_encode($data->id)]) . '" class="btn btn-sm btn-icon btn-light btn-active-light-primary">
                                        <i class="ki-duotone ki-setting-4" data-bs-toggle="tooltip" title="Add Permission"></i>
                                    </a>';
                    }
                
                    if (auth()->user()->can('role edit')) {
                        $return .= '<a href="javascript:void(0)" data-id="' . base64_encode($data->id) . '" data-name="' . $data->name . '" class="btn btn-sm btn-icon btn-light btn-active-light-primary mx-3 btn_method" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_new_target">
                                        <i class="ki-solid ki-pencil"></i>
                                    </a>';
                    }
                
                    if (auth()->user()->can('role delete')) {
                        $return .= '<a class="btn btn-sm btn-icon btn-light btn-active-light-primary" href="javascript:;" onclick="delete_role(this);" data-id="' . base64_encode($data->id) . '">
                                        <i class="ki-solid ki-trash"></i>
                                    </a>';
                    }
                
                    $return .= '</div>';
                
                    return $return;
                })
                
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.role.index');
    }
    public function create()
    {
        return view('admin.role.create');
    }
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:255|unique:roles',


        ];

        // Custom validation messages
        $messages = [
            'name.required' => 'The role field is required.',
            'name.unique' => 'The role already been exist.',
            'name.max' => 'The Role may not be greater than 255 characters.',

        ];

        // Perform validation
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {

            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }

        $add_role = new Role();
        $add_role->name = $request->name;

        $add_role->save();

        return response()->json(['status' => 'success', 'message' => 'Role Added'], 200);
    }

    public function edit(Request $request, $id)
    {
        $id = base64_decode($id);
        $data = Role::where('id', $id)->first();
        return view('admin.role.create', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $id = base64_decode($request->id);
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles')->ignore($id),
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

        $update_role = Role::where('id', $id)->first();
        $update_role->name = $request->name;

        $update_role->save();

        return response()->json(['status' => 'success', 'message' => 'Role Updated'], 200);
    }


    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) {
            return response()->json(['message' => 'No direct script access allowed', 'status' => 'error']);
        }

        try {
            $id = base64_decode($id);
            $roles = Role::findOrFail($id);
            $roles->delete();

            return response()->json(['message' => 'Role deleted successfully', 'status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete Role', 'status' => 'error']);
        }
    }


    public function add_permission_to_roles(Request $request, $id)
    {
        $id = base64_decode($id); // Ensure to decode the $id from the route parameter, not $request->id
        $roles = Role::findOrFail($id);

        // Retrieve all permissions and group them by display_category
        $permissions = Permission::all()->groupBy('display_category');

        // Get the permissions assigned to the role
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_id', $roles->id)
            ->pluck('permission_id')
            ->toArray(); // Convert to array for easier handling in view

        return view('admin.permission.add_permission_to_roles', compact('roles', 'permissions', 'rolePermissions'));
    }

    public function store_permisson_for_role(Request $request, $id)
    {


        $role = Role::findOrFail($id);

        $role->syncPermissions($request->permission);
        return redirect()->route('role.index');
    }
}

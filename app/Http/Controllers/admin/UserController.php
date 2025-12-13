<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\State;
use App\Models\CompanySetting;
use App\Models\CompanyUser;
use App\Models\Attendance;
use Illuminate\Support\Facades\Session;
use App\Models\Department;
use App\Models\City;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\EmployeeDocument;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [

            new Middleware('permission:user delete', only: ['destroy']),
            new Middleware('permission:user view', only: ['index', 'show']),
            new Middleware('permission:user add', only: ['create', 'store']),
            new Middleware('permission:user edit', only: ['edit', 'update']),

        ];
    }


    public function index(Request $request)
    {
        $roles = Role::all();

        if ($request->ajax()) {
            $data = User::query();

            if (isset($request->status) && !empty($request->status)) {
                $data = $data->where("status", $request->status);
            }

            if (isset($request->role_id) && !empty($request->role_id)) {
                $data = $data->role($request->role_id);
            }
            $data = $data->get();

            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('role', function ($data) {
                    $userRoles = $data->roles->pluck('name', 'name')->all();
                    return implode(',', $userRoles);
                })

                ->addColumn('status', function ($data) {
                    if ($data->status == 'Active') {
                        return '<div class="badge badge-light-success">Active</div>';
                    } else if ($data->status == 'Blocked') {
                        return '<div class="badge badge-light-warning">Blocked</div>';
                    } else {
                        return '<div class="badge badge-light-danger">Terminate</div>';
                    }
                })

                ->addColumn('action', function ($data) {
                    $return = '<div class="btn-group">';
                    if (auth()->user()->can('user edit')) {
                        $return .= '<a href="' . route('user.edit', ['user' => $data->id]) . '" class="btn btn-sm btn-icon btn-light btn-active-light-primary ">
                                 <i class="ki-solid ki-pencil fs-3"></i>
                                    </a>';
                    }
                    if (auth()->user()->can('user view')) {
                        $return .= '<a href="' . route('user.show', ['user' => base64_encode($data->id)]) . '" class="btn btn-sm btn-icon btn-light btn-active-light-primary mx-2">
                                    <i class="ki-solid ki-eye fs-3"></i>
                                </a>';
                    }
                    if (auth()->user()->can('user delete')) {
                        $return .= '  <a class="btn btn-sm btn-icon btn-light btn-active-light-primary" href="javascript:;" onclick="delete_service(this);"  data-id="' . base64_encode($data->id) . '"><i class="ki-solid ki-trash fs-3"></i></a>';
                    }

                    $return .= '</div>';

                    return $return;
                })->rawColumns(['action', 'image', 'status'])
                ->make(true);
        }
        return view('admin.user.index', compact('roles'));
    }

    public function show(Request $request, $id)
    {
        $id = base64_decode($id);
        $user = User::where('id', $id)->first();

        return view('admin.user.view', compact('user'));
    }


    public function create(Request $request)
    {

        $states = State::all();
        $cities = City::all();

        $roles = Role::pluck('name', 'name')->all();

        return view('admin.user.create', compact('states', 'cities', 'roles'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'nullable|email|max:255|unique:users,email',
            'phone' => 'required|digits:10|unique:users,phone',
            'password' => [
                'required',
                'string',
                'min:6',
                'max:15',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
            'username' =>'required|string|max:30|unique:users,username',
            'role' => 'required',
            'address' => 'required|string',
            'pincode' => 'nullable|digits:6',

            'status' => 'string|required|in:Active,Blocked,Terminate',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'document_name' => 'nullable|array',  // Ensure document_name is an array
            'document_name.*' => 'nullable|string|max:255',  // Validate each item in the array

            'image' => 'nullable|array',  // Ensure image is an array
            'image.*' => 'nullable|file|mimes:jpg,png,jpeg,gif,pdf|max:2048',  // Validate each file input

            'profile_pic' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',

        ];

        $messages = [
            'name.required' => 'The name is required.',
            'name.unique' => 'The name must be unique.',
            'email.required' => 'An email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'phone.required' => 'The phone number is required.',
            'phone.digits' => 'The phone number must be exactly 10 digits.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.max' => 'The password must not exceed 15 characters.',
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',
            'address.required' => 'The address is required.',
            'pincode.digits' => 'The pincode must be exactly 6 digits.',
            'department_id.required' => 'The department is required.',
            'department_id.exists' => 'The selected department is invalid.',

            'state_id.required' => 'The state is required.',
            'state_id.exists' => 'The selected state is invalid.',
            'city_id.required' => 'The city is required.',
            'city_id.exists' => 'The selected city is invalid.',
            'role.required' => 'Assign Role to this user',
            'd_o_b.date' => 'The date of birth must be a valid date.',
            'anniversary_date.date' => 'The anniversary date must be a valid date.',
            'join_date.date' => 'The joining date must be a valid date.',
            'document_name.required' => 'The document name is required.',
            'document_name.*.required' => 'Each document name is required.',
            'document_name.*.string' => 'Each document name must be a valid string.',
            'document_name.*.max' => 'Each document name should not exceed 255 characters.',

            'image.required' => 'At least one image is required.',
            'image.*.required' => 'Each Document is required.',
            'image.*.file' => 'Each Document must be a valid file.',
            'image.*.mimes' => 'Each Document must be of type: jpg, png, jpeg, gif,pdf.',
            'image.*.max' => 'Each Document must not be larger than 2MB.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }



        $user = new User();
        $file = $request->file('image');
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->pincode = $request->pincode;
        $user->status = $request->status;
        $user->username = $request->username;
        $user->password = $request->password;






        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;



if ($request->hasFile('profilepic')) {
    $profilePicFile = $request->file('profilepic'); // <-- correct input name
    $filename = time() . '_' . uniqid() . '.' . $profilePicFile->getClientOriginalExtension();

    $storagePath = config('filesystems.path.storage.user_images', 'user_images');
    $profilePicFile->storeAs($storagePath, $filename, 'public');

    $user->profile_pic = $filename;
}


        $user->save();


        if ($request->has('document_name') && !empty($request->document_name)) {
            foreach ($request->document_name as $index => $documentName) {
                // Check if the document name is not empty
                if (!empty($documentName)) {
                    // Create a new document
                    $document = new EmployeeDocument();
                    $document->user_id = $user->id;
                    $document->document_name = $documentName;

                    // Handle file upload
                    $file = $request->file('image')[$index];

                    if ($file) {
                        // Generate a unique filename
                        $file_name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                        // Define storage path from config or fallback to a default path
                        $storagePath = config('filesystems.path.storage.user_images', 'user_images');

                        // Store the file in the 'public' disk
                        $file->storeAs($storagePath, $file_name, 'public');

                        // Save the filename in the document record
                        $document->image = $file_name;
                    }

                    // Save the document record
                    $document->save();
                }
            }
        }

        $user->syncRoles($request->role);
        return response()->json(['status' => 'success', 'message' => 'User Added Successfully'], 200);
    }
    public function edit(Request $request, $id)
    {
        $data = User::findorfail($id);

        $states = State::all();
        $cities = City::all();

        $roles = Role::pluck('name', 'name')->all();

        $userRoles = $data->roles->pluck('name', 'name')->all();


        return view('admin.user.create', compact('data', 'states', 'cities', 'roles', 'userRoles'));
    }
    public function update(Request $request, $user)
    {
        $user = User::where('id', $user)->first();
        $rules = [
            'name' => 'required|string|max:255|unique:users,name,' . $user->id,
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|digits:10|unique:users,phone,' . $user->id,
            'username' =>'required|string|max:30|unique:users,username,'. $user->id,
            'password' => [
                'nullable',
                'string',
                'min:6',
                'max:15',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
            'role' => 'required',
            'address' => 'required|string',
            'pincode' => 'nullable|digits:6',

            'status' => 'string|required|in:Active,Blocked,Terminate',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',

        ];

        $messages = [
            'name.required' => 'The name is required.',
            'name.unique' => 'The name must be unique.',
            'email.required' => 'An email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'phone.required' => 'The phone number is required.',
            'phone.digits' => 'The phone number must be exactly 10 digits.',
            'd_o_b.date' => 'The date of birth must be a valid date.',
            'anniversary_date.date' => 'The anniversary date must be a valid date.',
            'join_date.date' => 'The joining date must be a valid date.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.max' => 'The password must not exceed 15 characters.',
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',
            'address.required' => 'The address is required.',
            'pincode.digits' => 'The pincode must be exactly 6 digits.',
            'department_id.required' => 'The department is required.',
            'department_id.exists' => 'The selected department is invalid.',

            'state_id.required' => 'The state is required.',
            'state_id.exists' => 'The selected state is invalid.',
            'city_id.required' => 'The city is required.',
            'city_id.exists' => 'The selected city is invalid.',
            'role.required' => 'Assign Role to this user',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }


        if ($request->password !== '' && $request->password !== null) {
            $password = Hash::make($request->password);
            $user->password = $password;
        }


        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->address = $request->address;
        $user->pincode = $request->pincode;
        $user->status = $request->status;



        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;




if ($request->hasFile('profilepic')) {
    $profilePicFile = $request->file('profilepic'); // <-- correct input name
    $filename = time() . '_' . uniqid() . '.' . $profilePicFile->getClientOriginalExtension();

    $storagePath = config('filesystems.path.storage.user_images', 'user_images');
    $profilePicFile->storeAs($storagePath, $filename, 'public');

    $user->profile_pic = $filename;
}

        $user->save();




        $user->syncRoles($request->role);
        return response()->json(['status' => 'success', 'message' => 'User Added Successfully'], 200);
    }


    public function ImageUpload(Request $request)
    {
        $input = $request->except(['_token']);
        if ($request->hasFile('file')) {
            $iconName = 'user_images_' . time() . '.' . $request->file->getClientOriginalExtension();
            $icon = $request->file('file');

            Storage::disk('public')->put(config("aazovo.path.doc.user_images") . $iconName, file_get_contents($icon));

            return response()->json([
                'name'          => $iconName,
                'original_name' =>  $request->file->getClientOriginalName(),
            ]);
        }
    }

    public function upload_image(Request $request, User $user)
    {

        $rules = [
            'document_name' => 'required|array',  // Ensure document_name is an array
            'document_name.*' => 'required|string|max:255',  // Validate each item in the array

            'image' => 'required|array',  // Ensure image is an array
            'image.*' => 'required|file|mimes:jpg,png,jpeg,gif,pdf|max:' . $this->settings->image_size * 1024,  // Validate each file input, every image is required
        ];

        $messages = [
            'document_name.required' => 'The document name is required.',
            'document_name.*.required' => 'Each document name is required.',
            'document_name.*.string' => 'Each document name must be a valid string.',
            'document_name.*.max' => 'Each document name should not exceed 255 characters.',

            'image.required' => 'Document are required for all entries.',
            'image.*.required' => 'Each document is required.',
            'image.*.file' => 'Each document must be a valid file.',
            'image.*.mimes' => 'Each document must be of type: jpg, png, jpeg, gif, or pdf.',
            'image.*.max' => 'Each document must not be larger than ' . $this->settings->image_size . ' MB.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }


        foreach ($request->document_name as $index => $documentName) {
            $document = new EmployeeDocument();
            $document->user_id = $user->id;
            $document->document_name = $documentName; // No need to call $request->input() again, use $documentName directly

            // Handle file upload
            $file = $request->file('image')[$index];

            if ($file) {
                // Generate a unique filename
                $file_name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Define storage path from config or fallback to a default path
                $storagePath = config('filesystems.path.storage.user_images', 'user_images');

                // Store the file in the 'public' disk
                $file->storeAs($storagePath, $file_name, 'public');

                // Save the filename in the document record
                $document->image = $file_name;
            }

            // Save the document record
            $document->save();
        }

        return response()->json(['status' => 'success', 'message' => 'Document Uploaded Successfully'], 200);
    }

    public function destroy(Request $request, $id)
    {
        $id = base64_decode($id);

        // Delete related employee documents and their images
        $documents = EmployeeDocument::where('user_id', $id)->get();
        foreach ($documents as $document) {
            if ($document->image) {
                $oldImagePath = config('filesystems.path.storage.user_images', 'user_images') . '/' . $document->image;
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }
            $document->delete();
        }

        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['status' => 'success', 'message' => 'User deleted successfully.'], 200);
    }


    public function destroy_document(Request $request)
    {
        if ($request->ajax()) {
            // Find the document by ID
            $document = EmployeeDocument::findOrFail($request->id);
            if ($document->image) {
                $oldImagePath = config('filesystems.path.storage.user_images', 'user_images') . '/' . $document->image;
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }

            // Delete the document
            $document->delete();

            // Return a success response
            return response()->json(['status' => 'success', 'message' => 'Document deleted successfully.'], 200);
        }

        // Return an error response if it's not an AJAX request
        return response()->json(['status' => 'error', 'message' => 'Invalid request.'], 400);
    }

    public function upload_edit(Request $request, User $user)
    {
        $rules = [
            'document_name1' => 'nullable|string|max:255',
            'image1' => 'nullable|file|mimes:jpg,png,jpeg,gif,pdf|max:' . ($this->settings->image_size * 1024),
        ];

        $messages = [
            'document_name1.string' => 'The document name must be a valid string.',
            'document_name1.max' => 'The document name should not exceed 255 characters.',
            'image1.file' => 'The file must be a valid file.',
            'image1.mimes' => 'The document must be of type: jpg, png, jpeg, gif, or pdf.',
            'image1.max' => 'The document must not be larger than ' . $this->settings->image_size . ' MB.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }

        $document = EmployeeDocument::findOrFail($request->id);
        $file = $request->image1;

        $document->user_id = $user->id;
        $document->document_name = $request->document_name1;

        if ($document->image) {
            // Define the path for the existing image
            $oldImagePath = 'uploads/user_images/' . $document->image;

            // Check if the file exists and delete it
            if (Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }
        }
        if ($file) {
            // Generate a unique filename
            $file_name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Define storage path from config or fallback to a default path
            $storagePath = config('filesystems.path.storage.user_images', 'user_images');

            // Store the file in the 'public' disk
            $file->storeAs($storagePath, $file_name, 'public');

            // Save the filename in the document record
            $document->image = $file_name;
        }

        $document->save();

        return response()->json(['status' => 'success', 'message' => 'Document updated successfully.'], 200);
    }




   
}

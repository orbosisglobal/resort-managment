<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CompanyUser;
use App\Models\CompanySetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // validate data
        $request->validate([
            'email' => 'required|string|max:30',
            'password' => 'required'
        ]);

        // login code

        if (Auth::attempt(['username' => $request->email, 'password' => $request->password, 'status' => 'active'])) {



            return redirect()->route('home')->with('success', 'Login successfull');;
        }

        return redirect()->route('admin.login')->with('error_message', 'Login details are not valid');
    }

    // public function register_view()
    // {
    //     return view('auth.register');
    // }

    // public function register(Request $request){
    //     // validate
    //     $request->validate([
    //         'name'=>'required',
    //         'email' => 'required|unique:users|email',
    //         'password'=>'required|confirmed'
    //     ]);

    //     // save in users table

    //     User::create([
    //         'name'=>$request->name,
    //         'email'=>$request->email,
    //         'password'=> \Hash::make($request->password)
    //     ]);

    //     // login user here

    //     if(\Auth::attempt($request->only('email','password'))){
    //         return redirect('home');
    //     }

    //     return redirect('register')->withError('Error');


    // }




    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect()->route('login');
    }
    public function change_password(Request $request)
    {
        $request->validate([
            'curr_pass' => 'required',
            'new_pass' => 'required_with:confirm_pass|different:curr_pass|min:8',
            'confirm_pass' => 'required_with:new_pass|same:new_pass',
        ], [
            'curr_pass.password' => 'The current password is incorrect.',
        ]);

        $settings = User::first();

        if (!Hash::check($request->curr_pass, $settings->password)) {
            return response()->json(['status' => 'error', 'message' => 'The current password is incorrect.']);
        }

        $settings->password = Hash::make($request->new_pass);
        $settings->save();

        return response()->json(['status' => 'success', 'message' => 'Password updated successfully.']);
    }
}


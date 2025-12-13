<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
public function login(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(
                1,
                config('error-codes.validation_error.message'),
                config('error-codes.validation_error.code'),
                $validator->errors()
            );
        }

        $credentials = $request->only('username', 'password');

        if (!Auth::attempt($credentials)) {
            return $this->apiResponse(
                1,
                config('error-codes.invalid_credentials.message'),
                config('error-codes.invalid_credentials.code')
            );
        }

        $user = Auth::user();

        // ✅ Check if user is blocked
        if (in_array($user->status, ['Blocked', 'Terminate'])) {
            return response()->json([
                'success' => false,
                'blocked' => true,
                'message' => 'Your account is blocked. Please contact support.',
            ], 403);
        }


        // ✅ Check if user has 'Sales' role
        if (!$user->hasRole(['Sales', 'Super Admin'])) {
            return $this->apiResponse(
                1,
                config('error-codes.access_denied.message'),
                config('error-codes.access_denied.code')
            );
        }

        $token = $user->createToken('API Token')->plainTextToken;
        $roles = $user->getRoleNames();
        return $this->apiResponse(
            0,
            config('error-codes.login_success.message'),
            config('error-codes.success.code'),
             ['token' => $token , 'roles' => $roles]
        );

    } catch (\Exception $e) {
        return $this->apiResponse(
            1,
            config('error-codes.server_error.message') . ': ' . $e->getMessage(),
            config('error-codes.server_error.code')
        );
    }
}





public function checkAccess(Request $request)
{
    $user = auth()->user();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthenticated.',
        ], 401);
    }

   if (in_array($user->status, ['Blocked', 'Terminate'])) {
        return response()->json([
            'success' => false,
            'blocked' => true,
            'message' => 'Your account is blocked. Please contact support.',
        ], 403);
    }

    if (!$user->hasRole('Sales')) {
        return response()->json([
            'success' => false,
            'blocked' => false,
            'message' => 'Access denied. You do not have the Sales role.',
        ], 403);
    }

    return response()->json([
        'success' => true,
        'blocked' => false,
        'role' => 'Sales',
        'message' => 'Access granted. You are allowed.',
    ]);
}

}

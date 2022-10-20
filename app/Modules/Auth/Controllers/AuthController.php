<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Requests\LoginUserRequest;
use App\Modules\Auth\Requests\RegisterUserRequest;
use App\Modules\Auth\Requests\UpdateUserRequest;
use App\Modules\Auth\Services\AuthUserService;
use App\Modules\Auth\Services\LoginUserService;
use App\Modules\Auth\Services\RegisterUserService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function createUser(RegisterUserRequest $request)
    {
        return (new RegisterUserService)->createUser($request->validated());
    }

    
    public function loginUser(LoginUserRequest $request)
    {
        return (new LoginUserService)->login($request);
    }

    public function user_type()
    {
        return (new AuthUserService)->auth_user_info();
    }

    public function updateUserProfile(UpdateUserRequest $request)
    {
        return (new RegisterUserService)->updateUser($request);
    }

    public function logout(LoginUserRequest $request)
    {
        // still working in this..
        // Get user who requested the logout
        $user = request()->user(); //or Auth::user()
        // Revoke current user token
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'User Logged Out Successfully',
        ], 200);
    }
    public function userDetails()
    {
        // get authenticated user details
        $user = Auth::user();
        return response()->json([
            'status' => true,
            'message' => 'User Details',
            'data' => $user
        ], 200);
    }
}

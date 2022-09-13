<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponseMessagesTrait;

class RegisterUserService 
{
    use ApiResponseMessagesTrait;
   public function createUser($data)
   {
    try {

        $user = User::create([
            'name' =>$data['name'],
            'email' =>$data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'data' => auth()->user(),
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }

   }
}

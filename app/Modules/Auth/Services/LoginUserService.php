<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;

class LoginUserService 
{
    use ApiResponseMessagesTrait;
   public function login($data)
   {
    try {
        if(!Auth::attempt($data->only(['email', 'password']))){
            return $this->badRequest('Email & Password does not match with our record.');
        }
        $user = User::where('email', $data->email)->first();
        return $this->success(['user' => $user, 'token' => $user->createToken("API TOKEN")->plainTextToken], 'User Logged In Successfully');
    } catch (\Throwable $th) {
        return $this->badRequest($th->getMessage());
    }

   }
}

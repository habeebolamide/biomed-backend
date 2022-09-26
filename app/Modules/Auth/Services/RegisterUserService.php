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
            'username' =>$data['username'],
            'email' =>$data['email'],
            'phone' =>$data['phone'],
            'status' => 'active',
            'password' => Hash::make($data['password'])
        ]);
        return $this->success(['user' => $user, 'token' => $user->createToken("API TOKEN")->plainTextToken], 'Account created Successfully');

    } catch (\Throwable $th) {
        return $this->badRequest($th->getMessage());
    }

   }

   public function updateUser($data)
   {
    try {
        $user = User::where('email', request()->user()->email)->update([
            'name' =>$data['name'],
            'username' =>$data['username'],
            'email' =>$data['email'],
            'phone' =>$data['phone'],
        ]);
        return $this->success(['user' => $user], 'Account updated Successfully');

    } catch (\Throwable $th) {
        return $this->badRequest($th->getMessage());
    }

   }
}

<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;

class AuthUserService 
{
    use ApiResponseMessagesTrait;
   public function auth_user_info()
   {
        return $this->success( auth()->user(), 'Successs');


   }
}

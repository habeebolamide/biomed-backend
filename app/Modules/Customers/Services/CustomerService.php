<?php

namespace App\Modules\Customers\Services;

use App\Modules\Auth\Models\User;

use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerService
{
     use ApiResponseMessagesTrait;
     public function allUser($data)
     {
          $user = User::with(['orders', 'customer_messages'])->select('*')->where('user_type', 'user');
          if ($data["filters"]) {
               if (array_key_exists("search", $data["filters"])) {
                    if (!is_null($data["filters"]["search"])) {
                         $user->where('name', "like", "%" . $data["filters"]["search"] . "%");
                    }
               }

               if (array_key_exists("status", $data["filters"])) {
                    if (!is_null($data["filters"]["status"])) {
                         $user->where('status', $data["filters"]["status"]);
                    }
               }
          }


          return $this->success($user->orderBy('created_at', 'desc')->paginate(30), "all users");
     }

     public function searchUser($rearch)
     {
          $user = User::where('name', 'like', '%' . $rearch . '%')
               ->orWhere('phone', 'like', '%' . $rearch . '%')
               ->orWhere('username', 'like', '%' . $rearch . '%')
               ->orWhere('email', 'like', '%' . $rearch . '%')
               ->first();
          if (!$user)  return $this->badRequest('User not found');

          return $this->success($user, " User record");
     }

     public function create($data)
     {
          $user = User::create([
               "name" => $data["name"],
               "username" => $data["username"],
               "email" => $data["email"],
               "phone" => $data["phone"],
               "status" => $data["status"],
               "password" => Hash::make('12345678'),

          ]);

          return $this->success($user, "User Created Successfully");
     }

     public function single_user($id)
     {
          $product = User::with('orders')->find($id);
          return $this->success($product, "User");
     }



     public function updateUser($data, $id)
     {
          $user = User::where('id', $id)->update([
               "name" => $data["name"],
               "username" => $data["username"],
               "email" => $data["email"],
               "phone" => $data["phone"],
               "status" => $data["status"],
          ]);


          return $this->success($user, "User Updated Successfully");
     }

     public function deleteUser($id)
     {
          try {
               //code...
               User::where('id', $id)->delete();
               return $this->success([], "User Deleted Successfully");
          } catch (\Throwable $th) {
               return $this->badRequest($th->getMessage());
          }
     }
}

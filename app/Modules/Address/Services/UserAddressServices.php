<?php

namespace App\Modules\Address\Services;

use App\Modules\Address\Models\UserAddress;
use App\Modules\Auth\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;

class UserAddressServices 
{
    use ApiResponseMessagesTrait;
   public function getUserAddresses()
   {
        $user = UserAddress::where('user_id', '=',Auth::user()->id)->get();
        return $this->success($user, "User Addresses");
   }

   public function getSingleAddress($user_address_id)
   {
        $userAddress = UserAddress::where('id', $user_address_id)->first();
        return $this->success($userAddress, "User Addresses");
   }

   public function updateSingleAddress($data, $user_address_id)
   {
        $userAddress = UserAddress::where('id', $user_address_id)->update([
            "name" => $data["name"],
            "email" => $data["email"],
            "phone" => $data["phone"],
            "country" => $data["country"],
            "state" => $data["state"],
            "city" => $data["city"],
            "address" => $data["address"],
        ]);
        return $this->success($userAddress, "Address Updated");
   }

   public function removeSingleAddress($user_address_id)
   {
        $userAddress = UserAddress::where('id', $user_address_id)->delete();
        return $this->success([], "Address Deleted");
   }

   public function addSingleAddress($data)
   {
     $address = new UserAddress;
     
            $address->user_id = Auth::user()->id;
            $address->name = $data["name"];
            $address->email = $data["email"];
            $address->phone = $data["phone"];
            $address->country = $data["country"];
            $address->state = $data["state"];
            $address->city = $data["city"];
            $address->address = $data["address"];
        
        return $this->success($address, "Address Added");
   }

   public function defaultAddress($user_address_id)
   {
        # first of all make sure all the available addresses for the user are set to no
        UserAddress::where("user_id", Auth::user()->id)->update([
            "is_default" => "no",
        ]);
        UserAddress::where("id", $user_address_id)->update([
            "is_default" => "yes",
        ]); //
        $add = UserAddress::where(["user_id" => Auth::user()->id,"is_default" => 'yes'])->first();
        return $this->success($add, "Address Updated");
   }
}

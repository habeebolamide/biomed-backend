<?php

namespace App\Modules\Address\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function getUserAddress()
    {
    //    this will return user and address information
    }

    public function getSingleUserAddress($user_address_id)
    {
        //    this will return single user and address information
    }

    public function updateUserAddress(Request $request, $user_address_id)
    {
        // this will update single user and address information
    }

    public function removeUserAddress($user_address_id)
    {
        # this will remove single address information of a user
    }

    public function addUserAddress()
    {
        # this will add single address information of a user
    }
}

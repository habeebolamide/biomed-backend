<?php

namespace App\Modules\Address\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Address\Requests\UserAddressRequest;
use App\Modules\Address\Services\UserAddressServices;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function getUserAddress()
    {
    //    this will return user and address information
        return (new UserAddressServices)->getUserAddresses();
    }

    public function getSingleUserAddress($user_address_id)
    {
        //    this will return single user and address information
        return (new UserAddressServices)->getSingleAddress($user_address_id);
    }

    public function updateUserAddress(UserAddressRequest $request, $user_address_id)
    {
        // this will update single user and address information
        return (new UserAddressServices)->updateSingleAddress($request->validated(), $user_address_id);
    }

    public function removeUserAddress($user_address_id)
    {
        # this will remove single address information of a user
        return (new UserAddressServices)->removeSingleAddress($user_address_id);
    }

    public function addUserAddress(UserAddressRequest $request)
    {
        return (new UserAddressServices)->addSingleAddress($request->validated());
    }

    public function defaultAddress($user_address_id)
    {
        return (new UserAddressServices)->defaultAddress($user_address_id);
    }
}

<?php

namespace App\Modules\WishList\Services;

use App\Modules\Auth\Models\User;
use App\Modules\Category\Models\Category;
use App\Modules\SubCategory\Models\SubCategory;
use App\Modules\WishList\Model\WishList;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;

class WishListService 
{
    use ApiResponseMessagesTrait;
   
    public function getWishList()
    {
       $wishList = WishList::where('user_id', '=', Auth::user()->id)->get();
       return $this->success($wishList, "all users wishList");
    }

    public function removeWishList($wishList_id)
    {
        $wishList = WishList::where('is', '=', $wishList_id)->delete();
        return $this->success($wishList, "all users wishList");
    }

    public function addWishList($data)
    {
        $wishList = WishList::create([
            'user_id' => Auth::user()->id,
            'reference_no' => $this->generateReferenceNumber(20, 'WishList'),
            'prduct_id' => $data['prduct_id'],
            'quantity' => $data['quantity']??1,
        ]);
        return $this->success($wishList, "all users wishList");
    }

    public function updateWishList($data, $wishList_id){
        
        $wishList = WishList::where('id', $wishList_id)->update([
            'user_id' => Auth::user()->id,
            'reference_no' => $this->generateReferenceNumber(20, 'WishList'),
            'prduct_id' => $data['prduct_id'],
            'quantity' => $data['quantity']??1,
        ]);
        return $this->success($wishList, "all users wishList  d supdate");
    }

    public function getWishListById($wishList_id)
    {
        $wishList = WishList::where('id', '=', $wishList_id)->get();
        return $this->success($wishList, "user's wishList");
    }

    public function removeWishListById($wishList_id)
    {
        $wishList = WishList::where('id', '=', $wishList_id)->remove();
        return $this->success([], "user's wishList reomved successfully");
    }

}

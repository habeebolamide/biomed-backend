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
       $WishList = WishList::where('user_id', '=', Auth::user()->id)
       ->join('products','wish_lists.product_id','products.id')
       ->select('*','wish_lists.id as wid')
       ->get();
       return $this->success($WishList, "all users WishList");
    }

    public function removeWishList($WishList_id)
    {
        $WishList = WishList::where('is', '=', $WishList_id)->delete();
        return $this->success($WishList, "all users WishList");
    }

    public function addWishList($data)
    {
        $WishList = WishList::create([
            'user_id' => Auth::user()->id,
            'reference_no' => rand(0, 20),
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity']??1,
        ]);
        return $this->success($WishList, "Product Added");
    }

    public function updateWishList($data, $WishList_id){
        
        $WishList = WishList::where('id', $WishList_id)->update([
            'user_id' => Auth::user()->id,
            'reference_no' => $this->generateReferenceNumber(20, 'WishList'),
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity']??1,
        ]);
        return $this->success($WishList, "all users WishList  d supdate");
    }

    public function getWishListById($WishList_id)
    {
        $WishList = WishList::where('id', '=', $WishList_id)->get();
        return $this->success($WishList, "user's WishList");
    }

    public function removeWishListById($WishList_id)
    {
        $WishList = WishList::where('id', '=', $WishList_id)->delete();
        return $this->success([], "Product reomved successfully");
    }

}

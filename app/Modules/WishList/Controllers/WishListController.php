<?php

namespace App\Modules\WishList\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\WishList\Requests\WishListRequest;
use App\Modules\WishList\Services\WishListService;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function index()
    {
        return (new WishListService)->getWishList();
    }


    public function show($wish_list_id)
    {
        return (new WishListService)->getWishListById($wish_list_id);
    }

    public function remove($wish_list_id)
    {
        return (new WishListService)->removeWishListById($wish_list_id);
    }


    public function store(WishListRequest $request)
    {
        return (new WishListService)->addWishList($request);
    }

    public function update(WishListRequest $request, $wish_list_id)
    {
        return (new WishListService)->updateWishList($request, $wish_list_id);
    }
}

<?php

namespace App\Modules\Cart\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Cart\Requests\CartRequest;
use App\Modules\Cart\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getCarts()
    {
        return (new CartService())->getCarts();
    }

    public function getSingleCart($cart_id)
    {
        return (new CartService())->getSingleCart($cart_id);
    }

    public function addToCart(CartRequest $request)
    {
        return (new CartService())->addToCart($request);
    }

    public function updateCart(CartRequest $request,  $cart_id)
    {
        return (new CartService())->updateCart($request,  $cart_id);
    }

    public function removeCart($cart_id)
    {
        return (new CartService())->removeCart($cart_id);
    }

    public function clearCart()
    {
        return (new CartService())->clearCart();
    }

    public function incrementQuantity($request, $cart_id){
        return (new CartService())->increment($request, $cart_id);
    }

}

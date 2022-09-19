<?php

namespace App\Modules\Cart\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Cart\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getCarts()
    {
       $cart = Cart::where('user_id', '=', Auth::user()->id)
                ->orWhere('mac_address', '=', $this->getMacAddress())->get();
       return $this->success($cart, "all users cart");
    }

    public function FunctionName(Type $var = null)
    {
        # code...
    }
}

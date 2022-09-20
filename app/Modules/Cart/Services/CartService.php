<?php

namespace App\Modules\Cart\Services;

use App\Modules\Auth\Models\User;
use App\Modules\Cart\Models\Cart;
use App\Modules\Product\Models\ProductQuantity;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;

class CartService 
{
    use ApiResponseMessagesTrait;
   
    public function getCarts()
    {
       $cart = Cart::where('user_id', '=', Auth::user()->id)
                ->orWhere('mac_address', $this->getMAcAddressExec())->get();
       return $this->success($cart, "all users Carts");
    }

    public function addToCart($data)
    {
        $prodQuantity = ProductQuantity::where('product_id', $data['prduct_id'])->first()->quantity;
        if($prodQuantity < 1){
            return $this->badRequest("Product Out of Stock");
        }
        $cart = Cart::create([  
            'user_id' => Auth::user()->id, 
            'mac_address' => $this->getMAcAddressExec(),
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity']??1,
        ]);
        
        return $this->success($cart, "Items Added to carts succcesslfy");
    }

    // this function can be useless
    public function updateCart($data, $cart_id)
    {
        $cart = Cart::where('id', $cart_id)->update([  
            'user_id' => Auth::user()->id, 
            'mac_address' => $this->getMAcAddressExec(),
            'prduct_id' => $data['prduct_id'],
            'quantity' => $data['quantity']??1,
        ]);
        return $this->success($cart, "Items Added to cars succcesslfy");
    }

    public function removeCart($cart_id)
    {
        $cart = Cart::where('id', '=', $cart_id)->delete();
        return $this->success($cart, "all users Carts Removed Successfully");
    }

    public function clearCart()
    {
        $cart = Cart::where('user_id', '=', Auth::user()->id)
                ->orWhere('mac_address', $this->getMAcAddressExec())->delete();
        return $this->success($cart, "all users Carts Cleared Successfully");
    }

    public function getSingleCart($cart_id)
    {
        $cart = Cart::Where('id', $cart_id)->first();
        return $this->success($cart, "user cart");
    }


    public function increment($cart_id)
    {
        $cart = Cart::where('id', $cart_id)->first();
        $quantity = ProductQuantity::where('product_id', $cart->product_id)->first()->quantity;
        if($quantity > 1){
            $cart->quantity = $cart->quantity + 1;
            $cart->save();
            return $this->success($cart, "user cart");
        }
        return $this->badRequest("Product Out of Stock");
    }

    public function decrement($cart_id)
    {
        $cart = Cart::where('id', $cart_id)->first();
        $cart->quantity = $cart->quantity - 1;
        $cart->save();
        return $this->success($cart, "user cart");
    }

 
}

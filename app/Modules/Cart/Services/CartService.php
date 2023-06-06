<?php

namespace App\Modules\Cart\Services;

use App\Modules\Auth\Models\User;
use App\Modules\Cart\Models\Cart;
use App\Modules\GenerateUniqueId\Models\GenerateUniqueId;
use App\Modules\Product\Models\ProductQuantity;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;
// require_once './public/BlakeGardner/MacAddress.php';
// use BlakeGardner\MacAddress;
class CartService
{
    use ApiResponseMessagesTrait;

    public function getCarts()
    {

        if (Auth::user()) {
            $cart = Cart::where('user_id', Auth::user()->id)->with(['product'])->get();
        }
        // else{
        //     $unique = GenerateUniqueId::where('unique_id', request()->unique_id)->first();
        //     $cart = Cart::where('mac_address', $unique->id.'|'.$unique->unique_id)->with(['product'])->get();
        // }

        return $this->success($cart, "all users Carts");
    }



    public function addToCart($data)
    {
        $prodQuantity = ProductQuantity::where('product_id', $data['product_id'])->first()->quantity;
        if ($prodQuantity < 1) {
            return $this->badRequest("Product Out of Stock");
        }

        $check = Cart::where(['product_id' => $data['product_id'], 'user_id' => Auth::user()->id])->count();
        if ($check) {
            return $this->badRequest("Product Already added to cart");
        }
        $cart = Cart::create([
            'user_id' => Auth::user()->id,
            'mac_address' => $this->getMAcAddressExec(),
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'] ?? 1,
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
            'quantity' => $data['quantity'] ?? 1,
        ]);
        return $this->success($cart, "Items Added to cars succcesslfy");
    }

    public function removeCart($cart_id)
    {
        $cart = Cart::where('id', '=', $cart_id)->delete();
        return $this->success($cart, "Product Removed");
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


    public function increment($data, $cart_id)
    {
        $unique = GenerateUniqueId::where('unique_id', request()->unique_id)->first();
        if (!Auth::user()) {
            // check if the cart belongs to the PC
            $cart = Cart::where(['id' => $cart_id, 'mac_address' => $unique->id . '|' . $unique->unique_id])->first();
        } else {
            $cart = Cart::where(['id' => $cart_id, 'user_id' => Auth::user()->id])->first();
        }

        $quantity = ProductQuantity::where('product_id', $cart->product_id)->first()->quantity;
        if ($quantity > 1) {
            if ($data['action'] == 'in') {
                $cart->quantity = $cart->quantity + 1;
                $cart->save();
                if (!Auth::user()) {
                    $carts = Cart::where('mac_address', $unique->id . '|' . $unique->unique_id)
                        ->with(['product'])->get();
                } else {
                    $carts = Cart::where('user_id', '=', Auth::user()->id)
                        ->with(['product'])
                        ->orWhere('mac_address', $unique->id . '|' . $unique->unique_id)->get();
                }

                return $this->success($carts, "Cart Updated");
            } else {
                $cart->quantity = $cart->quantity - 1;
                $cart->save();
                if (!Auth::user()) {
                    $carts = Cart::where('mac_address', $unique->id . '|' . $unique->unique_id)
                        ->with(['product'])->get();
                } else {
                    $carts = Cart::where('user_id', '=', Auth::user()->id)
                        ->with(['product'])
                        ->orWhere('mac_address', $unique->id . '|' . $unique->unique_id)->get();
                }
                return $this->success($carts, "Cart Updated");
            }
        }
        return $this->badRequest("Product Out of Stock");
    }
}

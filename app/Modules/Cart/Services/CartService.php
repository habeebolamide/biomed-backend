<?php

namespace App\Modules\Cart\Services;

use App\Modules\Auth\Models\User;
use App\Modules\Cart\Models\Cart;
use App\Modules\Product\Models\ProductQuantity;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;
require_once './public/BlakeGardner/MacAddress.php';
use BlakeGardner\MacAddress;
class CartService 
{
    use ApiResponseMessagesTrait;
   
    public function getCarts()
    {
        
        return "Mac". MacAddress::getCurrentMacAddress('eth0');

        
       $cart = Cart::where('user_id', '=', Auth::user()->id)
       ->with(['product'])
                ->orWhere('mac_address', $this->getMAcAddressExec())->get();
       return $this->success($cart, "all users Carts");
    }
    public function GetMAC(){
        $macAddr = false;
        $arp = `arp -n`;
        $lines = explode("\n", $arp);

        foreach ($lines as $line) {
            $cols = preg_split('/\s+/', trim($line));

            if ($cols[0] == $_SERVER['REMOTE_ADDR']) {
                $macAddr = $cols[2];
            }
        }

        return $macAddr;
    }
        

    public function addToCart($data)
    {
        $prodQuantity = ProductQuantity::where('product_id', $data['product_id'])->first()->quantity;
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
        $cart = Cart::where('id', $cart_id)->first();
        $quantity = ProductQuantity::where('product_id', $cart->product_id)->first()->quantity;
        if($quantity > 1){
            if ($data['action'] == 'in') {
                $cart->quantity = $cart->quantity + 1;
                $cart->save();
                $carts = Cart::where('user_id', '=', Auth::user()->id)
                ->with(['product'])
                ->orWhere('mac_address', $this->getMAcAddressExec())->get();
                return $this->success($carts, "Cart Updated");
            } else {
                $cart->quantity = $cart->quantity - 1;
                $cart->save();
                $carts = Cart::where('user_id', '=', Auth::user()->id)
                ->with(['product'])
                ->orWhere('mac_address', $this->getMAcAddressExec())->get();
                return $this->success($carts, "Cart Updated");
            }
        }
        return $this->badRequest("Product Out of Stock");
    }


 
}

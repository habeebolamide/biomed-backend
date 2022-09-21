<?php

namespace App\Modules\Order\Services;

use App\Modules\Cart\Models\Cart;
use App\Modules\Order\Models\Order;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;

class OrderService 
{
    use ApiResponseMessagesTrait;
    public function getOrder($order_no)
    {
        $order = Order::where('order_no', $order_no)->get();
        return $this->success($order, "Order successfully returned");
    }

    public function placeOrder()
    {
        # this function should be triggered by the successful payment of the order
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $order_no = $this->generateReferenceNumber(30, "Order");
        foreach ($carts as $cart) {
            $order = Order::create([
                "user_id" => Auth::user()->id,
                "product_id" => $cart->product_id,
                "quantity" => $cart->quantity,
                "order_no" => $order_no,
            ]);
        }
        $carts = Cart::where('user_id', Auth::user()->id)->delete();
        return $this->success($order, "Order successfully Placed");
    }

    public function allUserOrders()
    {
        # code...
        $carts = Order::where('user_id', Auth::user()->id)->groupBy('order_no')->get();
    }
 
}

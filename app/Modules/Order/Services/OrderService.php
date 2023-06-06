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
        // $order_no = $this->generateReferenceNumber(30, "Order");
        $order_no = rand(1,9999999999);
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

    public function getAllOrder($data)
    {
        $allOrders = Order::select('*');

        if ($data["filters"]) {

            if (array_key_exists("search", $data["filters"])) {
                if (!is_null($data["filters"]["search"])) {
                    $allOrders->whereHas('products', function ($q) use ($data) {
                        $q->where('product_name', "like", "%" . $data["filters"]["search"] . "%");
                    });
                }
            }
            if (array_key_exists("nested_sub_category_id", $data["filters"])) {
                if (!is_null($data["filters"]["nested_sub_category_id"])) {
                    $allOrders->whereHas('products', function ($q) use ($data) {
                        $q->whereHas('nestedSubCategory', function ($query) use ($data) {
                            $query->where('id', $data["filters"]["nestedSubCategory"]);
                        });
                    });
                }
            }

            if (array_key_exists("status", $data["filters"])) {
                if (!is_null($data["filters"]["status"])) {
                    $allOrders->where('status', $data["filters"]["status"]);
                }
            }
        }

        return $this->success($allOrders->orderBy('created_at', 'desc')->orderby('status', 'asc')->paginate(40), "All Order");
    }


    public function change_status($data)
    {
        $column = $data["every_order_no"] ? "order_no" : "id";



        $order = Order::where([
            $column => $data["reference"]
        ])->update([
            'status' => $data["status"]
        ]);

        if ($order > 0) return $this->success($order, "Order updated Successfully");

        return $this->badRequest("Unable to update status");
    }
}

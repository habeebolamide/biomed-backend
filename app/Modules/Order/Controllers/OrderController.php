<?php

namespace App\Modules\Order\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Order\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrder($order_no)
    {
       return (new OrderService)->getOrder($order_no);
    }


    public function placeOrder()
    {
        return (new OrderService)->placeOrder();
    }

    public function getAllUserOrders()
    {
        # code...
    }
}

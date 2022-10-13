<?php

namespace App\Modules\Invoice\Services;

use App\Modules\Auth\Models\User;
use App\Modules\Cart\Models\Cart;
use App\Modules\Coupon\Models\Coupon;
use App\Modules\Invoice\Models\Invoice;
use App\Modules\Product\Models\ProductQuantity;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;
// require_once './public/BlakeGardner/MacAddress.php';
// use BlakeGardner\MacAddress;
class InvoiceService 
{
    use ApiResponseMessagesTrait;
   
    public function generateInvoice($data)
    {
        $validateUser=User::where('id', Auth::user()->id)->firstOrFail();
        $userCart= Cart::with('product')->where('user_id', $validateUser->id)->get();
        if(count($userCart) < 1) return $this->badRequest('Cart empty');
        $coupon= false;
        $invoice_id = uniqid('INVOICE');
        if ($data['coupon']) {
            $coupon = false;

            if (array_key_exists('coupon', $data->toArray())) {

                $coupon = Coupon::where('coupon', $data['coupon'])->first()->coupon ?? null;
                if ($coupon == null) return $this->badRequest('Invalid Coupon');
            }
        }

        foreach ($userCart as $key => $value) {

            $userInvoice = new Invoice;
            $userInvoice->user_id=  $validateUser->id;
            $userInvoice->product_id=  $value['product_id'];
            $userInvoice->quantity=  $value['quantity'];
            $userInvoice->invoice_id=  $invoice_id;
            $userInvoice->product_price=  $value['product']['price'];
            $userInvoice->product_discount=  $value['product']['discount'];

            if($coupon) 
            $userInvoice->coupon_disount=  $coupon;

            $userInvoice->save();
            
        }

        Cart::with('product')->where('user_id', $validateUser->id)->delete();

        return $this->success([$userInvoice], "Invoice Generated successfully");


    }


    public function discard_invoice($data)
    {
        try {
            $column_type='';
            if(array_key_exists("type", $data)) {
                if($data['type'] =='all_invoice') $column_type="invoice_id";
                else $column_type="id";
            }
            $discardAllInvoice= Invoice::where($column_type, $data['reference_id'])->delete();
            return $this->success([], 'Invoice Discard Successfully');

        } catch (\Throwable $th) {
            return $this->badRequest($th->getMessage());
        }
    }
    


 
}

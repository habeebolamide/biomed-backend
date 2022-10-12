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
        $validateUser=User::where('id', auth()->user()->id)->firstOrFail();

        $userCart= Cart::with('product')->where('user_id', $validateUser->id)->get();

        $invoice_id= uniqid('INVOICE');
        $coupon=false;

        if(!array_key_exists($data['coupon'], $data)) {

            $coupon= Coupon::where('coupon', $data['coupon'])->first()->coupon ?? null;
            if($coupon ==null) return response()->json('Invalid coupon', 400);
            
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

            $coupon->save();
            
        }

        $userCart->delete();

        return $this->success([], "Invoice Generated successfully");


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

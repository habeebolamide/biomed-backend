<?php

namespace App\Modules\Invoice\Services;

use App\Modules\Address\Models\UserAddress;
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
        $validateUser = User::where('id', Auth::user()->id)->firstOrFail();
        $address = UserAddress::where(["user_id" => Auth::user()->id, "is_default" => 'yes'])->first();
        $userCart = Cart::with('product')->where('user_id', $validateUser->id)->get();
        if (count($userCart) < 1) return $this->badRequest('Cart empty');
        $coupon = false;
        $invoice_id = uniqid('INV');
        if ($data['coupon']) {

            $coupon = Coupon::where('coupon', $data['coupon'])->first() ?? null;
            if ($coupon == null) return $this->badRequest('Invalid Coupon');
        }

        foreach ($userCart as $key => $value) {

            $userInvoice = new Invoice;
            $userInvoice->user_id = Auth::user()->id;
            $userInvoice->product_id = $value['product_id'];
            $userInvoice->quantity = $value['quantity'];
            $userInvoice->address_id = $address->id;
            $userInvoice->invoice_id = $invoice_id;
            $userInvoice->product_price = $value['product']['discount_price'];
            $userInvoice->product_discount = $value['product']['discount'];

            if ($coupon) {
                $userInvoice->coupon_disount =  $coupon->percent;
                $userInvoice->coupon_id =  $coupon->id;
            }
            $userInvoice->save();
        }

        Cart::with('product')->where('user_id', $validateUser->id)->delete();

        return $this->success($userInvoice, "Invoice Generated successfully");
    }
    public function getInvoice($invoice_id)
    {
        $invoice = Invoice::where('invoice_id', $invoice_id)->get();
        return $this->success($invoice, "Invoice Received");
    }
    public function allInvoice()
    {
        // Invoice::where('invoice_id', '!=', null)->delete();
        $invoice = Invoice::where('user_id', Auth::user()->id)->groupBy('invoice_id')->paginate(10);
        return $this->success($invoice, "Invoice Received");
    }

    public function discard_invoice($data)
    {
        try {
            $column_type = '';
            if (array_key_exists("type", $data)) {
                if ($data['type'] == 'all_invoice') $column_type = "invoice_id";
                else $column_type = "id";
            }
            $discardAllInvoice = Invoice::where($column_type, $data['reference_id'])->delete();
            return $this->success([], 'Invoice Discard Successfully');
        } catch (\Throwable $th) {
            return $this->badRequest($th->getMessage());
        }
    }



    // ADMIN


    public function all_user_invoice($data)
    {
        $data = $data->toArray();
        $Invoicedata = Invoice::query();

        if (array_key_exists("status", $data)) {
            $Invoicedata->where('status', $data["status"]);
        }
        if (array_key_exists("search", $data)) {
            $Invoicedata->whereHas('product', function ($q) use ($data) {

                $q->where('product_name', 'like', '%' . $data["search"] . '%');
            });
        }

        return $this->success($Invoicedata->paginate(40), "All user invoice");
    }
}

<?php

namespace App\Modules\Transaction\Services;

use App\Modules\Invoice\Models\Invoice;
use App\Modules\Transaction\Models\Transaction;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Http\Request;
class TransactionServices
{
    use ApiResponseMessagesTrait;
    public function initializeTransaction($data, $invoice_id)
    {
        // get the selected gateway_type
        $gateway_type = $data['gateway'];
        // get the invoice_id
        // get the invoice details
        $invoiceAmount = Invoice::where('invoice_id', $invoice_id)->sum('product_price');
        $invoice = Invoice::where('invoice_id', $invoice_id)->first();
        $totalAmount = $invoiceAmount - $invoice->coupon_disount/100 * $invoiceAmount;
        $reference_number = uniqid('TRANS');
        
        // Insert all datas into transaction table
        $transaction = new Transaction;
        $transaction->invoice_id = $invoice_id;
        $transaction->user_id = $invoice->user_id;
        $transaction->expected_amount = $totalAmount;
        $transaction->reference_no = $reference_number;
        $transaction->gateway_type = $gateway_type;
        $transaction->save();
        return $this->success($transaction, "Transaction Record Created");

    }
}

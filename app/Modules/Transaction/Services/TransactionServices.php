<?php

namespace App\Modules\Transaction\Services;

use App\Modules\Invoice\Models\Invoice;
use App\Modules\Transaction\Models\Transaction;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
        $totalAmount = $invoiceAmount - $invoice->coupon_disount / 100 * $invoiceAmount;
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
    public function checkTransactionStatus($transaction_id, $invoice_id)
    {

        $mk = getenv('MONNIFY_MERCHANT_KEY');
        $response = Http::get("https://sandbox.monnify.com/api/v1/sdk/transactions/query/$mk?paymentReference=$transaction_id");
        $trans = Transaction::where('reference_no', $transaction_id)->first();
        if ($response['responseMessage'] == "success") {
            if ($trans->user_id == Auth::user()->id && $trans->invoice_id == $invoice_id && $response['responseBody']['amountPaid'] == $trans->expected_amount) {
                if ($response['responseBody']['paymentStatus'] == 'PAID') {
                    $transaction = Transaction::where('reference_no', $transaction_id)->update([
                        "status" => 'approved',
                        "raw_response" => $response
                    ]);
                    // update the invoice status to paid
                    $invoice = Invoice::where('invoice_id', $invoice_id)->update([
                        "status" => 'paid'
                    ]);
                    return response()->json([
                        "status" => "success",
                        "message" => "Transaction Successful"
                    ]);
                } else {
                    $transaction = Transaction::where('reference_no', $transaction_id)->update([
                        "status" => 'declined',
                        "raw_response" => $response
                    ]);
                }
            }else{
                return response()->json([
                    "status" => "error",
                    "message" => "Sope Otilo"
                ]);Ï
            }
        }

    }
}
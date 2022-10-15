<?php

namespace App\Services;

use App\Modules\Invoice\Models\Invoice;
use App\Modules\Transaction\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Http;

class Autocredit  implements IGateway {
    use ApiResponseMessagesTrait;
  public function init($gateway_type)
  {
        // fetch the current cart of the customer then create transaction for Each cart
        $invoice = Invoice::where('user_id', Auth::user()->id)
                    ->where('status', 'UNPAID')->get();
        $transaction_reference_no = $this->generateReferenceNumber(30, "Transaction");
        $amount = 0;

        $transaction = Transaction::create([
            "user_id" => Auth::user()->id,
            "invoice_id" => $invoice,
            "amount" => $amount,
            "expected_amount" => $amount,
            "transaction_reference_no" => $transaction_reference_no,
            "gateway_type" => $gateway_type,
            "reference_no" => $invoice->reference_no,
        ]);
        return [Auth::user(), $transaction];
  }

  public function verifyPayment($transaction_reference_no)
  {
    $mk = getenv('AUTOCREDIT_PRIVATE_KEY');
    $response = Http::get("https://creditpay.ng/payments/$transaction_reference_no?token=$mk");
    if($response['status'] == 'success'){
        $transaction = Transaction::where('transaction_reference_no', $transaction_reference_no)->update([
            "status" => 'approved',
            "raw_response"=>$response
        ]);
    }else{
        $transaction = Transaction::where('transaction_reference_no', $transaction_reference_no)->update([
            "status" => 'declined',
            "raw_response"=>$response
        ]);
    }
  }
    
}
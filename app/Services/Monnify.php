<?php

namespace App\Services;

use App\Modules\Cart\Models\Cart;
use App\Modules\Transaction\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Http;

class Monnify  implements IGateway {
    use ApiResponseMessagesTrait;

    public function init()
    {
      //    fetch the current cart of the customer then create transaction for Each cart
      $carts = Cart::where('user_id', Auth::user()->id)->get();
          $transaction_reference_no = $this->generateReferenceNumber(30, "Transaction");
          $amount = 0;
          foreach ($carts as $cart) {
              $amount += $cart->amount;
          }
  
          $transaction = Transaction::create([
              "user_id" => Auth::user()->id,
              "amount" => $$amount,
              "transaction_reference_no" => $transaction_reference_no,
              "reference_no" => $cart->reference_no,
          ]);
          return [Auth::user(), $transaction];
    }
  
    public function verifyPayment($transaction_reference_no)
    {
      $mk = getenv('MONNIFY_MERCHANT_KEY');
      $response = Http::get("https://sandbox.monnify.com/api/v1/sdk/transactions/query/$mk?paymentReference=$transaction_reference_no");
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
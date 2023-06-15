<?php

namespace App\Modules\Quotes\Services;

use App\Mail\ProductQuoted;
use App\Modules\Cart\Models\Cart;
use App\Modules\Quotes\Models\Quote;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class QuoteService 
{
    use ApiResponseMessagesTrait;

   public function createQuote($data)
   {
    $check = Quote::where(['product_id' => $data['product_id'], 'user_id' => Auth::user()->id])->count();
    if ($check) {
        return response()->json(["message" => "You Have Already Requested a Quote For This Product", 'status' => false], 400);
    }
    try {
        $quote = Quote::create([
            'product_id' => $data['product_id'],
            'product_name' => $data['product_name'],
            'quantity' => $data['quantity'],
            'firstName' => $data['first_name'],
            'lastName' => $data['last_name'],
            'user_id' => Auth::user()->id,
            'company' => $data['company'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address1' => $data['address1'],
            'address2' => $data['address2'],
            'postcode' => $data['postcode'],
            'city' => $data['city'],
            'region' => $data['region'],
            'country' => $data['country'],
            'VAT/MwSt Number/Tax ID' => $data['vat'],
            'deliverycountry' => $data['delcountry'],
            'deliveryoption' => $data['delopt'],
            'nearBranch' => $data['NearBranch'],
            'comment' => $data['comment'],
            'reference_id' => $data['reference_id'],
       ]);

       return response()->json(['status' => true, 'quotes' => $quote, "message" => "Quotes Requested Succesfully"], 200);
    } catch (\Throwable $th) {
        return $this->badRequest($th->getMessage());
    }
   }

   public function getQuote()
   {
        $quote = Quote::paginate(50);

        return response()->json([ 'quotes' => $quote], 200);
   }

   public function UpdatePrice($data, $reference_id)
   {
        $update = Quote::where('reference_id' , $reference_id)->first();
        $update->update([
            'price' => $data['price'],
            'status' => 'quoted'
        ]);
        $cart = Cart::where('reference_id' , $reference_id)->update([
            'status' => 'quoted',
            'price' => $data['price']
        ]);

        if ($cart) {
            Mail::to($update->email)->send(new ProductQuoted($update->email));
            return response()->json(["message" => "Successful Operation", 'status' => true], 200);
        }
        return response()->json(["message" => "An error Occured", 'status' => false], 400);
   }

   public function getSingleQuote($data, $reference_id)
   {
        $quote = Quote::where('reference_id', $reference_id)->get();

        return response()->json([ 'quotes' => $quote], 200);
   }
}

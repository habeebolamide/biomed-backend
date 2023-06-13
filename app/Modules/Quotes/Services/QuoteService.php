<?php

namespace App\Modules\Quotes\Services;

use App\Modules\Cart\Models\Cart;
use App\Modules\Quotes\Models\Quote;
use App\Traits\ApiResponseMessagesTrait;

class QuoteService 
{
    use ApiResponseMessagesTrait;

   public function createQuote($data)
   {
    // return $data;
    try {
        $quote = Quote::create([
            'product_name' => $data['product_name'],
            'quantity' => $data['quantity'],
            'firstName' => $data['fname'],
            'lastName' => $data['lname'],
            'company' => $data['company'],
            'phone' => $data['Phone'],
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
        $update = Quote::where('reference_id' , $reference_id)->update([
            'price' => $data['price'],
            'status' => 'quoted'
        ]);

        $cart = Cart::where('reference_id' , $reference_id)->update([
            'status' => 'quoted',
            'price' => $data['price']
        ]);

        if ($cart) {
            return response()->json(["message" => "Successful Operation", 'status' => true], 200);
        }
        return response()->json(["message" => "An error Occured", 'status' => false], 400);
   }
}

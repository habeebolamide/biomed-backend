<?php

namespace App\Traits;

use App\Modules\Coupon\Models\Coupon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

trait ApiResponseMessagesTrait {

    public function success($result, $message = "")
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function created($result, $message = "")
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 201);
    }

    public function nft_response($result)
    {

        return response()->json($result, 200);
    }

    public function error($result, $message="")
    {
        $response = [
            'success' => false,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 408);
    }

    public function notFoundException($message)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];
        return response()->json($response, 404);
    }

    public function unProcessedError($message)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, 422);
    }

    public function badRequest($message)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, 400);
    }

    public function badRequestWithData($data, $message)
    {
        $response = [
            'errors' => $data,
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, 400);
    }

    public function noResponse($message='deleted successfully')
    {
        return response()->json(['message' => $message], 204);
    }

    public function forbiddenResponse($message='forbidden')
    {
        return response()->json(['message' => $message], 403);
    }

    public function getMAcAddressExec()
    {
            // PHP code to get the MAC address of Server
            $MAC = exec('getmac');
            
            // Storing 'getmac' value in $MAC
            $MAC = strtok($MAC, ' ');
            
            // Updating $MAC value using strtok function, 
            // strtok is used to split the string into tokens
            // split character of strtok is defined as a space
            // because getmac returns transport name after
            // MAC address   
            // echo "MAC address of Server is: $MAC";
            return $MAC;
    }

    public function generateReferenceNumber($maxRegenerateCount = 10, $model){
        $reference_no = Str::random(30);
        // $newCode = $base58->encode(random_bytes(32));
    
        $existingKey = $model::where('reference_no', $reference_no)->first();
    
        if ($existingKey != null) {
            $maxRegenerateCount -= 1;
            if ($maxRegenerateCount >= 0) {
                return $this->generateReferenceNumber($maxRegenerateCount, $model);
            }
            return null;
        }
        return $reference_no;
    }

    public function generateCoupons($length, $maxRegenerateCount = 10)
    {
        $reference_no = Uuid::uuid4($length);
        $existingKey = Coupon::where('coupon', $reference_no)->first();
    
        if ($existingKey != null) {
            $maxRegenerateCount -= 1;
            if ($maxRegenerateCount >= 0) {
                return $this->generateCoupons($length,$maxRegenerateCount);
            }
            return null;
        }
        return $reference_no;
    }


    public function generateBarcodeNumber() {
        $number = mt_rand(1000000000, 9999999999); 
        
        if ($this->barcodeNumberExists($number)) {
            return $this->generateBarcodeNumber();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    
    private function barcodeNumberExists($number) {
        
        return Coupon::where('coupon',$number)->exists();
    }


}

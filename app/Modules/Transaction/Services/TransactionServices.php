<?php

namespace App\Modules\Transaction\Services;

use Illuminate\Http\Request;

class TransactionServices
{
    public function initializeTransaction($data)
    {
        // get the selected gateway_type
        $gateway_type = $data['selectedGatewayType'];
        
    }
}

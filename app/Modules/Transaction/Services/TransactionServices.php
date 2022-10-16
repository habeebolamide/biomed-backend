<?php

namespace App\Modules\Transaction\Services;

use App\Modules\Invoice\Models\Invoice;
use Illuminate\Http\Request;

class TransactionServices
{
    public function initializeTransaction($data, $invoice_id)
    {
        // get the selected gateway_type
        $gateway_type = $data['selectedGatewayType'];
        // get the invoice_id
        // get the invoice details
        $invoiceDetails = Invoice::where('invoice_id', $invoice_id)->sum('product_price');
        return $invoiceDetails;



        
    }
}

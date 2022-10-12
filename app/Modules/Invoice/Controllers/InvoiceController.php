<?php

namespace App\Modules\Invoice\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Cart\Requests\CartRequest;
use App\Modules\Cart\Services\CartService;
use App\Modules\Invoice\Requests\InvoiceRequest;
use App\Modules\Invoice\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
   
    public function generate_invoice(InvoiceRequest $request)
    {
       
        return (new InvoiceService)->generateInvoice($request);
    }

    public function discard_invoice(Request $request)
    {
        $request->validate([
            'reference_id' => 'required',
            'type' => 'required'
        ]);
       
        return (new InvoiceService)->discard_invoice($request);
    }

   
    

}

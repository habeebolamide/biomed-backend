<?php

namespace App\Modules\Transaction\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Transaction\Services\TransactionServices;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function initializeTransaction(Request $request, $invoice_id)
    {
        return (new TransactionServices)->initializeTransaction($request,$invoice_id);
    }

    public function checkTransactionStatus($transaction_id, $invoice_id)
    {
        return (new TransactionServices)->checkTransactionStatus($transaction_id,$invoice_id);
    }
}

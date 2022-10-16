<?php

namespace App\Modules\Transaction\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Transaction\Services\TransactionServices;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function initializeTransaction($invoice_id,$data)
    {
        return (new TransactionServices)->initializeTransaction($invoice_id,$data);
    }
}

<?php

namespace App\Services;

interface IGateway{

    public function init($gateway_type);
   
    public function verifyPayment($transaction_reference_no);

}
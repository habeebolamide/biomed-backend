<?php

namespace App\Services;

interface IGateway{

    public function init();
   
    public function verifyPayment($transaction_reference_no);

}
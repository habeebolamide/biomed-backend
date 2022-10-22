<?php

use App\Modules\ProductHistory\Controllers\ProductHistoryController;
use Illuminate\Http\Request;

function log_product_histories($product_id, $purpose, $quantity, $user_id = null)
{


    $producthistory = new ProductHistoryController;

    $requestData = new Request([
        'product_id' => $product_id,
        'purpose' => $purpose,
        'quantity' => $quantity
    ]);
    if ($user_id != null) $requestData->add(["user_id" => $user_id]);
    return $producthistory->insert($requestData);
}

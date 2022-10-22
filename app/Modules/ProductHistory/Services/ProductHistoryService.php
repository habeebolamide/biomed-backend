<?php

namespace App\Modules\ProductHistory\Services;

use App\Modules\ProductHistory\Models\ProductHistory;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\DB;

class ProductHistoryService
{
     use ApiResponseMessagesTrait;
     public function insert($data)
     {

          $product_history = new ProductHistory;

          $product_history->product_id = $data['product_id'];
          if (array_key_exists("user_id", $data->toArray())) {
               $product_history->user_id = $data['user_id'];
          }
          $product_history->purpose = $data['purpose'];
          $product_history->quantity = $data['quantity'];

          $product_history->save();


          return $this->success($product_history, "all products");
     }
}

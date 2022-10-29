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
          $product_history->quantity = $data['quantity'];;

          if ($product_history->save()) {
               return true;
          }
          return false;
     }

     public function get_histories($data)
     {
          return $this->success(ProductHistory::with(['product', 'user'])->orderBy('created_at', 'desc')->paginate(40), "Product Deleted Successfully");
     }
}

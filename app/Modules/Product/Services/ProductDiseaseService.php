<?php

namespace App\Modules\Product\Services;

use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductDisease;
use App\Traits\ApiResponseMessagesTrait;

class ProductDiseaseService 
{
    use ApiResponseMessagesTrait;
   public function allProductDiseases($data)
   {
     $category = ProductDisease::all();

     if($data["active"]) {
          if(!is_null($data["active"])) {
              $category->where('status', "like", "active");
              
          }

     }
     return $this->success($category, "all products diseases");
   }

   public function createDisease($data)
   {
        $product = ProductDisease::create([
            "disease_name"=> $data["disease_name"],
        ]);
        return $this->success($product, "Product Disease Created Successfully");
   }

   public function productDisease($product_disease_id)
   {
        $product = ProductDisease::find($product_disease_id);
        return $this->success($product, "Product Disease");
   }

   public function updateProductDisease($data, $product_disease_id)
   {
        $product = ProductDisease::where('id', $product_disease_id)->update([
            "disease_name"=> $data["disease_name"],
        ]);
        return $this->success($product, "Product Disease Updated Successfully");
   }

   public function deleteProductDisease($product_disease_id)
   {
          ProductDisease::where('id', $product_disease_id)->delete();
        return $this->success([], "Product Disease Deleted Successfully");
   }

   
}

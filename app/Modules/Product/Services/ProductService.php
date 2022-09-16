<?php

namespace App\Modules\Product\Services;

use App\Modules\Product\Models\Product;
use App\Traits\ApiResponseMessagesTrait;

class ProductService 
{
    use ApiResponseMessagesTrait;
   public function allProducts()
   {
        $category = Product::all();
        return $this->success($category, "all products");
   }

   public function createProduct($data)
   {
        $product = Product::create([
            "sub_category_id"=> $data["sub_category_id"],
            "product_disease_id"=> $data["product_disease_id"],
            "product_name"=> $data["product_name"],
            "product_slug"=> $data["product_slug"],
            "keyword"=> $data["keyword"],
            "model"=> $data["model"],
            "description"=> $data["description"],
            "content"=> $data["content"],
            "manual"=> $data["manual"],
            "is_variant"=> $data["is_variant"],
            "youtube_id"=> $data["youtube_id"],
            "measurement"=> $data["measurement"],
            'status' => $data["status"],
        ]);
        return $this->success($product, "Product Created Successfully");
   }

   public function product($product_id)
   {
        $product = Product::find($product_id);
        return $this->success($product, "Product");
   }

   public function updateProduct($data, $product_id)
   { 
        $product = Product::where('id', $product_id)->update([
            "sub_category_id"=> $data["sub_category_id"],
            "product_disease_id"=> $data["product_disease_id"],
            "product_name"=> $data["product_name"],
            "product_slug"=> $data["product_slug"],
            "keyword"=> $data["keyword"],
            "model"=> $data["model"],
            "description"=> $data["description"],
            "content"=> $data["content"],
            "manual"=> $data["manual"],
            "is_variant"=> $data["is_variant"],
            "youtube_id"=> $data["youtube_id"],
            "measurement"=> $data["measurement"],
            'status' => $data["status"],
        ]);
        return $this->success($product, "Product Updated Successfully");
   }

   public function deleteProduct($product_id)
   {
        Product::where('id', $product_id)->delete();
        return $this->success([], "Product Deleted Successfully");
   }

   
}

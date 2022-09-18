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

   public function showProduct($category_id=null, $sub_category_id=null, $inner_category_id=null, $disease_id=null)
   {
        $product = Product::join('inner_categories', 'inner_categories.id', 'products.inner_category_id')->query();
        if ($category_id) {
          $product->category_id = $category_id;
        }
        if($sub_category_id) {
          $product->sub_category_id = $sub_category_id;
        }
        if ($inner_category_id) {
          $product->inner_category_id = $inner_category_id;
        }
        if($disease_id) {
          $product->disease_id = $disease_id;
        }
        $product->get();
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

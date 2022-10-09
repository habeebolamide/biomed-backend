<?php

namespace App\Modules\Product\Services;

use App\Modules\Models\Product\ProductQuantity;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductQuantity as ModelsProductQuantity;
use App\Modules\Product\Resources\ProductResource;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\DB;

class ProductService 
{
    use ApiResponseMessagesTrait;
   public function allProducts($data)
   {
     $products = Product::select('*');
     if($data["active"]) {
          if(!is_null($data["active"])) {
               $products->where('status', "like", "active");
               
          }
     

     }
     if(!is_null($data["name"])) {
          $products->where('product_name', "like", "%".$data["name"]."%");
          
     }

     if(!is_null($data["status"])) {
          
          $products->where('status', $data["status"]);
          
     }

     if(!is_null($data["nested_sub_category_id"])) {
          $products->where('nested_sub_category_id', $data["nested_sub_category_id"]);
          
     }
     return $this->success(ProductResource::collection($products->orderBy('created_at', 'desc')->paginate(30)), "all products");
   }

   public function allAdminProducts($data)
   {
     $products = Product::select('*');
     if($data["active"]) {
          if(!is_null($data["active"])) {
               $products->where('status', "like", "active");
               
          }
     

     }
     if(!is_null($data["name"])) {
          $products->where('product_name', "like", "%".$data["name"]."%");
          
     }

     if(!is_null($data["status"])) {
          
          $products->where('status', $data["status"]);
          
     }

     if(!is_null($data["nested_sub_category_id"])) {
          $products->where('nested_sub_category_id', $data["nested_sub_category_id"]);
          
     }
     return $this->success($products->orderBy('created_at', 'desc')->paginate(30), "all products");

   }

   public function createProduct($data)
   {
        $product = Product::create([
            "nested_sub_category_id"=> $data["nested_sub_category_id"],
            "product_disease_id"=> $data["product_disease_id"],
            "product_name"=> $data["product_name"],
            "product_slug"=> $data["product_slug"],
            "keyword"=> $data["keyword"],
            "model"=> $data["model"],
            "discount"=> $data["discount"],
            "price"=> $data["price"],
            "description"=> $data["description"],
            "content"=> $data["content"],
            "manual"=> $data["manual"] ?? null,
            "is_variant"=> $data["is_variant"],
            "youtube_id"=> $data["youtube_id"],
            "measurement"=> $data["measurement"],
            'status' => $data["status"],
        ]);
        $prod = ModelsProductQuantity::updateOrCreate([
               'product_id' => $product->id,
               'quantity' => $data["quantity"]
               ]);
        return $this->success($product, "Product Created Successfully");
   }

   public function product($product_id)
   {
        $product = Product::with('nestedSubCategory.sub_category')->find($product_id);
        return $this->success(new ProductResource($product) , "Product");
   }

   public function showProduct($category_id=null, $sub_category_id=null, $nested_sub_category_id=null, $disease_id=null, $price_range=null)
   {
        $product = DB::table('products')->join('product_diseases', 'product_diseases.id', 'products.product_disease_id')
                    ->join('nested_sub_categories', 'nested_sub_categories.id', 'products.nested_sub_category_id')
                    ->join('sub_categories', 'sub_categories.id', 'nested_sub_categories.sub_category_id')
                    ->join('categories', 'categories.id', 'sub_categories.category_id')
                    ->select('*', 'products.id');
        if (!is_null($category_id)) {
          $product->where('category_id', $category_id);
        }
        if(!is_null($sub_category_id)) {
          $product->where('sub_category_id', $sub_category_id);
        }
          if (!is_null($price_range)) {
               if ($price_range == 1000) {
                    $product->where('price', '<', $price_range);
               }
          }
        if (!is_null($nested_sub_category_id)) {
          $product->where('nested_sub_category_id', $nested_sub_category_id);
        }
        if(!is_null($disease_id)){
          $product->where('disease_id', $disease_id);
        }
          // return $product->toSql();
        return $this->success(ProductResource::collection($product->paginate(30)), "Product");
   }

     public function filterProduct()
     {
          $product = DB::table('products')->join('product_diseases', 'product_diseases.id', 'products.product_disease_id')
          ->join('nested_sub_categories', 'nested_sub_categories.id', 'products.nested_sub_category_id')
          ->join('sub_categories', 'sub_categories.id', 'nested_sub_categories.sub_category_id')
          ->join('categories', 'categories.id', 'sub_categories.category_id')
          ->select('*', 'products.id');
          if (!is_null(request()->price_range)) {
               // dd(1);
               if (request()->from == 1000 && request()->to == 1000) {
                    return 1;
                    $product->where('price', '<', request()->price_range);
               } else {
                    return 2;

                    $product->whereBetween('price', [request()->from, request()->to]);
               }
          }
          if (!is_null(request()->discount)) {
               $product->whereIn('discount', request()->discount);
               
          }

          // return $product->toSql();
          return $this->success(ProductResource::collection($product->paginate(30)), "Product");
     }

   public function showProductByName($data)
   {      
     $product = DB::table('products')->join('product_diseases', 'product_diseases.id', 'products.product_disease_id')
                    ->join('nested_sub_categories', 'nested_sub_categories.id', 'products.nested_sub_category_id')
                    ->join('sub_categories', 'sub_categories.id', 'nested_sub_categories.sub_category_id')
                    ->join('categories', 'categories.id', 'sub_categories.category_id')
                    ->select('*', 'products.id');
     
     if(request()->search){
          $search = request()->search;
     // return $this->success($search, "Product");         

               $product->where('product_name','like', '%'.$search.'%')
                    ->orWhere('product_slug', 'like', '%'.$search.'%')
                    ->orWhere('disease_name', 'like', '%'.$search.'%')
                    ->orWhere('sub_category_name', 'like', '%'.$search.'%')
                    ->orWhere('category_name', 'like', '%'.$search.'%')
                    ->orWhere('content', 'like', '%'.$search.'%');
     }
     return $this->success($product->paginate(10), "Product");         
   }
   public function updateProduct($data, $product_id)
   { 
        $product = Product::where('id', $product_id)->update([
          "nested_sub_category_id"=> $data["nested_sub_category_id"],
          "product_disease_id"=> $data["product_disease_id"],
          "product_name"=> $data["product_name"],
          "product_slug"=> $data["product_slug"],
          "keyword"=> $data["keyword"],
          "model"=> $data["model"],
          "discount"=> $data["discount"],
          "price"=> $data["price"],
          "description"=> $data["description"],
          "content"=> $data["content"],
          "manual"=> $data["manual"] ?? null,
          "is_variant"=> $data["is_variant"],
          "youtube_id"=> $data["youtube_id"],
          "measurement"=> $data["measurement"],
          'status' => $data["status"],
        ]);

          $prod = ModelsProductQuantity::where([
               'product_id' => $product_id
          ])->update([
               'quantity' => $data["quantity"]
          ]);
        return $this->success($product, "Product Updated Successfully");
   }

   public function deleteProduct($product_id)
   {
        Product::where('id', $product_id)->delete();
        return $this->success([], "Product Deleted Successfully");
   }

   
}

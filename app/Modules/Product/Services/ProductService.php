<?php

namespace App\Modules\Product\Services;

use App\Modules\Models\Product\ProductQuantity;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductQuantity as ModelsProductQuantity;
use App\Modules\Product\Resources\ProductResource;
use App\Modules\ProductHistory\Controllers\ProductHistoryController;
use App\Modules\ProductHistory\Models\ProductHistory;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductService
{
     use ApiResponseMessagesTrait;
     public function allProducts($data)
     {
          $products = Product::select('*');
          if ($data["active"]) {
               if (!is_null($data["active"])) {
                    $products->where('status', "like", "active");
               }
          }
          if (!is_null($data["name"])) {
               $products->where('product_name', "like", "%" . $data["name"] . "%");
          }

          if (!is_null($data["status"])) {

               $products->where('status', $data["status"]);
          }

          if (!is_null($data["nested_sub_category_id"])) {
               $products->where('nested_sub_category_id', $data["nested_sub_category_id"]);
          }


          return $this->success($products->paginate(30));
     }




     public function allAdminProducts($data)
     {
          $products = Product::select('*');
          if ($data["active"]) {
               if (!is_null($data["active"])) {
                    $products->where('status', "like", "active");
               }
          }
          if (!is_null($data["name"])) {
               $products->where('product_name', "like", "%" . $data["name"] . "%");
          }

          if (!is_null($data["status"])) {

               $products->where('status', $data["status"]);
          }

          if (!is_null($data["nested_sub_category_id"])) {
               $products->where('nested_sub_category_id', $data["nested_sub_category_id"]);
          }
          return $this->success($products->orderBy('created_at', 'desc')->paginate(30), "all products");
     }

     public function createProduct($data)
     {
          $discount = $data["price"];
          if ($data["discount"]) {
               $discount = $data["price"] - $data["discount"] / 100 * $data["price"];
          }
          $product = Product::create([
               "nested_sub_category_id" => $data["nested_sub_category_id"],
               "product_disease_id" => $data["product_disease_id"],
               "product_name" => $data["product_name"],
               "product_slug" => $data["product_slug"],
               "keyword" => $data["keyword"],
               "model" => $data["model"],
               "discount" => $data["discount"],
               "price" => $data["price"],
               "discount_price" => $discount,
               "description" => $data["description"],
               "content" => $data["content"],
               "manual" => $data["manual"] ?? null,
               "is_variant" => $data["is_variant"],
               "youtube_id" => $data["youtube_id"],
               "measurement" => $data["measurement"],
               'status' => $data["status"],
          ]);
          $prod = ModelsProductQuantity::updateOrCreate([
               'product_id' => $product->id,
               'quantity' => $data["quantity"]
          ]);
          // Create history


          $inserProductHistory = log_product_histories($product["id"], "Admin created a product", $prod['quantity']);
          if ($inserProductHistory) {
               return $this->success($product, "Product Created Successfully");
          }
          return $this->badRequest("Something went wrong while creating product history");
     }

     public function product($product_id)
     {
          $product = Product::with('nestedSubCategory.sub_category')->find($product_id);
          return $this->success(new ProductResource($product), "Product");
     }

     public function showProduct($category_id = null, $sub_category_id = null, $nested_sub_category_id = null, $disease_id = null, $price_range = null)
     {
          $product = DB::table('products')->join('product_diseases', 'product_diseases.id', 'products.product_disease_id')
               ->join('nested_sub_categories', 'nested_sub_categories.id', 'products.nested_sub_category_id')
               ->join('sub_categories', 'sub_categories.id', 'nested_sub_categories.sub_category_id')
               ->join('categories', 'categories.id', 'sub_categories.category_id')
               ->select('*', 'products.id');
          if (!is_null($category_id)) {
               $product->where('category_id', $category_id);
          }
          if (!is_null($sub_category_id)) {
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
          if (!is_null($disease_id)) {
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
                    // return request()->price_range;
                    $product->where('price', '<=', request()->price_range);
               } else {
                    // return 2;

                    $product->whereBetween('price', [request()->from, request()->to]);
               }
          }
          if (sizeof(request()->discount)) {
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

          if (request()->search) {
               $search = request()->search;
               // return $this->success($search, "Product");         

               $product->where('product_name', 'like', '%' . $search . '%')
                    ->orWhere('product_slug', 'like', '%' . $search . '%')
                    ->orWhere('disease_name', 'like', '%' . $search . '%')
                    ->orWhere('sub_category_name', 'like', '%' . $search . '%')
                    ->orWhere('category_name', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
          }
          return $this->success($product->paginate(10), "Product");
     }
     public function updateProduct($data, $product_id)
     {
          $discount = $data["price"];
          if ($data["discount"]) {
               $discount = $data["price"] - $data["discount"] / 100 * $data["price"];
          }
          $product = Product::where('id', $product_id)->update([
               "nested_sub_category_id" => $data["nested_sub_category_id"],
               "product_disease_id" => $data["product_disease_id"],
               "product_name" => $data["product_name"],
               "product_slug" => $data["product_slug"],
               "keyword" => $data["keyword"],
               "model" => $data["model"],
               "discount" => $data["discount"],
               "price" => $data["price"],
               "discount_price" => $discount,
               "description" => $data["description"],
               "content" => $data["content"],
               "manual" => $data["manual"] ?? null,
               "is_variant" => $data["is_variant"],
               "youtube_id" => $data["youtube_id"],
               "measurement" => $data["measurement"],
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
          try {
               ModelsProductQuantity::where('product_id', $product_id)->delete();
               // ProductHistory::where('product_id', $product_id)->delete();
               Product::where('id', $product_id)->delete();
               return $this->success([], "Product Deleted Successfully");


               //code...
          } catch (\Throwable $th) {
               return $this->badRequest($th->getMessage(), "Unable to  Delete Product");
          }
     }



     // ANALYTICS

     public function admin_sale_report($data)
     {
          $days = (int) $data['days'];
          $amounts = [];
          $dates = [];
          $authUser = auth()->user()->active_merchant;

          $data = DB::select("
            SELECT SUM(expected_amount) as amount_paid, created_at FROM `transactions` 
            WHERE created_at>= DATE_ADD(CURDATE(), INTERVAL -$days DAY) AND status='APPROVED'
            GROUP BY created_at;
       ");


          foreach ($data as $key => $value) {
               $amounts[] = (int) $value->amount_paid;
               $dates[] = explode(" ", $value->created_at)[0];
          }

          return response()->json(['success' => true, 'data' => ["dates" => $dates, "amounts" => $amounts]], 200);
     }

     public function admin_category_purchase_report($data)
     {


          $data = DB::select("
               SELECT slug as x , 
               (
                    select count(orders.id) as total from orders join products p on p.id = orders.product_id
                    join nested_sub_categories nsc on nsc.id = p.nested_sub_category_id
                    join sub_categories sbc on sbc.id = nsc.sub_category_id
                    where category_id = categories.id
               ) as y FROM `categories`;
       ");


          return response()->json(['success' => true, 'data' => $data], 200);
     }

     public function categories_by_name($data)
     {


          $data = DB::select("
               SELECT slug, category_name  FROM `categories`;
       ");


          return response()->json(['success' => true, 'data' => $data], 200);
     }
     public function income($data)
     {

          $data = DB::select("
               SELECT 
                    count(IF(tr.status='APPROVED', 1, NULL)) as income,
                    count(IF(orders.status='completed', 1,NULL)) as delivered_orders,
                    count(orders.id) as orders
               FROM `orders` 
               join invoices on invoices.product_id = orders.product_id
               join transactions tr on tr.invoice_id = invoices.id;
       ");


          return response()->json(['success' => true, 'data' => $data[0]], 200);
     }
}

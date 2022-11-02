<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Modules\Product\Requests\CreateProductRequest;
use App\Modules\Product\Requests\SearchProductRequest;
use App\Modules\Product\Services\ProductService;
use App\Modules\ProductHistory\Services\ProductHistoryService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return (new ProductService)->allProducts($request);
    }
    public function admin_index(Request $request)
    {
        return (new ProductService)->allAdminProducts($request);
    }

    public function admin_product_history(Request $request)
    {
        return (new ProductHistoryService)->get_histories($request);
    }



    public function store(CreateProductRequest $request)
    {
        return (new ProductService)->createProduct($request->validated());
    }


    public function show($product_id)
    {
        return (new ProductService)->product($product_id);
    }

    public function showProduct($category_id = null, $sub_category_id = null, $inner_category_id = null, $disease_id = null)
    {
        return (new ProductService)->showProduct($category_id, $sub_category_id, $inner_category_id);
    }

    public function filterProduct()
    {
        return (new ProductService)->filterProduct();
    }

    public function showProductByName(SearchProductRequest $request)
    {
        return (new ProductService)->showProductByName($request->validated());
    }


    public function update(CreateProductRequest $request, $product_id)
    {
        return (new ProductService)->updateProduct($request->validated(), $product_id);
    }


    public function destroy($product_id)
    {
        return (new ProductService)->deleteProduct($product_id);
    }


    public function admin_sale_report(Request $request)
    {
        return (new ProductService)->admin_sale_report($request);
    }

    public function admin_category_purchase_report(Request $request)
    {
        return (new ProductService)->admin_category_purchase_report($request);
    }

    public function categories_by_name(Request $request)
    {
        return (new ProductService)->categories_by_name($request);
    }

    public function income(Request $request)
    {
        return (new ProductService)->income($request);
    }
}

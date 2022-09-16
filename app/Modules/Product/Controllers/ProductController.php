<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Modules\Product\Requests\CreateProductRequest;
use App\Modules\Product\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return (new ProductService)->allProducts();
    }

    public function store(CreateProductRequest $request)
    {
       return (new ProductService)->createProduct($request->validated());
    }


    public function show($product_id)
    {
        return (new ProductService)->createProduct($product_id);
    }


    public function update(Request $request, $product_id)
    {
       return (new ProductService)->updateProduct($request->validated(), $product_id);
    }

    
    public function destroy($product_id)
    {
        return (new ProductService)->deleteProduct($product_id);
    }
}

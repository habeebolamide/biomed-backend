<?php

namespace App\Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductSubCategory;
use App\Modules\Product\Requests\CreateProductDiseaseRequest;
use App\Modules\Product\Services\ProductDiseaseService;
use Illuminate\Http\Request;

class ProductDiseaseController extends Controller
{
    public function index(Request $request)
    {
        return (new ProductDiseaseService)->allProductDiseases($request);
    }

    public function show($product_disease_id)
    {
        return (new ProductDiseaseService)->productDisease($product_disease_id);
    }

    public function store(CreateProductDiseaseRequest $request)
    {
        return (new ProductDiseaseService)->createDisease($request->validated());
    }

    public function update(CreateProductDiseaseRequest $request, $category_id)
    {
        return (new ProductDiseaseService)->updateProductDisease($request->validated(), $category_id);
    }

    public function destroy($category_id)
    {
        return (new ProductDiseaseService)->deleteProductDisease($category_id);
    }

}

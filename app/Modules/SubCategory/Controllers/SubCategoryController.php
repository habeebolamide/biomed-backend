<?php

namespace App\Modules\SubCategory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\SubCategory\Requests\CreateSubCategoryRequest;
use App\Modules\SubCategory\Services\SubCategoryService;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        return (new SubCategoryService)->allSubCategories();
    }

    public function show($sub_category_id)
    {
        return (new SubCategoryService)->subCategory($sub_category_id);
    }

    public function showSubCategory($category_id)
    {
        return (new SubCategoryService)->showSubCategory($category_id);
    }

    public function store(CreateSubCategoryRequest $request)
    {
        return (new SubCategoryService)->createSubCategory($request->validated());
    }

    public function update(CreateSubCategoryRequest $request, $category_id)
    {
        return (new SubCategoryService)->updateSubCategory($request->validated(), $category_id);
    }

    public function destroy($category_id)
    {
        return (new SubCategoryService)->deleteSubCategory($category_id);
    }
}

<?php

namespace App\Modules\NestedSubCategory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\NestedSubCategory\Requests\CreateNestedSubCategoryRequest;
use App\Modules\NestedSubCategory\Services\NestedSubCategoryService;
use Illuminate\Http\Request;

class NestedSubCategoryController extends Controller
{
    public function index(Request $request)
    {
        return (new NestedSubCategoryService)->allSubCategories($request);
    }

    public function show($sub_category_id)
    {
        return (new NestedSubCategoryService)->subCategory($sub_category_id);
    }

    public function showSubCategory($category_id, Request $request)
    {
        return (new NestedSubCategoryService)->showSubCategory($category_id, $request);
    }

    public function store(CreateNestedSubCategoryRequest $request)
    {
        return (new NestedSubCategoryService)->createSubCategory($request->validated());
    }

    public function update(CreateNestedSubCategoryRequest $request, $category_id)
    {
        return (new NestedSubCategoryService)->updateSubCategory($request->validated(), $category_id);
    }

    public function destroy($category_id)
    {
        return (new NestedSubCategoryService)->deleteSubCategory($category_id);
    }
}

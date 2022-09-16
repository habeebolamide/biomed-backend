<?php

namespace App\Modules\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Category\Requests\CreateCategoryRequest;
use App\Modules\Category\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return (new CategoryService)->allCategories($request->all());
    }

    public function show($category_id)
    {
        return (new CategoryService)->category($category_id);
    }

    public function store(CreateCategoryRequest $request)
    {
        return (new CategoryService)->createCategory($request->validated());
    }

    public function update(CreateCategoryRequest $request, $category_id)
    {
        return (new CategoryService)->updateCategory($request->validated(), $category_id);
    }

    public function destroy($category_id)
    {
        return (new CategoryService)->deleteCategory($category_id);
    }

}

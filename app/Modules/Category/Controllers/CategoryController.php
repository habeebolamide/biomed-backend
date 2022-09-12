<?php

namespace App\Modules\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Requests\CreateCategoryRequest;
use App\Modules\Auth\Services\CategoryService;
use App\Modules\Category\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return (new CategoryService)->allCategories();
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

<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\Models\User;
use App\Modules\Category\Models\Category;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;

class CategoryService 
{
    use ApiResponseMessagesTrait;
   public function allCategories()
   {
        $category = Category::all();
        return $this->success($category, "all categories");
   }

   public function category($category_id)
   {
        $category = Category::where('id', $category_id)->first();
        return $this->success($category, "all categories");
   }

   public function createCategory($data)
   {
        $category = Category::create([
            'category_name' => $data['category_name'],
            'status' => $data['status'],
        ])->get();
        return $this->success($category, "Category Created Successfully");
   }

   public function updateCategory($data, $category_id)
   {
        $category = Category::where('id', $category_id)->update([
            'category_name' => $data['category_name'],
            'status' => $data['status'],
        ])->get();
        return $this->success($category, "Category Updated Successfully");
   }

   public function deleteCategory($category_id)
   {
    try {
        Category::where('id', $category_id)->delete()->get();
        return $this->success([], "Category deleted Successfully");
    } catch (\Throwable $th) {
        return $this->badRequest("Category Can'\t be deleted, it has been attached to a product");
    }
   }
}

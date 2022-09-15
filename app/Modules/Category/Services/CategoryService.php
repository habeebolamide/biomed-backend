<?php

namespace App\Modules\Category\Services;

use App\Modules\Category\Models\Category;
use App\Traits\ApiResponseMessagesTrait;

class CategoryService 
{
    use ApiResponseMessagesTrait;
   public function allCategories($data)
   {
        $category = Category::with('subCategory');

        if($data["filters"]) {
            if(!is_null($data["filters"]["search"])) {
                $category->where('category_name', "like", "%".$data["filters"]["search"]."%");
                
            }

        }
        
        return $this->success($category->orderBy('created_at', 'desc')->get(), "all categories");
   }

   public function category($category_id)
   {
        try {
            $category = Category::with('subCategory')->where('id', $category_id)->firstOrFail();
            return $this->success($category, "all categories");
        } catch (\Throwable $th) {
            return $this->badRequest("Category Does not exist");
        }
        
   }

   public function createCategory($data)
   {
        $category = Category::create([
            'category_name' => $data['category_name'],
            'description' => $data['description'],
            'slug' => $data['slug'],
            'status' => $data['status'],
        ])->get();
        return $this->success($category, "Category Created Successfully");
   }

   public function updateCategory($data, $category_id)
   {
        $category = Category::where('id', $category_id)->update([
            'category_name' => $data['category_name'],
            'description' => $data['description'],
            'slug' => $data['slug'],
            'status' => $data['status'],
        ]);
        return $this->success($category, "Category Updated Successfully");
   }

   public function deleteCategory($category_id)
   {
    try {
        Category::where('id', $category_id)->delete();
        return $this->success([], "Category deleted Successfully");
    } catch (\Throwable $th) {
        return $this->badRequest("Category Can'\t be deleted, it has been attached to a product");
    }
   }
}

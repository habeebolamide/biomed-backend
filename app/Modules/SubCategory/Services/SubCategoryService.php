<?php

namespace App\Modules\SubCategory\Services;

use App\Modules\Auth\Models\User;
use App\Modules\Category\Models\Category;
use App\Modules\SubCategory\Models\SubCategory;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;

class SubCategoryService 
{
    use ApiResponseMessagesTrait;
   public function allSubCategories()
   {
        $category = SubCategory::with('category')->get();
        return $this->success($category, "all sub-categories");
   }

   public function subCategory($sub_category_id)
   {
        try {
            $category = SubCategory::with('category')->where('id', $sub_category_id)->firstOrFail();
            return $this->success($category, "Sub Category");
        } catch (\Throwable $th) {
            return $this->badRequest("Sub category does not exist");
        }
        
   }

   public function showSubCategory($category_id)
   {
       $category = SubCategory::where('category_id', $category_id)->get();
       return $this->success($category, "Sub Categories");
   }


   public function createSubCategory($data)
   {
        $category = SubCategory::create([
            'category_id' => $data['category_id'],
            'sub_category_name' => $data['sub_category_name'],
            'status' => $data['status'],
        ])->get();
        return $this->success($category, "Category Created Successfully");
   }

   public function updateSubCategory($data, $sub_category_id)
   {
        try {
            $category = SubCategory::where('id', $sub_category_id)->update([
                'category_id' => $data['category_id'],
                'sub_category_name' => $data['sub_category_name'],
                'status' => $data['status'],
            ]);
            return $this->success($category, "Sub Category Updated Successfully");
        } catch (\Throwable $th) {
            //throw $th;
            return $this->badRequest($th->getMessage());
        }
        
   }

   public function deleteSubCategory($category_id)
   {
    try {
        SubCategory::where('id', $category_id)->delete()->get();
        return $this->success([], "Category deleted Successfully");
    } catch (\Throwable $th) {
        return $this->badRequest("Category Can'\t be deleted, it has been attached to a product");
    }
   }
}

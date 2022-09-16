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
        $category = SubCategory::with(['category', 'innerCategory'])->get();
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

   public function showSubCategory($category_id, $data)
   {
       $category = SubCategory::where('category_id', $category_id);

       if($data["filters"]) {
        if(!is_null($data["filters"]["search"])) {
            $category->where('sub_category_name', "like", "%".$data["filters"]["search"]."%");
            
        }

    }
       return $this->success($category->orderBy('created_at', 'desc')->get(), "Sub Categories");
   }


   public function createSubCategory($data)
   {
        $category = SubCategory::create([
            'category_id' => $data['category_id'],
            'sub_category_name' => $data['sub_category_name'],
            'description' => $data['description'],
            'slug' => $data['slug'],
            'status' => $data['status'],
        ])->get();
        return $this->success($category, "Category Created Successfully");
   }

   public function updateSubCategory($data, $sub_category_id)
   {
        try {
            $category = SubCategory::where('id', $sub_category_id)->update([
                'category_id' => $data['category_id'],
                'description' => $data['description'],
                'slug' => $data['slug'],
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
        SubCategory::where('id', $category_id)->delete();
        return $this->success([], "Category deleted Successfully");
    } catch (\Throwable $th) {
        return $this->badRequest("Category Can'\t be deleted, it has been attached to a product");
    }
   }
}

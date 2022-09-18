<?php

namespace App\Modules\InnerCategory\Services;

use App\Modules\Auth\Models\User;
use App\Modules\InnerCategory\Models\InnerCategory;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;

class InnerCategoryService 
{
    use ApiResponseMessagesTrait;
   public function allInnerCategories()
   {
        $category = InnerCategory::with('subCategory')->get();
        return $this->success($category, "all inner-categories");
   }

   public function innerCategory($inner_category_id)
   {
        try {
            $category = InnerCategory::with('subCategory')->where('id', $inner_category_id)->firstOrFail();
            return $this->success($category, "Inner Category");
        } catch (\Throwable $th) {
            return $this->badRequest("Inner category does not exist");
        }
        
   }

   public function showInnerCategory($sub_category_id, $data)
   {
       $category = InnerCategory::where('sub_category_id', $sub_category_id);

       if($data["filters"]) {
        if(!is_null($data["filters"]["search"])) {
            $category->where('inner_category_name', "like", "%".$data["filters"]["search"]."%");
            
        }

    }
       return $this->success($category->orderBy('created_at', 'desc')->get(), "Inner Categories");
   }


   public function createinnerCategory($data)
   {
        request()->validate([
            $data['sub_category_id'] => ['required'],
            $data['name'] => ['required'],
            $data['slug'] => ['required'],
        ]);
        $category = InnerCategory::create([
            'sub_category_id' => $data['sub_category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'status' => $data['status'],
        ])->get();
        return $this->success($category, "Inner Category Created Successfully");
   }

   public function updateSubCategory($data, $inner_category_id)
   {
        request()->validate([
            $data['sub_category_id'] => ['required'],
            $data['name'] => ['required'],
            $data['slug'] => ['required'],
        ]);
        try {
            $category = InnerCategory::where('id', $inner_category_id)->update([
                'sub_category_id' => $data['sub_category_id'],
                'name' => $data['name'],
                'slug' => $data['slug'],
                'status' => $data['status'],
            ]);
            return $this->success($category, "Inner Category Updated Successfully");
        } catch (\Throwable $th) {
            //throw $th;
            return $this->badRequest($th->getMessage());
        }
        
   }

//    public function deleteInnerCategory($category_id)
//    {
//     try {
//         SubCategory::where('id', $category_id)->delete();
//         return $this->success([], "Category deleted Successfully");
//     } catch (\Throwable $th) {
//         return $this->badRequest("Category Can'\t be deleted, it has been attached to a product");
//     }
//    }
}

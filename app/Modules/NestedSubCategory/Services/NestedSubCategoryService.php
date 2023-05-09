<?php

namespace App\Modules\NestedSubCategory\Services;

use App\Models\Pathogen;
use App\Modules\Auth\Models\User;
use App\Modules\NestedSubCategory\Models\NestedSubCategory as ModelsNestedSubCategory;
use App\Modules\SubCategory\Models\NestedSubCategory;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Auth;

class NestedSubCategoryService
{
    use ApiResponseMessagesTrait;
    public function allSubCategories($data)
    {
        $category = ModelsNestedSubCategory::with('sub_category');
        if ($data["active"]) {
            if (!is_null($data["active"])) {
                $category->where('status', $data["active"]);
            }
        }
        return $this->success($category->orderBy('created_at', 'desc')->get(), "All Nested SubCategory ");
    }

    public function subCategory($sub_category_id)
    {
        try {
            $category = ModelsNestedSubCategory::with('sub_category')->where('id', $sub_category_id)->firstOrFail();
            return $this->success($category, "Sub Category");
        } catch (\Throwable $th) {
            return $this->badRequest("Sub category does not exist");
        }
    }

    public function showSubCategory($category_id, $data)
    {
        $category = ModelsNestedSubCategory::where('sub_category_id', $category_id);

        if ($data["filters"]) {
            if (!is_null($data["filters"]["search"])) {
                $category->where('name', "like", "%" . $data["filters"]["search"] . "%");
            }
        }
        return $this->success($category->orderBy('created_at', 'desc')->get(), "Nested SubCategory");
    }


    public function createSubCategory($data)
    {
        $category = ModelsNestedSubCategory::create([
            'sub_category_id' => $data['sub_category_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'slug' => $data['slug'],
            'status' => $data['status'],
        ])->get();
        return $this->success($category, "Nested SubCategory Created Successfully");
    }

    public function updateSubCategory($data, $sub_category_id)
    {
        try {
            $category = ModelsNestedSubCategory::where('id', $sub_category_id)->update([
                'sub_category_id' => $data['sub_category_id'],
                'description' => $data['description'],
                'slug' => $data['slug'],
                'name' => $data['name'],
                'status' => $data['status'],
            ]);
            return $this->success($category, "Nested SubCategory Updated Successfully");
        } catch (\Throwable $th) {
            //throw $th;
            return $this->badRequest($th->getMessage());
        }
    }

    public function deleteSubCategory($category_id)
    {
        try {
            ModelsNestedSubCategory::where('id', $category_id)->delete();
            return $this->success([], "Nested SubCategory deleted Successfully");
        } catch (\Throwable $th) {
            return $this->badRequest("Category Can'\t be deleted, it has been attached to a product");
        }
    }
    /*
     To get all pathogens mapped with technology(nested_subcategory) 
   */

    //  public function Pathogens()
    //  {
    //     $pathogens = Pathogen::all();
    //     return $this->success($pathogens->orderBy('created_at', 'desc')->get(), "All Available Pathogen");
    //  }

    /*
    end To get all pathogens mapped with technology(nested_subcategory) 
   */

    public function get_nested_category_by_id_as_technology($data)
    {
        // dd($data);
        try {
            $technology  = ModelsNestedSubCategory::where('sub_category_id',$data["nested_cat_id"])->get();
            return $this->success($technology, "All Technology");
        } catch (\Throwable $th) {
            return $this->badRequest("Tech Not Existed");
        }
    }
}

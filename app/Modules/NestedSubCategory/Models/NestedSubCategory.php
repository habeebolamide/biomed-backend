<?php

namespace App\Modules\NestedSubCategory\Models;

use App\Modules\Category\Models\Category;
use App\Modules\Product\Models\Product;
use App\Modules\SubCategory\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NestedSubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['full_name'];
   //  protected $with = ['products', 'sub_category'];
    
    public function sub_category()
     {
        return $this->belongsTo(SubCategory::class);
     }
    public function products()
    {
       return $this->hasMany(Product::class);
    }

    public function getFullNameAttribute()
    {
      $name= SubCategory::where('id', $this->sub_category_id)->first()->sub_category_name ?? null;
      

      return $this->name ." ($name)";
         
      return null;
    }
}

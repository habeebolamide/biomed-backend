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
   //  protected $with = ['products', 'sub_category'];
    
    public function sub_category()
     {
        return $this->belongsTo(SubCategory::class);
     }
    public function products()
    {
       return $this->hasMany(Product::class);
    }
}

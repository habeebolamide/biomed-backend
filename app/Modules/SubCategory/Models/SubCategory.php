<?php

namespace App\Modules\SubCategory\Models;

use App\Modules\Category\Models\Category;
use App\Modules\InnerCategory\Models\InnerCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['category', 'innerCategory'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
     public function innerCategory()
     {
        return $this->hasMany(InnerCategory::class);
     }
    public function products()
    {
       return $this->hasMany(Product::class);
    }
}

<?php

namespace App\Modules\Product\Models;

use App\Modules\NestedSubCategory\Models\NestedSubCategory;
use App\Modules\SubCategory\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['nestedSubCategory', 'ProductDisease'];
    public function nestedSubCategory()
    {
        return $this->belongsTo(NestedSubCategory::class);
    }
    public function ProductDisease()
    {
        return $this->belongsTo(ProductDisease::class);
    }
}

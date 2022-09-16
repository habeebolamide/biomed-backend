<?php

namespace App\Modules\Product\Models;

use App\Modules\SubCategory\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['subCategory', 'ProductDisease'];
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function ProductDisease()
    {
        return $this->belongsTo(ProductDisease::class);
    }
}

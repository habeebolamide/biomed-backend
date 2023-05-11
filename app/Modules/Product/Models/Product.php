<?php

namespace App\Modules\Product\Models;

use App\Modules\NestedSubCategory\Models\NestedSubCategory;
use App\Modules\SubCategory\Models\SubCategory;
use App\Modules\Pictures\Models\Picture;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['ProductDisease','ProductQuantity','picture'];
    public function nestedSubCategory()
    {
        return $this->belongsTo(NestedSubCategory::class);
    }
    public function ProductDisease()
    {
        return $this->belongsTo(ProductDisease::class);
    }

    public function ProductQuantity()
    {
        return $this->HasOne(ProductQuantity::class, 'product_id', 'id');
    }

    public function picture()
    {
        return $this->hasMany(Picture::class,'pictureable_id', 'id')->orderBy('created_at', 'desc');
    }
   
}

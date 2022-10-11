<?php

namespace App\Modules\Category\Models;

use App\Modules\Pictures\Models\Picture;
use App\Modules\SubCategory\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subCategory()
    {
        return $this->hasMany(SubCategory::class)->orderBy('created_at', 'desc');
    }

    public function picture()
    {
        return $this->hasMany(Picture::class,'pictureable_id', 'id')->orderBy('created_at', 'desc');

    }
    
}

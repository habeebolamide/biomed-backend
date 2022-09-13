<?php

namespace App\Modules\Category\Models;

use App\Modules\SubCategory\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }
}

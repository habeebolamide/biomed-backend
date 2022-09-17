<?php

namespace App\Modules\InnerCategory\Models;

use App\Modules\SubCategory\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InnerCategory extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}

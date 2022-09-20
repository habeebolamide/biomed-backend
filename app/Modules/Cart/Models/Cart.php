<?php

namespace App\Modules\Cart\Models;

use App\Modules\Auth\Models\User;
use App\Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * The attributes that should be cast.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }
}

<?php

namespace App\Modules\Invoice\Models;

use App\Modules\Address\Models\UserAddress;
use App\Modules\Auth\Models\User;
use App\Modules\Coupon\Models\Coupon;
use App\Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ["product","user","address"];
    /**
     * The attributes that should be cast.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class);
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}

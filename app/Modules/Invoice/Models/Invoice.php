<?php

namespace App\Modules\Invoice\Models;

use App\Modules\Address\Models\UserAddress;
use App\Modules\Auth\Models\User;
use App\Modules\Coupon\Models\Coupon;
use App\Modules\Product\Models\Product;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ["product","user","address","coupon"];
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
    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function createdAt() : Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->format('Y-M-d')
        );
    }
}

<?php

namespace App\Modules\Auth\Models;

use App\Modules\Address\Models\UserAddress;
use App\Modules\Order\Models\Order;
use App\Modules\UserMessage\Models\CustomerMessages;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function WishLists()
    {
        return $this->hasMany(WishLists::class);
    }

    public function carts()
    {
        return $this->hasMany(WishLists::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function customer_messages(): HasMany
    {
        return $this->hasMany(CustomerMessages::class, 'user_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }
}

<?php

namespace App\Modules\WishList\Model;

use App\Modules\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
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
}

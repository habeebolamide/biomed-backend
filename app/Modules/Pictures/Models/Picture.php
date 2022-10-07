<?php

namespace App\Modules\Pictures\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function pictureable()
    {
        return $this->morphTo();
    }
}

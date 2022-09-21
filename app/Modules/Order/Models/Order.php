<?php

namespace App\Modules\Order\Models;

use App\Models\Product;
use App\Modules\Product\Models\Product as ModelsProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['products'];

    public function products():BelongsTo
    {
        return $this->belongsTo(ModelsProduct::class, 'product_id','id');
    }
}

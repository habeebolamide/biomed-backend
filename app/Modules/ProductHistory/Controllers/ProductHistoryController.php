<?php

namespace App\Modules\ProductHistory\Controllers;

use App\Http\Controllers\Controller;

use App\Modules\ProductHistory\Services\ProductHistoryService;

use App\Modules\Product\Services\Prod;
use Illuminate\Http\Request;


class ProductHistoryController extends Controller
{
    public function insert(Request $request)
    {
        return (new ProductHistoryService)->insert($request);
    }
}

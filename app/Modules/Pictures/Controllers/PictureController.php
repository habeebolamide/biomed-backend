<?php

namespace App\Modules\Pictures\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pictures\Requests\PictureRequest;
use App\Modules\Pictures\Services\PictureService;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function productPicture(PictureRequest $request, $product_id)
    {
       return (new PictureService)->attachProductPicture($product_id, $request->validated());
    }
}

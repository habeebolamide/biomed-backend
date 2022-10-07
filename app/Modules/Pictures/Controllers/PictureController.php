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
       return (new PictureService)->attachProductPicture($request->validated(), $product_id);
    }

    public function removePicture($picture_id)
    {
       return (new PictureService)->removePicture($picture_id);
    }

    public function updatePicture(PictureRequest $request,$picture_id)
    {
       return (new PictureService)->updatePicture($request->validated(), $picture_id);
    }

    public function categoryPicture(PictureRequest $request, $category_id)
    {
       return (new PictureService)->attachCategoryPicture($request->validated(), $category_id);
    }
}

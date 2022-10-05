<?php

namespace App\Modules\Pictures\Services;

use App\Modules\Category\Models\Category;
use App\Modules\Pictures\Models\Picture;
use App\Modules\Product\Models\Product;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PictureService 
{
    use ApiResponseMessagesTrait;

    public function attachProductPicture($data, $product_id)
    {
        $page_link = uniqid();
        if ($data['picture']) {
            $folderPath = public_path().'/'.'Image/';
            $image_parts = explode(';base64,', $data['picture']);
            $image_type = 'png';
            $image_base64 = base64_decode($image_parts[1]);

            $filename = $page_link.'.'.$image_type;
            // file_put_contents($folderPath.$filename, $image_base64);
            File::put($folderPath.$filename, $image_base64);
            $picture = asset('Image/'.$filename) ?? null;
        }

        $picture = Picture::create([
            "pictureable_id" => $product_id,
            "pictureable_type" => Product::class,
            "picture" => $picture
        ]);
        return $this->success([], "Picture Uploaded successfully");
    }

    public function attachCategoryPicture($data, $category_id)
    {
        $page_link = uniqid();

        if ($data['picture']) {
            $folderPath = public_path().'/'.'Image/';
            $image_parts = explode(';base64,', $data['picture']);
            $image_type = 'png';
            $image_base64 = base64_decode($image_parts[1]);

            $filename = $page_link.'.'.$image_type;
            // file_put_contents($folderPath.$filename, $image_base64);
            File::put($folderPath.$filename, $image_base64);
            $picture = asset('Image/'.$filename) ?? null;
        }

        $picture = Picture::create([
            "pictureable_id" => $category_id,
            "pictureable_type" => Category::class,
            "picture" => $picture
        ]);

        return $this->success([], "Picture Uploaded successfully");
    }
 
}

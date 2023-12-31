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
            if (!file_exists(public_path().'/'.'Image/')) {
                mkdir(public_path().'/'.'Image/', 0777, true);
            }
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


    public function removePicture($picture_id)
    {
        $picture=Picture::find($picture_id);
        if(is_null($picture)) return $this->badRequest("Could not find reference for the given ID");
        $name= explode("/", $picture->picture);
        
        if(file_exists(public_path().'/'.'Image/Categories/').$name[count($name) -1]) {
            unlink(public_path().'/'.'Image/Categories/'.$name[count($name) -1]);
            $picture->delete();
        }
        
        return $this->success([], "Picture deleted successfully");
    }

    public function removeProductPicture($picture_id)
    {
        $picture=Picture::find($picture_id);
        if(is_null($picture)) return $this->badRequest("Could not find reference for the given ID");
        $name= explode("/", $picture->picture);
        
        if(file_exists(public_path().'/'.'Image/').$name[count($name) -1]) {
            unlink(public_path().'/'.'Image/'.$name[count($name) -1]);
            $picture->delete();
        }
        
        return $this->success([], "Picture deleted successfully");
    }

    public function updatePicture($data, $picture_id)
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
        Picture::where('id',$picture_id)->update([
            "picture" => $picture
        ]);
        return $this->success([], "Picture deleted successfully");
    }


    public function attachCategoryPicture($data, $category_id)
    {
        $page_link = uniqid();

        if ($data['picture']) {
            $folderPath = public_path().'/'.'Image/Categories/';
            $image_parts = explode(';base64,', $data['picture']);
            $image_type = 'png';
            $image_base64 = base64_decode($image_parts[1]);

            $filename = $page_link.'.'.$image_type;
            if (!file_exists(public_path().'/'.'Image/Categories/')) {
                mkdir(public_path().'/'.'Image/Categories/', 0777, true);
            }
            // file_put_contents($folderPath.$filename, $image_base64);
            File::put($folderPath.$filename, $image_base64);
            $picture = asset('Image/Categories/'.$filename) ?? null;
        }

        $picture = Picture::create([
            "pictureable_id" => $category_id,
            "pictureable_type" => Category::class,
            "picture" => $picture
        ]);

        return $this->success([], "Picture Uploaded successfully");
    }
 
}

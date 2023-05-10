<?php

namespace App\Modules\BackgroundSlider\Services;
use App\Modules\BackgroundSlider\Models\BackgroundSlider;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\Storage;

class BackgroundSliderService  
{
    use ApiResponseMessagesTrait;

    public function allSlider($data)
    {
        return $this->success(BackgroundSlider::limit(5)->get(), "all sliders");
    }

    public function createSlider($data)
   {
    $url = null;
        if ($data['slider_image']) {
            $original_name = $data['slider_image']->getClientOriginalName();
           $path = Storage::putFileAs('public/sliders',$data['slider_image'],$original_name);
            $file = storage_path('app/'.$path);
            $url = asset('storage/sliders/'.$original_name);
        }

        $category = BackgroundSlider::create([
            'slider_image' => $url,
            'slider_text' => $data['slider_text'],
            'status' => $data['status']
        ]);
        return $this->success($category, "Slider Created Successfully");
   }


}
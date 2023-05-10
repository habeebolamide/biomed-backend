<?php

namespace App\Modules\BackgroundSlider\Requests;

use Illuminate\Foundation\Http\FormRequest;


class BackgroundSliderRequest extends FormRequest {
 /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slider_image' => 'required',
            'slider_text' => 'sometimes',
            'status' => 'sometimes',
        ];
    }
}
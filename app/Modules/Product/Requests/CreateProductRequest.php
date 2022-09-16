<?php

namespace App\Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CreateProductRequest extends FormRequest
{
   
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
            "sub_category_id"=> "required",
            "product_name"=> "required",
            "product_slug"=> "required",
            "keyword"=> "sometimes",
            "brand"=> "sometimes",
            "model"=> "sometimes",
            "description"=> "required",
            "content"=> "required",
            "manual"=> "sometimes",
            "youtube_id"=> "sometimes",
            "measurement"=> "sometimes",
            'status' => 'required|in:active,inactive',
        ];
    }

}

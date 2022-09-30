<?php

namespace App\Modules\Category\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CreateCategoryRequest extends FormRequest
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
            'category_name' => 'required',
            'description' => 'sometimes',
            'slug' => 'sometimes',
            'category_image' => 'sometimes',
            'status' => 'required|in:active,inactive',
        ];
    }

}

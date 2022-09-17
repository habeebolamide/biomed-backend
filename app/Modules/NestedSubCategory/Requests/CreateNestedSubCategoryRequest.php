<?php

namespace App\Modules\NestedSubCategory\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CreateNestedSubCategoryRequest extends FormRequest
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
            'name' => 'required',
            'sub_category_id' => 'required',
            'description' => 'sometimes',
            'slug' => 'sometimes',
            'status' => 'required|in:active,inactive',
        ];
    }

}

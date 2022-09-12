<?php

namespace App\Modules\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CreateSubCategoryRequest extends FormRequest
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
            'sub_category_name' => 'required|email',
            'category_id' => 'required|email',
            'status' => 'required|in:active,inactive',
        ];
    }

}

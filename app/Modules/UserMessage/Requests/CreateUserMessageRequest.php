<?php

namespace App\Modules\UserMessage\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CreateUserMessageRequest extends FormRequest
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
            "user_id"=> "required",
            "sender_id"=> "required",
            "messages"=> "required",
            
        ];
    }

}

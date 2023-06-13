<?php

namespace App\Modules\Quotes\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CreateQuoteRequest extends FormRequest
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
            "product_name"=> "required",
            "quantity"=> "required",
            "FirstName"=> "required",
            "LastName"=> "required",
            "Phone Number"=> "required",
            "Email"=> "required",
            "Address1"=> "required",
            "postcode"=> "required",
            "Region"=> "required",
            "Country"=> "required",
            "VAT/MwSt Number/Tax ID"=> "required",
            "Near Branch"=> "required",
        ];
    }

}

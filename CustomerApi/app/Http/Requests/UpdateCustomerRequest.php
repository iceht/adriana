<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "bail|max:255|distinct|required_without_all:contract_date,address,customer_code",
            "contract_date" => "bail|date_format:Y-m-d\TH:i:s.v\Z|required_without_all:name,address,customer_code",
            "address" => "bail|distinct|required_without_all:contract_date,name,customer_code",
            "customer_code" => "bail|required_without_all:contract_date,address,name"
        ];
    }

}

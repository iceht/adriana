<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
            "*.name" => "bail|required|max:255|distinct",
            "*.contract_date" => "bail|required|date_format:Y-m-d\TH:i:s.v\Z",
            "*.address" => "bail|required|distinct",
            "*.customer_code" => ""
        ];
    }
}

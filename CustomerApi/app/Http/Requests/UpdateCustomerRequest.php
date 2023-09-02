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
            "*.name" => "bail|max:255|distinct",
            "*.contract_date" => "bail|date_format:Y-m-d\\TH:i:s.vP",
            "*.address" => "bail|alpha_num",
            "*.customer_code" => ""
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class InsertSaleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'latitude' => 'required',
            'longitude' => 'required',
            'sale_value' => 'required',
            'date_hour_sale' => [
                'string',
                function ($attribute, $value, $fail) {
                    if (!datetimeFormat($attribute, $value, ['Y-m-d H:i:s'])) {
                        $fail("The $attribute field must be a datetime in the format Y-m-d H:i:s.");
                    }
                }
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function bodyParameters(): array
    {
        return [
            'latitude' => [
                'description' => 'valor de latitude do lugar onde o vendedor esta',
                'required' => true,
                'example' => "-25.473704465731746"
            ],
            'longitude' => [
                'description' => 'valor de longitude do lugar onde o vendedor esta',
                'required' => true,
                'example' => "-49.24787198992874"
            ],
            'sale_value' => [
                'description' => 'valor total da venda',
                'required' => true,
                'example' => 8500.44
            ],
            'date_hour_sale' => [
                'description' => 'Data e hora da venda feita offline',
                'required' => false,
                'example' => '2023-01-01 23:59:59'
            ],
        ];
    }
}

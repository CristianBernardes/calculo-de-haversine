<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertSaleRoamingRequest extends FormRequest
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
            'roaming' => 'required',
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
            'roaming' => [
                'description' => 'Valor se a venda foi feita proxima da unidade do vendedor. Se for proxima o valor é zero e se for proxima a outra unidade o valor deverá ser 1',
                'required' => true,
                'example' => 0
            ],
        ];
    }
}

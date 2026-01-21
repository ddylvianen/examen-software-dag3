<?php

namespace App\Http\Requests\Voedselpakket;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVoedselpakketStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                'string',
                Rule::in(['NietUitgereikt', 'Uitgereikt']),
            ],
        ];
    }
}


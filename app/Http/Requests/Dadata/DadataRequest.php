<?php

namespace App\Http\Requests\Dadata;

use Illuminate\Foundation\Http\FormRequest;

class DadataRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'path' => ['string', 'required'],
            'body' => ['string', 'required'],
            'method' => ['string', 'required'],
        ];
    }
}

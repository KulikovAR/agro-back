<?php

namespace App\Http\Requests\Dadata;

use Illuminate\Foundation\Http\FormRequest;

class DadataSuggestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'url' => ['required', 'string'],
            'body' => ['array', 'required'],
            'body.*' => ['required'],
        ];
    }
}

<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class FromIcRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '1c_id' => ['string','required'],
            'file' => ['file','required'],
            '{inn}' => ['string','required', 'exists:users,inn'],
            'type' => ['string', 'required'],
        ];
    }
}

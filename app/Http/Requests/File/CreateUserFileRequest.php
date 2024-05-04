<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'load_files'   => ['array', 'required'],
            'load_files.*' => ['file'],
            'file_types'   => ['array', 'required'],
            'file_types.*' => ['string', 'exists:file_types,id']
        ];
    }
}

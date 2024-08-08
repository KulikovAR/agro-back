<?php

namespace App\Http\Requests\File;

use App\Enums\FileTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserFileRequest extends FormRequest
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
            'documents' => ['required', 'array'],
            'documents.*.file' => ['file'],
            'documents.*.file_type' => ['string', Rule::enum(FileTypeEnum::class)],
            'documents.*.file_id' => ['uuid','exists:files,id']
        ];
    }
}

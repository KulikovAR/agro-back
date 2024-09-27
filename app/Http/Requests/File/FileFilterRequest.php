<?php

namespace App\Http\Requests\File;

use App\Enums\FileTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class FileFilterRequest extends FormRequest
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
            //            'sort' => ['string'],
            'type' => ['string', FileTypeEnum::class],
        ];
    }
}

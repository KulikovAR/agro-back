<?php

namespace App\Http\Requests\SignMe;

use App\Enums\OrganizationTypeEnum;
use App\Enums\TaxSystemEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignMeRequest extends FormRequest
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
            'path' => ['required','string', 'exists:files,path']
        ];
    }
}

<?php

namespace App\Http\Requests\Auth;

use App\Enums\OrganizationTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationPhoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['string', Rule::enum(OrganizationTypeEnum::class)],
            'inn' => [
                'string',
                Rule::when(
                    $this->input('type') == OrganizationTypeEnum::IP->value,
                    'regex:/^\d{12}$/'
                ),
                Rule::when(
                    $this->input('type') == OrganizationTypeEnum::COMPANY->value,
                    'regex:/^\d{10}$/'
                ),
            ],
            'phone_number' => ["regex:/^7\d{10}$/", 'string', 'required', 'max:11'],
        ];
    }
}

<?php

namespace App\Http\Requests\UserProfile;

use App\Enums\OrganizationTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserProfileCreateRequest extends FormRequest
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
            'type' => ['required', 'string', Rule::enum(OrganizationTypeEnum::class)],
            'inn' => [
                'required',
                'string',
                Rule::when(
                    $this->input('type') == OrganizationTypeEnum::IP->value,
                    'regex:/^\d{12}$/'
                ),
                Rule::when(
                    $this->input('type') == OrganizationTypeEnum::COMPANY->value,
                    'regex:/^\d{10}$/'
                )
            ],
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'patronymic' => ['required', 'string'],
            'kpp' => [
                'string',
                Rule::when(
                    $this->input('type') == OrganizationTypeEnum::IP->value,
                    'nullable'
                ),
                Rule::when(
                    $this->input('type') == OrganizationTypeEnum::COMPANY->value,
                    'regex:/^\d{9}$/'
                )
            ],
            'orgn' => [
                'required',
                'string',
                Rule::when(
                    $this->input('type') == OrganizationTypeEnum::IP->value,
                    'regex:/^\d{15}$/'
                ),
                Rule::when(
                    $this->input('type') == OrganizationTypeEnum::COMPANY->value,
                    'required',
                    'regex:/^\d{13}$/'
                )
            ],
            'short_name' => ['required', 'string'],
            'full_name' => ['required', 'string'],
            'juridical_address' => ['required', 'string'],
            'office_address' => ['required', 'string'],
            'tax_system' => ['required', 'string'],
            'okved' => ['required', 'string'],
            'password' => ['required', 'string'],
            'number' => ['required', 'string'],
            'series' => ['required', 'string'],
            'department' => ['required', 'string'],
            'department_code' => ['required', 'string'],
            'snils' => ['required', 'string'],
        ];
    }
}

<?php

namespace App\Http\Requests\Counteragent;

use App\Enums\ModerationStatusEnum;
use App\Enums\OrganizationTypeEnum;
use App\Enums\TaxSystemEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
                'regex:/^\d{12}$/',
            ],
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'patronymic' => ['required', 'string'],
            'issue_date_at' => ['required', 'string'],
            'bdate' => ['required', 'string'],
            'kpp' => [
                'nullable',
                'string',
                Rule::when(
                    $this->input('type') == OrganizationTypeEnum::COMPANY->value,
                    ['regex:/^\d{9}$/','required']
                )
            ],
            'ogrn' => [
                'required',
                'string',
                Rule::when(
                    $this->input('type') == OrganizationTypeEnum::IP->value,
                    'regex:/^\d{15}$/'
                ),
                Rule::when(
                    $this->input('type') == OrganizationTypeEnum::COMPANY->value,
                    'regex:/^\d{13}$/'
                )
            ],
            'short_name' => ['required', 'string'],
            'full_name' => ['required', 'string'],
            'juridical_address' => ['required', 'string'],
            'office_address' => ['required', 'string'],
            'tax_system' => ['required', 'string', Rule::enum(TaxSystemEnum::class)],
            'okved' => ['required', 'string'],
            'number' => ['required', 'string'],
            'series' => ['required', 'string'],
            'department' => ['required', 'string'],
            'department_code' => ['required', 'string'],
            'snils' => ['required', 'string'],
            'phone_number' => ["regex:/^\+7\d{10}$/", 'string', 'required'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'region' => ['required', 'string'],
            'accountant_phone' => ['required', 'string'],
            'director_name' => ['required', 'string'],
            'director_surname' => ['required', 'string'],
            'director_lastname' => ['string'],
            'gender' => ['required', 'string', 'in:M,F'],
            'cregion' => ['required', 'string'],
            'cinn' => [
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
        ];
    }
}

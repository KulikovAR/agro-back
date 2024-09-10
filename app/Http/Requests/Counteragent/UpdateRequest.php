<?php

namespace App\Http\Requests\Counteragent;

use App\Enums\ModerationStatusEnum;
use App\Enums\OrganizationTypeEnum;
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
            'inn'               => [
                Rule::unique('users', 'inn')->ignore($this->route('user')->id),
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
            'name'              => ['string'],
            'surname'           => ['string'],
            'patronymic'        => ['string'],
            'kpp'               => [
                Rule::unique('users', 'kpp')->ignore($this->route('user')->id),
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
            'ogrn'               => [
                Rule::unique('users', 'ogrn')->ignore($this->route('user')->id),
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
            'short_name'         => ['string'],
            'full_name'          => ['string'],
            'juridical_address'  => ['string'],
            'office_address'     => ['string'],
            'tax_system'         => ['string'],
            'okved'              => ['string'],
            'phone_number' => ["regex:/^\+7\d{10}$/", 'string',
                Rule::unique('users', 'phone_number')->ignore($this->route('user')->id)],
            'email' => ['string', 'email', Rule::unique('users', 'email')->ignore($this->route('user')->id)],
            'region' => [ 'string'],
            'accountant_phone' => [ 'string'],
            'director_name' => [ 'string'],
            'director_surname' => [ 'string'],
            'number' => ['string'],
            'series' => ['string'],
            'department' => ['string'],
            'department_code' => ['string'],
            'snils' => ['string',Rule::unique('users', 'snils')->ignore($this->route('user')->id)],
            'bdate' => ['string'],
            'director_lastname' => ['string'],
            'gender' => ['string', 'in:M,F'],
            'cinn' => [
                'string',
                'regex:/^\d{10}$/'
            ],
        ];
    }
}

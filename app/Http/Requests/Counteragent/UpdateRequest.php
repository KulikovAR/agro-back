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
            'type'              => ['string','required', Rule::enum(OrganizationTypeEnum::class)],
            'inn'               => [
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
            'orgn'               => [
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
            'phone_number' => ["regex:/^\+7\d{10}$/", 'string'],
            'email' => ['string', 'email', 'unique:users,email'],
            'region' => [ 'string'],
            'accountant_phone' => [ 'string'],
            'director_name' => [ 'string'],
            'director_surname' => [ 'string'],
            'number' => ['string'],
            'series' => ['string'],
            'department' => ['string'],
            'department_code' => ['string'],
            'snils' => ['string'],
        ];
    }
}

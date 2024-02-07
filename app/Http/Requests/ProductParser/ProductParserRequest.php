<?php

namespace App\Http\Requests\ProductParser;

use Illuminate\Foundation\Http\FormRequest;

class ProductParserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'              => ['array'],
            'name.*'            => ['string'],
            'class'             => ['array'],
            'class.*'           => ['string'],
            'attr'              => ['array'],
            'attr.*'            => ['string'],
            'company'           => ['array'],
            'company.*'         => ['string'],
            'gluten'            => ['array'],
            'gluten.*'          => ['string'],
            'idk'               => ['array'],
            'idk.*'             => ['string'],
            'chp'               => ['array'],
            'chp.*'             => ['string'],
            'nature'            => ['array'],
            'nature.*'          => ['string'],
            'humidity'          => ['array'],
            'humidity.*'        => ['string'],
            'weed_impurity'     => ['array'],
            'weed_impurity.*'   => ['string'],
            'chinch'            => ['array'],
            'chinch.*'          => ['string'],
            'exporter'          => ['array'],
            'exporter.*'        => ['string'],

        ];
    }
}

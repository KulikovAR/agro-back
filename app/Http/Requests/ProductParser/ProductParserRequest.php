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
            'name'          => ['string'],
            'class'         => ['string'],
            'attr'          => ['string'],
            'company'       => ['string'],
            'gluten'        => ['string'],
            'idk'           => ['string'],
            'chp'           => ['string'],
            'nature'        => ['string'],
            'humidity'      => ['string'],
            'weed_impurity' => ['string'],
            'chinch'        => ['string'],
            'exporter'      => ['string'],

        ];
    }
}

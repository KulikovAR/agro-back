<?php

namespace App\Http\Requests\Order;

use App\Enums\OrderCityModeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderCitiesRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mode'           => ['string', 'required', Rule::enum(OrderCityModeEnum::class)],
            'load_region'    => ['string', Rule::when($this->input('mode') == 'load', 'required')],
            'unload_regions' => ['string', Rule::when($this->input('mode') == 'unload', 'required')],

        ];
    }
}

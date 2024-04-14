<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderFilterRequest extends FormRequest
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
            'crop'                                        => ['array'],
            'crop.*'                                      => ['string'],
            'volume'                                      => ['string'],
            'distance_from'                               => ['integer'],
            'distance_to'                                 => [
                'integer',
                Rule::when($this->input('distance_from'), 'gt:distance_from')
            ],
            'tariff'                                      => ['integer'],
            'nds_percent'                                 => ['nullable'],
            'terminal_name'                               => ['string'],
            'terminal_address'                            => ['string'],
            'terminal_inn'                                => ['string'],
            'exporter_name'                               => ['string'],
            'exporter_inn'                                => ['string'],
            'scale_lenght'                                => ['integer'],
            'height_limit'                                => ['integer'],
            'is_overload'                                 => ['boolean'],
            'timeslot'                                    => ['array'],
            'outage_begin'                                => ['integer'],
            'outage_price'                                => ['integer'],
            'daily_load_rate'                             => ['integer'],
            'contact_name'                                => ['string'],
            'contact_phone'                               => ['string'],
            'cargo_shortage_rate'                         => ['integer'],
            'unit_of_measurement_for_cargo_shortage_rate' => ['string'],
            'cargo_price'                                 => ['integer'],
            'load_place'                                  => ['string'],
            'approach'                                    => ['string'],
            'work_time'                                   => ['string'],
            'is_load_in_weekend'                          => ['boolean'],
            'clarification_of_the_weekend'                => ['string'],
            'loader_power'                                => ['integer'],
            'load_method'                                 => ['array'],
            'tolerance_to_the_norm'                       => ['integer'],
            'start_order_at'                              => ['date'],
            'end_order_at'                                => ['date'],
            'load_latitude'                               => ['string'],
            'load_longitude'                              => ['string'],
            'unload_latitude'                             => ['string'],
            'unload_longitude'                            => ['string'],
            'load_place_name'                             => ['string'],
            'unload_place_name'                           => ['string'],
            'cargo_weight'                                => ['integer'],
            'description'                                 => ['string'],
            'load_types'                                  => ['array'],
            'load_types.*'                                => ['string', 'exists:load_types,id'],
            'unload_methods'                              => ['array'],
            'unload_methods.*'                            => ['string', 'exists:unload_methods,id'],
            'load_region'                                 => ['array'],
            'load_city'                                   => ['array'],
            'unload_region'                               => ['array'],
            'unload_city'                                 => ['array'],
            'sort'                                        => ['string'],
        ];
    }
}

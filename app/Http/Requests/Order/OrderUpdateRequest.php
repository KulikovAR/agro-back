<?php

namespace App\Http\Requests\Order;

use App\Enums\OrderClarificationDayEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'crop'                                        => ['string'],
            'volume'                                      => ['string'],
            'distance'                                    => ['integer'],
            'tariff'                                      => ['integer'],
            'nds_percent'                                 => ['integer'],
            'terminal_name'                               => ['string'],
            'terminal_address'                            => ['string'],
            'terminal_inn'                                => ['string'],
            'exporter_name'                               => ['string'],
            'exporter_inn'                                => ['string'],
            'is_semi_truck'                               => ['boolean'],
            'is_tonar'                                    => ['boolean'],
            'scale_lenght'                                => ['integer'],
            'height_limit'                                => ['integer'],
            'is_overload'                                 => ['boolean'],
            'timeslot'                                    => ['string'],
            'outage_begin'                                => ['integer'],
            'outage_price'                                => ['integer'],
            'daily_load_rate'                             => ['integer'],
            'contact_name'                                => ['string'],
            'contact_phone'                               => ['string'],
            'cargo_shortrage_rate'                        => ['integer'],
            'unit_of_measurement_for_cargo_shortage_rate' => ['string'],
            'cargo_price'                                 => ['integer'],
            'load_place'                                  => ['string'],
            'approach'                                    => ['string'],
            'work_time'                                   => ['string'],
            'is_load_in_weekend'                          => ['boolean'],
            'clarification_of_the_weekend'                => [
                'string',
//                Rule::enum(OrderClarificationDayEnum::class())
            ],
            'loader_power'                                => ['integer'],
            'load_method'                                 => ['string',],
            'tolerance_to_the_norm'                       => ['integer'],
            'start_order_at'                              => ['date'],
            'end_order_at'                                => ['date', 'after:start_order_at'],
            'load_latitude'                               => ['string'],
            'load_longitude'                              => ['string'],
            'unload_latitude'                             => ['string'],
            'unload_longitude'                            => ['string'],
            'load_place_name'                             => ['string'],
            'unload_place_name'                           => ['string'],
            'cargo_weight'                                => ['integer'],
            'description'                                 => ['string'],
            'load_types'                                  => ['array'],
            'load_types.*'                                => ['string', 'exists:load_types,id']

        ];
    }
}

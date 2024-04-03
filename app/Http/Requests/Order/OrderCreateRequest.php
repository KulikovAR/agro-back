<?php

namespace App\Http\Requests\Order;

use App\Enums\OrderClarificationDayEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderCreateRequest extends FormRequest
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
            'crop'                                        => ['string', 'required'],
            'volume'                                      => ['numeric', 'required'],
            'distance'                                    => ['integer', 'required'],
            'tariff'                                      => ['integer', 'required'],
            'nds_percent'                                 => ['integer'],
            'terminal_name'                               => ['string', 'required'],
            'terminal_address'                            => ['string', 'required'],
            'terminal_inn'                                => ['string', 'required'],
            'exporter_name'                               => ['string', 'required'],
            'exporter_inn'                                => ['string', 'required'],
            'is_semi_truck'                               => ['boolean', 'required'],
            'is_tonar'                                    => ['boolean', 'required'],
            'scale_length'                                => ['integer', 'required'],
            'height_limit'                                => ['integer', 'required'],
            'is_overload'                                 => ['boolean', 'required'],
            'timeslot'                                    => ['string', 'required'],
            'outage_begin'                                => ['integer'],
            'outage_price'                                => ['integer'],
            'daily_load_rate'                             => ['integer'],
            'contact_name'                                => ['string', 'required'],
            'contact_phone'                               => ['string', 'required'],
            'cargo_shortrage_rate'                        => ['integer'],
            'unit_of_measurement_for_cargo_shortage_rate' => ['string'],
            'cargo_price'                                 => ['integer'],
            'load_place'                                  => ['string', 'required'],
            'approach'                                    => ['string'],
            'work_time'                                   => ['string'],
            'is_load_in_weekend'                          => ['boolean'],
            'clarification_of_the_weekend'                => [
                'string',
//                Rule::enum(OrderClarificationDayEnum::getWithDescription())
            ],
            'loader_power'                                => ['integer'],
            'load_method'                                 => ['string', 'required'],
            'tolerance_to_the_norm'                       => ['integer'],
            'start_order_at'                              => ['date', 'required'],
            'end_order_at'                                => ['date', 'required', 'after:start_order_at'],
            'load_latitude'                               => ['numeric', 'required'],
            'load_longitude'                              => ['numeric', 'required'],
            'unload_latitude'                             => ['numeric', 'required'],
            'unload_method'                               => ['string','required'],
            'unload_longitude'                            => ['numeric', 'required'],
            'load_place_name'                             => ['string', 'required'],
            'unload_place_name'                           => ['string', 'required'],
            'cargo_weight'                                => ['numeric', 'required'],
            'description'                                 => ['string'],
            'is_full_charter'                             => ['boolean'],
            'load_types'                                  => ['array', 'required'],
            'load_types.*'                                => ['string', 'exists:load_types,id']


        ];
    }
}

<?php

namespace App\Http\Requests\Order;

use App\Enums\LoadMethodEnum;
use App\Enums\OrderClarificationDayEnum;
use App\Enums\OrderStatusEnum;
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
            'distance'                                    => ['integer'],
            'tariff'                                      => ['integer', 'required'],
            'nds_percent'                                 => ['nullable','integer'],
            'terminal_name'                               => ['string', 'required'],
            'terminal_inn'                                => ['string'],
            'exporter_name'                               => ['string', 'required'],
            'exporter_inn'                                => ['string'],
            'scale_length'                                => ['integer', 'required'],
            'height_limit'                                => ['integer', 'required'],
            'is_overload'                                 => ['boolean'],
            'timeslot'                                    => ['string', 'required'],
            'outage_begin'                                => ['nullable','integer'],
            'outage_price'                                => ['integer'],
            'daily_load_rate'                             => ['integer'],
            'contact_name'                                => ['string', 'required'],
            'contact_phone'                               => ['string', 'required'],
            'cargo_shortrage_rate'                        => ['nullable','integer'],
            'unit_of_measurement_for_cargo_shortage_rate' => ['string'],
            'cargo_price'                                 => ['nullable','integer'],
            'load_place'                                  => ['string'],
            'approach'                                    => ['string'],
            'work_time'                                   => ['string'],
            'clarification_of_the_weekend'                => ['string'],
            'loader_power'                                => ['nullable','integer'],
            'load_method'                                 => ['string', 'required',Rule::enum(LoadMethodEnum::class)],
            'tolerance_to_the_norm'                       => ['nullable','integer'],
            'start_order_at'                              => ['date', 'required'],
            'end_order_at'                                => ['date', 'required', 'after:start_order_at'],
            'load_latitude'                               => ['numeric'],
            'load_longitude'                              => ['numeric'],
            'unload_latitude'                             => ['numeric'],
            'unload_longitude'                            => ['numeric'],
            'status'                                      => ['string', Rule::enum(OrderStatusEnum::class)],
            'unload_method'                               => ['string'],
            'load_place_name'                             => ['string', 'required'],
            'unload_place_name'                           => ['string', 'required'],
            'description'                                 => ['string'],
            'is_full_charter'                             => ['boolean'],
            'load_types'                                  => ['array'],
            'load_types.*'                                => ['string', 'exists:load_types,id']


        ];
    }
}

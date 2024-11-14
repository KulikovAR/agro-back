<?php

namespace App\Http\Requests\Order;

use App\Enums\LoadMethodEnum;
use App\Enums\OrderStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'crop' => ['string', 'required'],
            'volume' => ['numeric', 'required'],
            'distance' => ['integer'],
            'tariff' => ['integer', 'required'],
            'nds_percent' => ['nullable', 'integer'],
            'terminal_name' => ['string', 'nullable'],
            'exporter_name' => ['string', 'nullable'],
            'scale_length' => ['string', 'required'],
            'height_limit' => ['nullable', 'string'],
            'is_overload' => ['boolean'],
            'timeslot' => ['string'],
            'outage_begin' => ['nullable', 'integer'],
            'outage_price' => ['integer'],
            'daily_load_rate' => ['integer'],
            'contact_name' => ['string', 'required'],
            'contact_phone' => ['string', 'required'],
            'cargo_shortrage_rate' => ['nullable', 'integer'],
            'unit_of_measurement_for_cargo_shortage_rate' => ['string'],
            'cargo_price' => ['nullable', 'integer'],
            'load_place' => ['string'],
            'approach' => ['string'],
            'work_time' => ['string'],
            'clarification_of_the_weekend' => ['string'],
            'loader_power' => ['nullable', 'integer'],
            'load_method' => ['string', 'required', Rule::enum(LoadMethodEnum::class)],
            'tolerance_to_the_norm' => ['nullable', 'integer'],
            'start_order_at' => ['date', 'required'],
            'end_order_at' => ['date', 'required', 'after:start_order_at'],
            'load_place_name' => ['string', 'required'],
            //            'status'                                      => ['tranекstring', Rule::enum(OrderStatusEnum::class)],
            'unload_method' => ['string'],
            'unload_place_name' => ['string', 'required'],
            'description' => ['string'],
            'is_full_charter' => ['boolean'],
            'load_types' => ['required', 'array'],
            'load_types.*' => ['string', 'exists:load_types,id'],
            'unload_methods' => ['array'],
            'unload_methods.*' => ['string', 'exists:unload_methods,id'],
            'manager_id' => ['string'],
        ];
    }
}

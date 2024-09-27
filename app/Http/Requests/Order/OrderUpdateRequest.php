<?php

namespace App\Http\Requests\Order;

use App\Enums\LoadMethodEnum;
use App\Enums\OrderStatusEnum;
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
            'crop' => ['string'],
            'volume' => ['numeric'],
            'distance' => ['integer'],
            'tariff' => ['integer'],
            'nds_percent' => ['integer'],
            'terminal_name' => ['string'],
            //            'terminal_address'                            => ['string', 'required'],
            'terminal_inn' => ['string'],
            'exporter_name' => ['string'],
            'exporter_inn' => ['string'],
            'scale_length' => ['integer'],
            'height_limit' => ['integer'],
            'is_overload' => ['boolean'],
            'timeslot' => ['string'],
            'outage_begin' => ['integer'],
            'outage_price' => ['integer'],
            'daily_load_rate' => ['integer'],
            'contact_name' => ['string'],
            'contact_phone' => ['string'],
            'cargo_shortrage_rate' => ['integer'],
            'unit_of_measurement_for_cargo_shortage_rate' => ['string'],
            'cargo_price' => ['integer'],
            'load_place' => ['string'],
            'approach' => ['string'],
            'work_time' => ['string'],
            'clarification_of_the_weekend' => ['string'],
            'loader_power' => ['integer'],
            'load_method' => ['string', Rule::enum(LoadMethodEnum::class)],
            'tolerance_to_the_norm' => ['integer'],
            'start_order_at' => ['date'],
            'end_order_at' => ['date', 'after:start_order_at'],
            'load_latitude' => ['numeric'],
            'load_longitude' => ['numeric'],
            'unload_latitude' => ['numeric'],
            'unload_longitude' => ['numeric'],
            'status' => ['string', Rule::enum(OrderStatusEnum::class)],
            'unload_method' => ['string'],
            'load_place_name' => ['string'],
            'unload_place_name' => ['string'],
            //            'cargo_weight'                                => ['numeric', 'required'],
            'description' => ['string'],
            'is_full_charter' => ['boolean'],
            'load_types' => ['array'],
            'load_types.*' => ['string', 'exists:load_types,id'],
        ];
    }
}

<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\LoadType\LoadTypeCollection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'crop'                                        => $this->crop,
            'volume'                                      => $this->volume,
            'distance'                                    => $this->distance,
            'tariff'                                      => $this->tariff,
            'status'                                      => $this->status,
            'nds_percent'                                 => $this->nds_percent,
            'terminal_name'                               => $this->terminal_name,
            'terminal_address'                            => $this->terminal_address,
            'terminal_inn'                                => $this->terminal_inn,
            'exporter_name'                               => $this->exporter_name,
            'exporter_inn'                                => $this->exporter_inn,
            'scale_length'                                => $this->scale_length,
            'height_limit'                                => $this->height_limit,
            'is_overload'                                 => $this->is_overload,
            'timeslot'                                    => $this->timeslot,
            'outage_begin'                                => $this->outage_begin,
            'outage_price'                                => $this->outage_price,
            'daily_load_rate'                             => $this->daily_load_rate,
            'contact_name'                                => $this->contact_name,
            'contact_phone'                               => $this->contact_phone,
            'cargo_shortage_rate'                         => $this->cargo_shortage_rate,
            'unit_of_measurement_for_cargo_shortage_rate' => $this->unit_of_measurement_for_cargo_shortage_rate,
            'cargo_price'                                 => $this->cargo_price,
            'load_place'                                  => $this->load_place,
            'approach'                                    => $this->approach,
            'work_time'                                   => $this->work_time,
            'order_number'                                => $this->order_number,
            'clarification_of_the_weekend'                => $this->clarification_of_the_weekend,
            'loader_power'                                => $this->loader_power,
            'load_method'                                 => $this->load_method,
            'tolerance_to_the_norm'                       => $this->tolerance_to_the_norm,
            'start_order_at'                              => Carbon::parse($this->start_order_at)->format(
                'd.m.y'
            ),
            'end_order_at'                                => Carbon::parse($this->end_order_at)->format('d.m.y'),
            'load_coordinates'                            => array(
                'x' => $this->load_longitude,
                'y' => $this->load_latitude
            ),
            'unload_coordinates'                          => array(
                'x' => $this->unload_longitude,
                'y' => $this->unload_latitude
            ),
            'load_place_name'                             => $this->load_place_name,
            'unload_place_name'                           => $this->unload_place_name,
            'cargo_weight'                                => $this->cargo_weight,
            'description'                                 => $this->description,
            'load_types'                                  => new LoadTypeCollection($this->loadTypes),
            'is_full_charter'                             => $this->is_full_charter,
            'unload_method'                               => $this->unload_method,
        ];
    }
}

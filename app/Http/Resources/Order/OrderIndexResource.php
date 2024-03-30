<?php

namespace App\Http\Resources\Order;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'start_order_at'    => Carbon::parse($this->start_order_at)->format('d.m.y'),
            'deadlines'         => Carbon::parse($this->start_order_at)->format('d.m.y') . '-' . Carbon::parse(
                    $this->end_order_at
                )->format('d.m.y'),
            'distance'          => $this->distance,
            'crop'              => $this->crop,
            'tariff'            => $this->tariff,
            'cargo_weight'      => $this->cargo_weight,
            'load_place_name'   => $this->load_place_name,
            'unload_place_name' => $this->load_place_name,
            'order_number'      => $this->order_number,
        ];
    }
}

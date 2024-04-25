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
            'id'                 => $this->id,
            'status'             => $this->status,
            'created_at'         => Carbon::parse($this->created_at)->format('d.m.y'),
            'deadlines'          => Carbon::parse($this->start_order_at)->format('d.m.y') . '-' . Carbon::parse(
                    $this->end_order_at
                )->format('d.m.y'),
            'distance'           => $this->distance,
            'crop'               => $this->crop,
            'tariff'             => $this->tariff,
            'volume'             => $this->volume,
            'view_counter'       => $this->view_counter,
            'load_place_name'    => $this->load_place_name,
            'unload_place_name'  => $this->unload_place_name,
            'order_number'       => $this->order_number,
            'terminal_name'      => $this->terminal_name,
            'load_coordinates'   => array(
                'x' => $this->load_longitude,
                'y' => $this->load_latitude
            ),
            'unload_coordinates' => array(
                'x' => $this->unload_longitude,
                'y' => $this->unload_latitude
            ),
        ];
    }
}

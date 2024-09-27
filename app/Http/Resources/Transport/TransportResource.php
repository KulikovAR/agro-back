<?php

namespace App\Http\Resources\Transport;

use App\Http\Resources\Driver\DriverResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'driver' => new DriverResource($this->driver),
            'type' => $this->type,
            'number' => $this->number,
            'model' => $this->model,
            'description' => $this->description,
            'free' => $this->free,
            'is_active' => $this->is_active,
            'volume_cm' => $this->volume_cm,
            'capacity' => $this->capacity,
            'created_at' => Carbon::parse($this->created_at),
        ];
    }
}

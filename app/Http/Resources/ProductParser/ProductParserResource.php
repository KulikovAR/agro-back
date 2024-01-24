<?php

namespace App\Http\Resources\ProductParser;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductParserResource extends JsonResource
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
            'logs' => $this->logs()->get()->pluck('price', 'created_at')
        ];
    }
}

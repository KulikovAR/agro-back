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
            'name' => $this->name,
            'class' => $this->class,
            'attr' => $this->attr,
            'company' => $this->company,
            'price' => $this->price,
            'type' => $this->type,
            'gluten' => $this->gluten,
            'idk' => $this->idk,
            'chp' => $this->chp,
            'nature' => $this->nature,
            'humidity' => $this->humidity,
            'weed_impurity' => $this->impurity,
            'chinch' => $this->chinch,
            'exporter' => $this->exporter,
            'parser' => $this->parser,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'logs' => $this->logs()->get()->pluck('price', 'created_at'),
        ];
    }
}

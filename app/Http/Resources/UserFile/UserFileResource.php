<?php

namespace App\Http\Resources\UserFile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFileResource extends JsonResource
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
            'user_id' => $this->user_id,
        ];
    }
}

<?php

namespace App\Http\Resources\File;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class GetDataFrom1CResource extends JsonResource
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
            'path_url' => $this->path ? Storage::disk('public')->url($this->path) : null,
            'path' => $this->path,
            'type' => $this->type,
            'id_1c' => $this->id_1c,
//            'userFile' => new UserFileResource($this->userFile),
        ];
    }
}

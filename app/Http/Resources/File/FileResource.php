<?php

namespace App\Http\Resources\File;

use App\Http\Resources\FileType\FileTypeResource;
use App\Http\Resources\UserFile\UserFileCollection;
use App\Http\Resources\UserFile\UserFileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FileResource extends JsonResource
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
            'name' => $this->name,
            'created_at' => $this->created_at,
            'is_signed' => $this->is_signed,
//            'userFile' => new UserFileResource($this->userFile),
        ];
    }
}

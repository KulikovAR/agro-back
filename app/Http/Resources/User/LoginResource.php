<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Counteragent\CounteragentResource;
use App\Http\Resources\File\FileCollection;
use App\Http\Resources\Role\RoleCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            'phone_number' => $this->phone_number,
        ];
    }
}

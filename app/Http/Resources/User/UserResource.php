<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Counteragent\CounteragentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                      => $this->id,
            'phone_number'            => $this->phone_number,
            'phone_verified_at'       => $this->phone_verified_at,
            'email'                   => $this->email,
            'email_verified_at'       => $this->email_verified_at,
            'password'                => $this->password,
            'created_at'              => $this->created_at,
            'updated_at'              => $this->updated_at,
            'userinfo'            => new CounteragentResource($this->counteragent),
        ];
    }
}

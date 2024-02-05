<?php

namespace App\Http\Resources\User;

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
            'code'                    => $this->code,
            'code_hash'               => $this->code_hash,
            'phone_verified_at'       => $this->phone_verified_at
            // 'profile'                 => new UserProfileResource($this->userProfile),
        ];
    }
}

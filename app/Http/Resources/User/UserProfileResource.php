<?php

namespace App\Http\Resources\User;

use App\Traits\DateFormats;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserProfileResource extends JsonResource
{
    use DateFormats;

    public function toArray(Request $request): array
    {
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'avatar' => $this->avatar ? Storage::disk('public')->url($this->avatar) : null,

        ];
    }
}

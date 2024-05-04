<?php

namespace App\Http\Resources\Counteragent;

use App\Http\Resources\User\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CounteragentResource extends JsonResource
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
            'inn' => $this->inn,
            'name' => $this->name,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'kpp' => $this->kpp,
            'ogrn' => $this->ogrn,
            'type' => $this->type,
            'short_name' => $this->short_name,
            'full_name' => $this->full_name,
            'juridical_address' => $this->juridical_address,
            'office_address' => $this->office_address,
            'tax_system' => $this->tax_system,
            'okved' => $this->okved,
            'phone_number' => $this->phone_number,
            'password' => $this->password,
            // 'bank_accounts'     => $this->bank_accounts,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'series'     => $this->series,
            'number'     => $this->number,
            'department' => $this->department,
            'department_code' => $this->department_code,
            'snils'           => $this->snils,
            'issue_date_at'  => $this->issue_date_at ? Carbon::parse($this->issue_date_at)->format('d.m.y') : null ,

            // 'user'              => new UserResource ($this->user),
        ];
    }
}

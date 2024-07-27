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
            'series' => $this->series,
            'number' => $this->number,
            'department' => $this->department,
            'department_code' => $this->department_code,
            'snils' => $this->snils,
            'issue_date_at' => $this->issue_date_at ? Carbon::parse($this->issue_date_at)->format('d.m.Y') : null,
            'email' => $this->email,
            'moderation_status' => $this->moderation_status,
            'creator_id' => $this->creator_id,
            'region' => $this->region,
            'accountant_phone' => $this->accountant_phone,
            'director_name' => $this->director_name,
            'director_surname' => $this->director_surname,
            'bdate' => $this->bdate,
            'gender' => $this->gender,
        ];
    }
}

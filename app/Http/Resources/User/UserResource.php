<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Counteragent\CounteragentResource;
use App\Http\Resources\File\FileCollection;
use App\Http\Resources\Role\RoleCollection;
use Carbon\Carbon;
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
            'id' => $this->id,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'moderation_status' => $this->moderation_status,
            'inn' => $this->inn,
            'name' => $this->name,
            'surname' => $this->surname,
            'patronymic' => $this->patronymic,
            'kpp' => $this->kpp,
            'ogrn' => $this->ogrn,
            'type' => $this->type,
            'cinn' => $this->cinn,
            'director_lastname' => $this->director_lastname,
            'cregion' => $this->cregion,
            'company_activate' => $this->company_activate,
            'short_name' => $this->short_name,
            'full_name' => $this->full_name,
            'juridical_address' => $this->juridical_address,
            'office_address' => $this->office_address,
            'tax_system' => $this->tax_system,
            'okved' => $this->okved,
            // 'bank_accounts'     => $this->bank_accounts,
            'series'     => $this->series,
            'number'     => $this->number,
            'department' => $this->department,
            'department_code' => $this->department_code,
            'snils'           => $this->snils,
            'issue_date_at'  => $this->issue_date_at ? Carbon::parse($this->issue_date_at)->format('d.m.Y') : null ,
            'creator_id' => $this->creator_id,
            'region' => $this->region,
            'accountant_phone' => $this->accountant_phone,
            'director_name' => $this->director_name,
            'director_surname' => $this->director_surname,
            'bdate' => $this->bdate ?  Carbon::parse($this->bdate)->format('d.m.Y') : null,
            'gender' => $this->gender,
            'roles' => new RoleCollection($this->roles),
            'files' => new FileCollection($this->files),
        ];
    }
}

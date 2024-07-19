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
            'phone_verified_at' => $this->phone_verified_at,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'moderation_status' => $this->moderation_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
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
            // 'bank_accounts'     => $this->bank_accounts,
            'series'     => $this->series,
            'number'     => $this->number,
            'department' => $this->department,
            'department_code' => $this->department_code,
            'snils'           => $this->snils,
            'issue_date_at'  => $this->issue_date_at ? Carbon::parse($this->issue_date_at)->format('d.m.Y') : null ,
            'roles' => new RoleCollection($this->roles),
            'files' => new FileCollection($this->files),
        ];
    }
}

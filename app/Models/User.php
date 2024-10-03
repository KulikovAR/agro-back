<?php

namespace App\Models;

use App\Enums\OrganizationTypeEnum;
use App\Notifications\PasswordResetNotification;
use App\Notifications\VerifyEmailNotification;
use Carbon\Carbon;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasLocalePreference, HasName, MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasRoles, HasUuids, Notifiable, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'email_verified_at',
        'phone_verified_at',
        'salt',
        'password',
        'phone_number',
        'moderation_status',
        'code',
        'code_hash',
        'code_expire_at',
        'creator_id',
        'name',
        'surname',
        'patronymic',
        'inn',
        'region',
        'kpp',
        'ogrn',
        'short_name',
        'full_name',
        'juridical_address',
        'office_address',
        'tax_system',
        'okved',
        'type',
        'series',
        'number',
        'issue_date_at',
        'department',
        'department_code',
        'snils',
        'accountant_phone',
        'director_name',
        'director_surname',
        'bdate',
        'sign_me_cid',
        'director_lastname',
        'cinn',
        'company_activate',
        'gender',
        'cregion',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'deleted_at'        => 'datetime',
        'password'          => 'hashed',
        'auto_subscription' => 'boolean',
    ];

    public function preferredLocale()
    {
        return $this->language;
    }

    public function sendEmailVerification(): void
    {
        $this->notify(new VerifyEmailNotification);
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new PasswordResetNotification($token));
    }

    public function driver(): HasOne
    {
        return $this->hasOne(Driver::class);
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'user_files', 'user_id', 'file_id');
    }

    public function fileTypes(): belongsToMany
    {
        return $this->belongsToMany(FileType::class, 'user_files', 'user_id', 'file_type_id');
    }

    public function userProfile(): HasOne
    {
        return $this->hasOne((UserProfile::class));
    }

    public function createdOrders(): hasMany
    {
        return $this->hasMany(Order::class);
    }

    public function orders(): belongsToMany
    {
        return $this->belongsToMany(Order::class, 'offers', 'user_id', 'order_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->email, '@admin.ru');
    }

    //    public function roles(): BelongsToMany
    //    {
    //        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    //    }

    public function getFilamentName(): string
    {
        return "{$this->email}";
    }

    public function tgUser(): hasOne
    {
        return $this->hasOne(TgUser::class);
    }

    public function clearProfile()
    {
        return [
            'name'              => null,
            'surname'           => null,
            'patronymic'        => null,
            'inn'               => null,
            'kpp'               => null,
            'ogrn'              => null,
            'short_name'        => null,
            'full_name'         => null,
            'juridical_address' => null,
            'office_address'    => null,
            'tax_system'        => null,
            'okved'             => null,
            'type'              => null,
            'series'            => null,
            'number'            => null,
            'issue_date_at'     => null,
            'department'        => null,
            'department_code'   => null,
            'snils'             => null,
            'email'             => null,
            'salt'              => null,
            'password'          => null,
            'creator_id'        => null,
            'region'            => null,
            'accountant_phone'  => null,
            'director_name'     => null,
            'director_surname'  => null,
            'sign_me_id'        => null,
            'is_signer'         => null,
            'gender'            => null,
            'bdate'             => null,
        ];
    }

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class, 'user_id', 'id');
    }

    public function counteragents(): HasMany
    {
        return $this->hasMany(User::class, 'creator_id', 'id');
    }

    public function dataForSignMe(self $user): array
    {
        if ($user->type == OrganizationTypeEnum::IP->value) {
            $data =
                [
                    'cinn'        => $user->inn,
                    'inn'         => $user->inn,
                    'company'     => 1,
                    'gender'      => $user->gender,
                    'cfaddr'      => $user->juridical_address,
                    'caddr'       => $user->office_address,
                    // 'esia' => 1,
                    "country"     => "RU",
                    'regtype'     => config('app.sign_me_regtype'),
                    'cname'       => $user->short_name,
                    'delivery'    => 0,
                    'cfullname'   => $user->full_name,
                    'ceo_name'    => $user->director_name,
                    'ceo_surname' => $user->director_surname,
                    'ps'          => $user->series,
                    'pn'          => $user->number,
                    'pdate'       => Carbon::parse($user->issue_date_at)->toDateString(),
                    'bdate'       => Carbon::parse($user->bdate)->toDateString(),
                    'issued'      => $user->department,
                    'pcode'       => $user->department_code,
                    'phone'       => $user->phone_number,
                    'lastname'    => $user->patronymic,
                    'cogrn'       => $user->ogrn,
                    // 'ca' => config('app.sign_me_ca'),
                    'ct'          => config('app.sign_me_ct'),
                    'name'        => $user->name,
                    'surname'     => $user->surname,
                    'email'       => $user->email,
                    'region'      => $user->region,
                    'snils'       => $user->snils,
                    'ckey'        => config('app.sign_me_ckey'),
                    'cr'          => config('app.sign_me_cr'),
                    'ccr'         => config('app.sign_me_ccr'),
                    'mobile'      => 0,
                ];

            return $data;
        }

        $data =
            [
                'cinn'        => $user->cinn,
                'ckpp'        => $user->kpp,
                'inn'         => $user->inn,
                'company'     => "1",
                'gender'      => $user->gender,
                'cfaddr'      => $user->juridical_address,
                'caddr'       => $user->office_address,
                // 'esia'        => 1,
                "country" =>   "RU",
                'regtype'     => config('app.sign_me_regtype'),
                'cname'       => $user->short_name,
                'cfullname'   => $user->full_name,
                'ceo_name'    => $user->director_name,
                'ceo_surname' => $user->director_surname,
                'ps'          => $user->series,
                'pn'          => $user->number,
                'pdate'       => Carbon::parse($user->issue_date_at)->toDateString(),
                'bdate'       => Carbon::parse($user->bdate)->toDateString(),
                'issued'      => $user->department,
                'pcode'       => $user->department_code,
                'phone'       => $user->phone_number,
                'lastname'    => $user->patronymic,
                'cogrn'       => $user->ogrn,
                'ct'          => config('app.sign_me_ct'),
                'name'        => $user->name,
                'surname'     => $user->surname,
                'email'       => $user->email,
                'region'      => $user->region,
                'cregion'     => $user->cregion,
                'snils'       => $user->snils,
                'ckey'        => config('app.sign_me_ckey'),
                'cr'          => config('app.sign_me_cr'),
                'ccr'         => config('app.sign_me_ccr'),
                'mobile'      => "0",
            ];

        return $data;
    }
}

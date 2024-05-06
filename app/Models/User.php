<?php

namespace App\Models;


use App\Notifications\PasswordResetNotification;
use App\Notifications\VerifyEmailNotification;
use App\Traits\BearerTokenTrait;
use App\Traits\SheduleLessons;
use Carbon\Carbon;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, HasLocalePreference, FilamentUser, HasName
{

    use HasApiTokens, HasFactory, Notifiable, HasUuids, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'phone_number',
        'code_hash',
        'phone_verified_at',
        'code',

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


    public function files():BelongsToMany
    {
        return $this->belongsToMany(File::class,'user_files','user_id','file_id');
    }
    public function fileTypes():belongsToMany
    {
        return $this->belongsToMany(FileType::class,'user_files','user_id','file_type_id');
    }
    public function userProfile():HasOne
    {
        return $this->hasOne((UserProfile::class));
    }

    public function createdOrders():hasMany
    {
        return $this->hasMany(Order::class);
    }
    public function orders():belongsToMany
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

    public function tgUser():hasOne
    {
        return $this->hasOne(TgUser::class);
    }

    public function clearProfile()
    {
        return [
            'name' => null,
            'surname' => null,
            'patronymic' => null,
            'inn' => null,
            'kpp' => null,
            'ogrn' => null,
            'short_name' => null,
            'full_name' => null,
            'juridical_address' => null,
            'office_address' => null,
            'tax_system' => null,
            'okved' => null,
            'type' => null,
            'series' => null,
            'number' => null,
            'issue_date_at' => null,
            'department' => null,
            'department_code' => null,
            'snils' => null,
        ];
    }
}

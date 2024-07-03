<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\User\Channel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use const Grpc\CHANNEL_CONNECTING;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'full_name',
        'status',
        'state_status',
        'profile',
        'ip_address',
        'website',
        'body',
        'email_verified_at',
        'remember_token'
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
    ];

    const STATUS_BAN = "ban";
    const STATUS_SUCCESS = "success";
    const STATUS_ACTIVE = "active";
    const STATUS_NO_ACTIVE = "no-active";

    public static array $status = [
        self::STATUS_BAN,
        self::STATUS_SUCCESS,
        self::STATUS_ACTIVE,
        self::STATUS_NO_ACTIVE,
    ];


    const STATE_STATUS_ACTIVE = "active";
    const STATE_STATUS_NO_ACTIVE = "no_active";

    public static array $state_status = [
        self::STATE_STATUS_ACTIVE,
        self::STATE_STATUS_NO_ACTIVE,
    ];

    public function channel(): HasOne
    {
        return $this->hasOne(Channel::class);
    }

}

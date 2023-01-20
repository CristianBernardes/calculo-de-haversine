<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 *
 */
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, Uuids;

    // Rest omitted for brevity

    const GENERAL_MANAGER = 'general_manager';
    const DIRECTOR = 'director';
    const MANAGER = 'manager';
    const SALESMAN = 'salesman';

    public static function listProfiles()
    {
        return [
            self::GENERAL_MANAGER => 'Diretor Geral',
            self::DIRECTOR => 'Diretor',
            self::MANAGER => 'Gerente',
            self::SALESMAN => 'Vendedor',
        ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['board_unit'];

    /**
     * Interact with the user's first name.
     *
     * @return Attribute
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            set: static fn ($value) => stripAccents($value)
        );
    }

    /**
     * @return mixed
     */
    public function getBoardUnitAttribute(): mixed
    {
        return BoardUnitUser::select('board_id', 'unit_id')->where('user_id', $this->id)->first();
    }

    public function getshowSellerCoordinatesAttribute()
    {
        if ($this->profile != 'salesman') {
            return null;
        }

        return BoardUnitUser::select('units.latitude', 'units.longitude')
            ->where('board_unit_users.user_id', $this->id)
            ->join('units', 'units.id', 'board_unit_users.unit_id')
            ->first();
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const CREATED_AT = 'DatumAangemaakt';
    const UPDATED_AT = 'DatumGewijzigd';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'PersoonId',
        'IsActief',
        'Opmerking',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'IsActief' => 'boolean',
            'DatumAangemaakt' => 'datetime',
            'DatumGewijzigd' => 'datetime',
            'IsIngelogd' => 'boolean',
            'Ingelogd' => 'datetime',
            'Uitgelogd' => 'datetime',
        ];
    }


    public function rollen()
    {
        return $this->belongsToMany(Rol::class, 'RolPerGebruiker', 'GebruikerId', 'RolId')
            ->withPivot(['IsActief', 'Opmerking', 'DatumAangemaakt', 'DatumGewijzigd']);
    }

    /**
     * Check if user has one or more roles (e.g. hasRole('Manager', 'Admin'))
     */
    public function hasRole(string ...$roleNames): bool
    {
        return $this->rollen()->whereIn('Naam', $roleNames)->exists();
    }

    /**
     * Legacy attribute accessor for 'role'
     * Returns the name of the first role or null
     */
    public function getRoleAttribute()
    {
        return $this->rollen->first()?->Naam;
    }
}

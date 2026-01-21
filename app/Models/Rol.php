<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'Rol';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'DatumAangemaakt';
    const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'Naam',
        'IsActief',
        'Opmerking'
    ];

    public function gebruikers()
    {
        return $this->belongsToMany(User::class, 'RolPerGebruiker', 'RolId', 'GebruikerId')
            ->withPivot(['IsActief', 'Opmerking', 'DatumAangemaakt', 'DatumGewijzigd']);
    }
}

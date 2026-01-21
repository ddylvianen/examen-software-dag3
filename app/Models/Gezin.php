<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gezin extends Model
{
    protected $table = 'Gezin';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'DatumAangemaakt';
    const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'Naam',
        'Code',
        'Omschrijving',
        'AantalVolwassenen',
        'AantalKinderen',
        'AantalBabys',
        'TotaalAantalPersonen',
        'IsActief',
        'Opmerking',
    ];

    protected $casts = [
        'IsActief' => 'boolean',
        'DatumAangemaakt' => 'datetime',
        'DatumGewijzigd' => 'datetime',
    ];
}


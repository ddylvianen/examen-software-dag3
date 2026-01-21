<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voedselpakket extends Model
{
    protected $table = 'Voedselpakket';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'DatumAangemaakt';
    const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'GezinId',
        'PakketNummer',
        'DatumSamenstelling',
        'DatumUitgifte',
        'Status',
        'IsActief',
        'Opmerking',
    ];

    protected $casts = [
        'DatumSamenstelling' => 'datetime',
        'DatumUitgifte' => 'datetime',
        'IsActief' => 'boolean',
        'DatumAangemaakt' => 'datetime',
        'DatumGewijzigd' => 'datetime',
    ];
}


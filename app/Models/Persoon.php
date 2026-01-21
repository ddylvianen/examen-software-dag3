<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persoon extends Model
{
    protected $table = 'Persoon';
    // Use custom timestamps
    const CREATED_AT = 'DatumAangemaakt';
    const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'GezinId',
        'Voornaam',
        'Tussenvoegsel',
        'Achternaam',
        'Geboortedatum',
        'TypePersoon',
        'IsVertegenwoordiger',
        'IsActief',
        'Opmerking'
    ];

    protected $casts = [
        'Geboortedatum' => 'date',
        'IsVertegenwoordiger' => 'boolean',
        'IsActief' => 'boolean',
        'DatumAangemaakt' => 'datetime',
        'DatumGewijzigd' => 'datetime',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'PersoonId');
    }
}

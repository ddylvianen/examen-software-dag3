<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VoorraadModel extends Model
{
    Static public function SP_GetAllProducten()
    {
        return DB::select('CALL SP_GetAllProducten');
    }
}

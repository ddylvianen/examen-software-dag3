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

    Static public function SP_GetAllCategorieen()
    {
        return DB::select('CALL SP_GetAllCategorieen');
    }

    Static public function SP_GetProductenPerCategorie($categorieid)
    {
        return DB::select('CALL SP_GetProductenPerCategorie(?)', [$categorieid]);
    }

    Static public function SP_GetProductenInfoById($id)
    {
        return DB::selectOne('CALL SP_GetProductenInfoById(?)', [$id]);
    }
}

<?php

namespace App\Services\Voedselpakket;

use Illuminate\Support\Facades\DB;

class VoedselpakketRepository
{
    /**
     * @return array<int, object>
     */
    public function getEetwensen(): array
    {
        return DB::select('CALL SP_Voedselpakket_Eetwens_SelectAll()');
    }

    /**
     * @return array<int, object>
     */
    public function getGezinnenOverzicht(): array
    {
        return DB::select('CALL SP_Voedselpakket_GezinnenOverzicht()');
    }

    /**
     * @return array<int, object>
     */
    public function getGezinnenOverzichtByEetwens(int $eetwensId): array
    {
        return DB::select('CALL SP_Voedselpakket_GezinnenOverzicht_FilterEetwens(?)', [$eetwensId]);
    }

    /**
     * @return object|null
     */
    public function getGezinDetail(int $gezinId): ?object
    {
        $rows = DB::select('CALL SP_Voedselpakket_GezinDetail(?)', [$gezinId]);
        return $rows[0] ?? null;
    }

    /**
     * @return array<int, object>
     */
    public function getPakkettenPerGezin(int $gezinId): array
    {
        return DB::select('CALL SP_Voedselpakket_PakkettenPerGezin(?)', [$gezinId]);
    }

    /**
     * @return object|null
     */
    public function getVoedselpakketForEdit(int $voedselpakketId): ?object
    {
        $rows = DB::select('CALL SP_Voedselpakket_GetForEdit(?)', [$voedselpakketId]);
        return $rows[0] ?? null;
    }

    /**
     * @return object|null { ResultCode:int, Message:string, GezinId:int|null }
     */
    public function updateStatus(int $voedselpakketId, string $nieuweStatus): ?object
    {
        $rows = DB::select('CALL SP_Voedselpakket_UpdateStatus(?, ?)', [$voedselpakketId, $nieuweStatus]);
        return $rows[0] ?? null;
    }
}


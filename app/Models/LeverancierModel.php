<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Model voor interactie met leverancier-gerelateerde database operaties via Stored Procedures.
 */
class LeverancierModel extends Model
{
    /**
     * Haalt alle leveranciers op uit de database, optioneel gefilterd op type.
     * Roept stored procedure SP_Getleveranciers aan.
     *
     * @param string $leverancierType Het type leverancier om op te filteren (optioneel).
     * @return array Lijst van leveranciers.
     */
    public static function getallleveranciersbytype($leverancierType=''){
        try {
            Log::info("\n\nAlle leveranciers ophalen uit database met type: $leverancierType...\n");
            // Voer de Stored Procedure uit met parameter
            $leveranciers = DB::select('CALL SP_Getleveranciers(?)', [$leverancierType]);
            Log::info("\n\nAlle leveranciers opgehaald uit database.\n");
            return $leveranciers;
        } catch (\Throwable $th) {
            // Log de fout en retourneer een lege array zodat de applicatie niet crasht
            Log::error("\n\nFout bij het ophalen van alle leveranciers uit de database: " . $th->getMessage() . "\n");
            return [];
        }
    }

    /**
     * Haalt alle unieke leveranciertypes op uit de database.
     * Roept stored procedure SP_GetAllLeverancierTypes aan.
     *
     * @return array Lijst van leveranciertypes.
     */
    public static function getallleveranciertype(){
        try {
            Log::info("\n\nAlle leveranciertypes ophalen uit database...\n");
            // Voer de Stored Procedure uit zonder parameters
            $leverancierTypes = DB::select('CALL SP_GetAllLeverancierTypes()');
            Log::info("\n\nAlle leveranciertypes opgehaald uit database.\n");
            return $leverancierTypes;
        } catch (\Throwable $th) {
            // Log de fout en retourneer een lege array zodat de applicatie niet crasht
            Log::error("\n\nFout bij het ophalen van alle leveranciertypes uit de database: " . $th->getMessage() . "\n");
            return [];
        }
    }

    /**
     * Werkt de houdbaarheidsdatum van een product bij.
     * Roept stored procedure SP_UpdateProduct aan.
     *
     * @param array $data Array met 'ProductId' en 'houdbaarheidsdatum'.
     * @return int Aantal beïnvloede rijen (1 bij succes), of -1 bij fout.
     */
    public static function updateproduct($data): int{a
        try {
            Log::info("\n\nProductdatums bijwerken in database... met ID: " . $data['ProductId'] . "\n");
            // Voer de Stored Procedure uit zonder parameters
            $result = DB::selectOne('CALL SP_UpdateProduct(?, ?)', [
                $data['ProductId'],
                $data['houdbaarheidsdatum']
            ])->Affected;
            Log::info("\n\nProductdatums bijgewerkt in database.\n");

        } catch (\Throwable $th
        ) {
            // Log de fout
            $result = -1;
            Log::error("\n\nFout bij het bijwerken van productdatums in de database: " . $th->getMessage() . "\n");
        }
        return $result;
    }

    /**
     * Haalt producten op die gekoppeld zijn aan een specifieke leverancier.
     * Roept stored procedure SP_GetProductPerLeverancierById aan.
     *
     * @param int $id De ID van de leverancier.
     * @return array Lijst van producten voor deze leverancier.
     */
    public static function GetProductPerLeverancierById($id){
        try {
            Log::info("\n\nProducten ophalen voor leverancier ID: $id...\n");
            // Voer de Stored Procedure uit met parameter
            $producten = DB::select('CALL SP_GetProductPerLeverancierById(?)', [$id]);
            Log::info("\n\nProducten opgehaald voor leverancier ID: $id.\n");
            return $producten;
        } catch (\Throwable $th) {
            // Log de fout en retourneer een lege array zodat de applicatie niet crasht
            Log::error("\n\nFout bij het ophalen van producten voor leverancier ID $id uit de database: " . $th->getMessage() . "\n");
            return [];
        }
    }

    /**
     * Haalt de details van een specifieke leverancier op.
     * Roept stored procedure SP_GetLeverancierById aan.
     *
     * @param int $id De ID van de leverancier.
     * @return object|null Het leverancierobject of null bij fout/niet gevonden.
     */
    public static function GetLeverancierById($id){
        try {
            Log::info("\n\nLeverancier ophalen voor ID: $id...\n");
            // Voer de Stored Procedure uit met parameter
            $leverancier = DB::selectOne('CALL SP_GetLeverancierById(?)', [$id]);
            Log::info("\n\nLeverancier opgehaald voor ID: $id.\n");
            return $leverancier;
        } catch (\Throwable $th) {
            // Log de fout en retourneer null zodat de applicatie niet crasht
            Log::error("\n\nFout bij het ophalen van leverancier voor ID $id uit de database: " . $th->getMessage() . "\n");
            return null;
        }
    }

    /**
     * Haalt een specifiek product op via ID.
     * Roept stored procedure SP_GetProductById aan.
     *
     * @param int $id De ID van het product.
     * @return object|null Het productobject of null bij fout/niet gevonden.
     */
    public static function GetProductById($id){
        try {
            Log::info("\n\nProduct ophalen voor ID: $id...\n");
            // Voer de Stored Procedure uit met parameter
            $product = DB::selectOne('CALL SP_GetProductById(?)', [$id]);
            Log::info("\n\nProduct opgehaald voor ID: $id.\n");
            return $product;
        } catch (\Throwable $th) {
            // Log de fout en retourneer null zodat de applicatie niet crasht
            Log::error("\n\nFout bij het ophalen van product voor ID $id uit de database: " . $th->getMessage() . "\n");
            return null;
        }
    }
}

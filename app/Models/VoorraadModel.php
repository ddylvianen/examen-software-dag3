<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class VoorraadModel extends Model
{
    // Haalt alle producten op uit de database
    Static public function SP_GetAllProducten()
    {
        try {
            // Log dat functie begonnen is
            Log::info('Functie SP_GetAllProducten gestart');
            // Roep stored procedure aan
            $result = DB::select('CALL SP_GetAllProducten');
            // Log succesvolle afronding
            Log::info('Functie SP_GetAllProducten succesvol voltooid');
            return $result;
        } catch (Exception $e) {
            // Log fout als iets misgaat
            Log::error('Fout in SP_GetAllProducten: ' . $e->getMessage());
            return [];
        }
    }

    // Haalt alle categorieën op
    Static public function SP_GetAllCategorieen()
    {
        try {
            Log::info('Functie SP_GetAllCategorieen gestart');
            $result = DB::select('CALL SP_GetAllCategorieen');
            Log::info('Functie SP_GetAllCategorieen succesvol voltooid');
            return $result;
        } catch (Exception $e) {
            Log::error('Fout in SP_GetAllCategorieen: ' . $e->getMessage());
            return [];
        }
    }

    // Haalt alle magazijnen op
    Static public function SP_GetAllMagazijnen()
    {
        try {
            Log::info('Functie SP_GetAllMagazijnen gestart');
            $result = DB::select('CALL SP_GetAllMagazijnen()');
            Log::info('Functie SP_GetAllMagazijnen succesvol voltooid');
            return $result;
        } catch (Exception $e) {
            Log::error('Fout in SP_GetAllMagazijnen: ' . $e->getMessage());
            return [];
        }
    }

    // Haalt producten op per categorie
    Static public function SP_GetProductenPerCategorie($categorieid)
    {
        try {
            Log::info('Functie SP_GetProductenPerCategorie gestart met categorieid: ' . $categorieid);
            // Geef categorie ID mee aan stored procedure
            $result = DB::select('CALL SP_GetProductenPerCategorie(?)', [$categorieid]);
            Log::info('Functie SP_GetProductenPerCategorie succesvol voltooid');
            return $result;
        } catch (Exception $e) {
            Log::error('Fout in SP_GetProductenPerCategorie: ' . $e->getMessage());
            return [];
        }
    }

    // Haalt productinformatie op op basis van ID
    Static public function SP_GetProductenInfoById($id)
    {
        try {
            Log::info('Functie SP_GetProductenInfoById gestart met id: ' . $id);
            // Geef product ID mee aan stored procedure
            $result = DB::selectOne('CALL SP_GetProductenInfoById(?)', [$id]);
            Log::info('Functie SP_GetProductenInfoById succesvol voltooid');
            return $result;
        } catch (Exception $e) {
            Log::error('Fout in SP_GetProductenInfoById: ' . $e->getMessage());
            return null;
        }
    }

    // Werkt voorraadgegevens van een product bij
    Static public function SP_UpdateVoorraad($productId, $data)
    {
        try {
            Log::info('Functie SP_UpdateVoorraad gestart met productId: ' . $productId);
            // Roep update procedure aan met product ID en data
            $result = DB::update('CALL SP_UpdateVoorraad(?, ?, ?, ?, ?, ?, ?, ?)', [
                $productId,
                $data['Productnaam'],
                $data['Barcode'] ?? null,
                $data['Houdbaarheidsdatum'] ?? null,
                $data['MagazijnId'],
                $data['Ontvangstdatum'] ?? null,
                $data['Uitleveringsdatum'] ?? null,
                $data['Aantal']
            ]);
            Log::info('Functie SP_UpdateVoorraad succesvol voltooid');
            return $result;
        } catch (Exception $e) {
            // Gooi fout door zodat controller deze kan afhandelen
            Log::error('Fout in SP_UpdateVoorraad: ' . $e->getMessage());
            throw $e;
        }
    }
}

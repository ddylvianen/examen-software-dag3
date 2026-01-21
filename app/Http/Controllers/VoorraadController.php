<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VoorraadModel as Voorraad;

class VoorraadController extends Controller
{
    public $voorraden = [];

    // Toont overzicht van alle voorraden en categorieën
    public function index()
    {
        // Haal alle producten op
        $voorraden = Voorraad::SP_GetAllProducten();
        // Haal alle categorieën op
        $categorieen = Voorraad::SP_GetAllCategorieen();

        // Geef data aan view
        return view('voorraad.index', [
            'voorraden' => $voorraden,
            'categorieen' => $categorieen
        ]);
    }

    // Filtert voorraden per categorie
    public function ProductenPerCategorie(Request $request)
    {
        // Haal categorie ID uit URL parameter
        $categorieid = $request->query('categorieid');
        
        // Controleer of categorie ID ingevuld is
        if ($categorieid) {
            // Haal producten voor geselecteerde categorie op
            $voorraden = Voorraad::SP_GetProductenPerCategorie($categorieid);
        } else {
            // Anders haal alle producten op
            $voorraden = Voorraad::SP_GetAllProducten();
        }
        
        // Haal alle categorieën voor filter op
        $categorieen = Voorraad::SP_GetAllCategorieen();

        // Geef gefilterde data aan view
        return view('voorraad.index', [
            'voorraden' => $voorraden,
            'categorieen' => $categorieen
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    // Toont details van een specifiek product
    public function show(Request $request, $id)
    {
        // Haal productinformatie op basis van ID
        $product = Voorraad::SP_GetProductenInfoById($id);

        // Geef product naar detail view
        return view('voorraad.show', [
            'product' => $product
        ]);
    }

    // Toont edit formulier voor product
    public function edit(Request $request, $id)
    {
        // Haal productinformatie op
        $product = Voorraad::SP_GetProductenInfoById($id);
        // Haal alle beschikbare magazijnen op
        $magazijnen = Voorraad::SP_GetAllMagazijnen();

        // Geef data naar edit formulier
        return view('voorraad.edit', [
            'product' => $product,
            'magazijnen' => $magazijnen
        ]);
    }

    // Werkt product informatie in database bij
    public function update(Request $request, string $id)
    {
        // Valideer ingevulde gegevens
        $data = $request->validate([
            'Productnaam'           => 'required|string',
            'Houdbaarheidsdatum'    => 'nullable|date',
            'Barcode'               => 'nullable|string',
            'MagazijnId'            => 'required|string',
            'Ontvangstdatum'        => 'nullable|date',
            'Uitgeleverd'           => 'nullable|integer',
            'Uitleveringsdatum'     => 'nullable|date',
            'Aantal'                => 'required|integer',
        ]);

        // Haal huidige product gegevens op
        $product = Voorraad::SP_GetProductenInfoById($id);

        // Controleer of uitgeleverde hoeveelheid niet groter is dan voorraad
        if (($data['Uitgeleverd'] ?? 0) > $product->aantal) {
            return redirect()->route('voorraad.index')->with('error', 'Er worden meer producten uitgeleverd dan er in voorraad zijn');
        }

        // Trek uitgeleverde hoeveelheid af van voorraad
        $data['Aantal'] = $data['Aantal'] - ($data['Uitgeleverd'] ?? 0);

        // Update product in database
        Voorraad::SP_UpdateVoorraad($id, $data);

        // Redirect terug naar index met succesbericht
        return redirect()->route('voorraad.index')->with('success', 'De Product gegevens zijn gewijzigd');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

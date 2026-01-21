<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VoorraadModel as Voorraad;

class VoorraadController extends Controller
{
    public $voorraden = [];

    public function index()
    {
        $voorraden = Voorraad::SP_GetAllProducten();
        $categorieen = Voorraad::SP_GetAllCategorieen();

        return view('voorraad.index', [
            'voorraden' => $voorraden,
            'categorieen' => $categorieen
        ]);
    }

    public function ProductenPerCategorie(Request $request)
    {
        $categorieid = $request->query('categorieid');
        
        if ($categorieid) {
            $voorraden = Voorraad::SP_GetProductenPerCategorie($categorieid);
        } else {
            $voorraden = Voorraad::SP_GetAllProducten();
        }
        
        $categorieen = Voorraad::SP_GetAllCategorieen();

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

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $product = Voorraad::SP_GetProductenInfoById($id);

        return view('voorraad.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $product = Voorraad::SP_GetProductenInfoById($id);
        $magazijnen = Voorraad::SP_GetAllMagazijnen();

        return view('voorraad.edit', [
            'product' => $product,
            'magazijnen' => $magazijnen
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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

        $product = Voorraad::SP_GetProductenInfoById($id);

        if (($data['Uitgeleverd'] ?? 0) > $product->aantal){
            return redirect()->route('voorraad.index')->with('error', 'Er worden meer producten uitgeleverd dan er in voorraad zijn');
        }

        $data['Aantal'] = $data['Aantal'] - ($data['Uitgeleverd'] ?? 0); 

        Voorraad::SP_UpdateVoorraad($id, $data);

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

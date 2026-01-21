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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

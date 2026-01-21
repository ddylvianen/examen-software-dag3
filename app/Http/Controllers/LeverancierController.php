<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeverancierModel;

/**
 * Controller voor het beheren van leveranciers en bijbehorende producten.
 */
class LeverancierController extends Controller
{
    /**
     * Toont een lijst van leveranciers, optioneel gefilterd op type.
     *
     * @param Request $request Het inkomende verzoek met filtergegevens.
     * @return \Illuminate\View\View De leveranciers index view.
     */
    public function index(Request $request)
    {
        // Valideer de invoer voor het filter
        $data = $request->validate([
            'leveranciertype' => 'nullable|string',
        ]);

        // Haal het geselecteerde leveranciertype op (of leeg als niet ingesteld)
        $leverancierType = $data['leveranciertype'] ?? '';
        // Haal de gefilterde leveranciers en alle types op via het model
        $leveranciers = LeverancierModel::getallleveranciersbytype($leverancierType);
        $leverancierTypes = LeverancierModel::getallleveranciertype();


        return view('leveranciers.index', compact('leveranciers', 'leverancierTypes', 'leverancierType'));
    }

    /**
     * Toont het formulier om een product te wijzigen.
     *
     * @param int $id De ID van het product.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse De update view of een redirect bij fout.
     */
    public function edit($id)
    {
        // Haal product op via ID
        $product = LeverancierModel::GetProductById($id);

        // Controleer of product bestaat
        if (!$product) {
            return redirect()->route('leveranciers.index')->with('error', 'Product niet gevonden.');
        }
        return view('leveranciers.update', compact('product'));
    }

    /**
     * Verwerkt de update van een product (houdbaarheidsdatum).
     *
     * @param Request $request Het inkomende verzoek met formulierdata.
     * @return \Illuminate\Http\RedirectResponse Redirect terug met success of error bericht.
     */
    public function updateProduct(Request $request)
    {
        // Valideer de invoer
        $data = $request->validate([
            'ProductId' => 'required|integer',
            'houdbaarheidsdatum' => 'required|date',
        ]);


        // Roep de update functie aan in Model
        $res = LeverancierModel::updateproduct($data);

        // Controleer het resultaat (-1 is validatiefout in stored procedure/logica)
        if ($res == -1) {
            return back()
            ->with('error', 'De houdbaarheidsdatum is niet gewijzigd. De houdbaarheidsdatum mag met maximaal 7 dagen worden verlengd');
        }
        else{
            return back()
            ->with('success', 'De houdbaarheidsdatum is gewijzigd');
        }
    }

    /**
     * Toont de details van een specifieke leverancier en diens producten.
     *
     * @param int $id De ID van de leverancier.
     * @return \Illuminate\View\View De leverancier detail view.
     */
    public function show($id)
    {
        // Haal leverancier details en producten op
        $leverancier = LeverancierModel::GetLeverancierById($id);
        $products = LeverancierModel::GetProductPerLeverancierById($id);
        // dd($products, $leverancier);

        return view('leveranciers.show', compact('leverancier', 'products'));
    }
}

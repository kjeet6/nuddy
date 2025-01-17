<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producte;

class ComandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->is_admin) {
            
            return redirect('/');
        }

        $comandes = Comanda::all();
        return view('Comanda.listc', compact('comandes'));
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
    public function show(Comanda $comanda)
    {
        if (!Auth::user()->is_admin) {
            
            return redirect('/');
        }
        return view('orders.show', compact('comanda'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comanda $comanda)
    {
        if (!Auth::user()->is_admin) {
            return redirect('/');
        }

        // Obtenir tots els productes disponibles
        $totsProductes = Producte::all();
        return view('Comanda.edit', compact('comanda', 'totsProductes'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comanda $comanda)
    {
        if (!Auth::user()->is_admin) {
            return redirect('/');
        }
    
        // Validació de les dades
        $request->validate([
            'productes' => 'array', // Validem que productes sigui un array
        ]);
    
        // Obtenir productes i quantitats
        $productesQuantitat = [];
        if ($request->has('productes') && $request->has('quantitat')) {
            foreach ($request->input('productes') as $producteId) {
                $quantitat = $request->input('quantitat.' . $producteId, 1); // 1 és el valor per defecte
                $productesQuantitat[$producteId] = ['quantitat' => $quantitat];
            }
        }
    
        // Actualitzar els productes associats a la comanda
        if (!empty($productesQuantitat)) {
            $comanda->detallsComanda()->sync($productesQuantitat); // Sync amb quantitat
        }
    
        return redirect()->route('comandes.index')->with('success', 'Comanda actualitzada correctament.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!Auth::user()->is_admin) {
            return redirect('/');
        }
    
        // Trobar la comanda per ID
        $comanda = Comanda::findOrFail($id);
    
        // Eliminar la comanda
        $comanda->delete();
    
        // Retornar a la vista de la llista de comandes amb un missatge d'èxit
        return redirect()->route('comandes.index')->with('success', 'Comanda eliminada correctament.');
    }
    

    


}

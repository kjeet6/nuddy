<?php

namespace App\Http\Controllers;

use App\Models\Producte;
use Illuminate\Http\Request;

class ProducteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productes = Producte::all();
        return view('products.index', compact('productes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'preu' => 'required|numeric',
            'quantitat_stock' => 'required|integer',
        ]);

        Producte::create($request->all());

        return redirect()->route('products.index')->with('success', 'Producte creat correctament.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producte $producte)
    {
        return view('products.show', compact('producte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producte $producte)
    {
        return view('products.edit', compact('producte'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producte $producte)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'preu' => 'required|numeric',
            'quantitat_stock' => 'required|integer',
        ]);

        $producte->update($request->all());

        return redirect()->route('products.index')->with('success', 'Producte actualitzat correctament.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producte $producte)
    {
        $producte->delete();
        return redirect()->route('products.index')->with('success', 'Producte eliminat correctament.');
    }
}

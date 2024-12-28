<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Comanda;
use App\Models\Producte;
use Illuminate\Http\Request;
class ProducteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $categories = Categoria::all();
    $productes = Producte::query();

    // Filtrar per categoria, si es proporciona
    if ($request->has('categoria') && $request->categoria) {
        $productes->where('categoria_id', $request->categoria);
    }

    return view('productes.list', [
        'categories' => $categories,
        'productes' => $productes->get(),
    ]);
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
        $productes = Producte::all(); // Obtén tots els productes de la base de dades
        return view('coleccions', compact('productes')); 
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
    public function coleccions(Request $request)
    {
        // Obtenim totes les categories
        $categories = Categoria::all();
    
        // Obtenim la categoria seleccionada des de la URL
        $categoriaSeleccionada = $request->input('categoria', 'totes-les-peces');
    
        // Filtrar productes segons la categoria seleccionada
        if ($categoriaSeleccionada === 'totes-les-peces') {
            $productes = Producte::all(); // Mostrem tots els productes
        } else {
            $productes = Producte::where('categoria_id', $categoriaSeleccionada)->get();
        }
    
        // Retornem les dades a la vista
        return view('coleccions', compact('categories', 'productes', 'categoriaSeleccionada'));

    }
    

}


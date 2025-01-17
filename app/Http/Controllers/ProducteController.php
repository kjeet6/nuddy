<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producte;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProducteController extends Controller
{
    /**
     * Llistat de productes per l'administrador.
     */
    public function index(Request $request)
    {
        if (!Auth::user()->is_admin) {
            return redirect('/');
        }
        $categories = Categoria::all();
        $productes = Producte::query();

        
        if ($request->has('categoria') && $request->categoria) {
            $productes->where('categoria_id', $request->categoria);
        }

        return view('productes.list', [
            'categories' => $categories,
            'productes' => $productes->get(),
        ]);
    }

    /**
     * Vista per crear un nou producte.
     */
    public function create()
    {
        $categories = Categoria::all(); 
        return view('productes.create', compact('categories'));

    }

    /**
     * Emmagatzemar un nou producte.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'preu' => 'required|numeric',
            'quantitat_stock' => 'required|integer',
            'categoria_id' => 'required|exists:categories,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoNom = null;

        if ($request->hasFile('foto')) {
            $fotoNom = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('img'), $fotoNom);
        }

        Producte::create([
            'nom' => $request->nom,
            'descripcio' => $request->descripcio,
            'preu' => $request->preu,
            'quantitat_stock' => $request->quantitat_stock,
            'categoria_id' => $request->categoria_id,
            'foto' => $fotoNom,
        ]);

        return redirect()->route('productes.index')->with('success', 'Producte creat correctament.');
    }

    /**
     * Vista per editar un producte.
     */
    public function edit(Producte $producte)
    {
        $categories = Categoria::all();
        return view('productes.edit', compact('producte', 'categories'));

    }

    /**
     * Actualitzar un producte existent.
     */
    public function update(Request $request, Producte $producte)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
            'preu' => 'required|numeric',
            'quantitat_stock' => 'required|integer',
            'categoria_id' => 'required|exists:categories,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $fotoNom = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('img'), $fotoNom);
            $producte->foto = $fotoNom;
        }

        $producte->update([
            'nom' => $request->nom,
            'descripcio' => $request->descripcio,
            'preu' => $request->preu,
            'quantitat_stock' => $request->quantitat_stock,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('productes.index')->with('success', 'Producte actualitzat correctament.');
    }

    /**
     * Eliminar un producte.
     */
    public function destroy(Producte $producte)
    {
        $producte->delete();
        return redirect()->route('productes.index')->with('success', 'Producte eliminat correctament.');
    }

    /**
     * Llistat de col·leccions per als usuaris i guests.
     */
    public function coleccions(Request $request)
    {
        
        $categories = Categoria::all();

        
        $categoriaSeleccionada = $request->input('categoria', 'totes-les-peces');

        
        if ($categoriaSeleccionada === 'totes-les-peces') {
            $productes = Producte::all(); 
        } else {
            $productes = Producte::where('categoria_id', $categoriaSeleccionada)->get();
        }

        
        return view('coleccions', compact('categories', 'productes', 'categoriaSeleccionada'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Carret;
use App\Models\Comanda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarretController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Cal iniciar sessió per veure el carret.');
        }
    
        $carret = Carret::where('users_id', Auth::id())->with('detallsCarret.producte')->first();
    
        // Calcular el total
        $total = $carret ? $carret->detallsCarret->sum(function ($detall) {
            return $detall->quantitat * $detall->producte->preu;
        }) : 0;
    
        return view('carret.index', compact('carret', 'total'));
    }

    public function store(Request $request)
    {
        if (!auth::check()) {
            return redirect()->route('login')->with('error', 'Cal iniciar sessió per afegir productes al carret.');
        }
    
        $request->validate([
            'producte_id' => 'required|exists:productes,id',
        ]);
    
        $carret = Carret::firstOrCreate(['users_id' => auth::id()]);
    
        $detall = $carret->detallsCarret()->where('producte_id', $request->producte_id)->first();
    
        if ($detall) {
            $detall->update(['quantitat' => $detall->quantitat + 1]);
        } else {
            $carret->detallsCarret()->create([
                'producte_id' => $request->producte_id,
                'quantitat' => 1,
            ]);
        }
    
        return redirect()->back()->with('success', __('Producte afegit al carret correctament!'));
    }
    public function restar($producteId)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Cal iniciar sessió per gestionar el carret.');
    }

    $carret = Carret::where('users_id', Auth::id())->first();

    if (!$carret) {
        return redirect()->back()->with('error', 'El carret no existeix.');
    }

    $detall = $carret->detallsCarret()->where('producte_id', $producteId)->first();

    if ($detall && $detall->quantitat > 1) {
        $detall->update(['quantitat' => $detall->quantitat - 1]);
    } elseif ($detall) {
        $detall->delete();
    }

    return redirect()->back()->with('success', __('Quantitat actualitzada'));
}


    public function destroy($producteId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Cal iniciar sessió per gestionar el carret.');
        }

        $carret = Carret::where('users_id', Auth::id())->first();

        if (!$carret) {
            return redirect()->back()->with('error', 'El carret no existeix.');
        }

        $carret->detallsCarret()->where('producte_id', $producteId)->delete();

        return redirect()->back()->with('success', __('Producte eliminat del carret'));
    }
    public function finalitzar()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', __('Cal iniciar sessió per finalitzar la compra.'));
        }

        $carret = Carret::where('users_id', Auth::id())->with('detallsCarret.producte')->first();

        if (!$carret || $carret->detallsCarret->isEmpty()) {
            return redirect()->route('carret.index')->with('error', __('El carret està buit'));
        }

       
        $comanda = Comanda::create([
            'users_id' => Auth::id(),
            'data' => now(),
        ]);

     
        foreach ($carret->detallsCarret as $detall) {
            $comanda->detallsComanda()->attach($detall->producte_id, [
                'quantitat' => $detall->quantitat,
            ]);
        }

        
        $carret->detallsCarret()->delete();

        return redirect()->route('carret.index')->with('success', __('Compra finalitzada! Gràcies per confiar en nosaltres.'));
    }
}

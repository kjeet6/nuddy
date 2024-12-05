<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    public function usuari()
    {
        return $this->belongsTo(User::class);
    }

    public function detallsComanda()
    {
        return $this->belongsToMany(Producte::class, 'detall_comandes')->withPivot('quantitat');
    }
}

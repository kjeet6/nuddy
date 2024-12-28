<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    protected $table = 'comandes';
    public function usuari()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function detallsComanda()
    {
        return $this->belongsToMany(Producte::class, 'detall_comandes')->withPivot('quantitat');
    }
}

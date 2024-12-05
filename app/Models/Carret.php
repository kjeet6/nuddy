<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carret extends Model
{
    public function usuari()
    {
        return $this->belongsTo(User::class);
    }

    public function detallsCarret()
    {
        return $this->belongsToMany(Producte::class, 'detall_carrets')->withPivot('quantitat');
    }
}

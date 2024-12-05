<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detall_Carret extends Model
{
    public function carret()
    {
        return $this->belongsTo(Carret::class);
    }

    public function producte()
    {
        return $this->belongsTo(Producte::class);
    }
}

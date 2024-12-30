<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detall_Carret extends Model
{
    protected $table = 'detall_carrets';
    protected $fillable = ['producte_id', 'carret_id', 'quantitat'];
    public function carret()
    {
        return $this->belongsTo(Carret::class, 'carret_id');
    }

    public function producte()
    {
        return $this->belongsTo(Producte::class, 'producte_id');
    }
}

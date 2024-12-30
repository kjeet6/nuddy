<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carret extends Model
{
    protected $fillable = ['users_id']; 

    public function usuari()
    {
        // Especifica la columna correcta aquí
        return $this->belongsTo(User::class, 'users_id');
    }

    public function detallsCarret()
    {
        return $this->hasMany(Detall_Carret::class, 'carret_id');
    }
}
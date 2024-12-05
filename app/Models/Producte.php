<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producte extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'descripcio',
        'preu',
        'categoria_id',
    ];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function usuarisFavorits()
    {
        return $this->belongsToMany(User::class, 'usuari_producte')->withPivot('data_afegit');
    }
}

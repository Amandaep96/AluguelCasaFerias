<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BemLocavel extends Model
{
    protected $table = 'bens_locaveis';


    public function reservas() {
    return $this->hasMany(Reserva::class, 'bem_locavel_id');
}

    public function caracteristicas() {
        return $this->belongsToMany(Caracteristica::class, 'bem_caracteristicas', 'bem_locavel_id', 'caracteristica_id');
    }

    protected $fillable = [
        'nome',
        'descricao',
        'preco_diaria',
        'disponibilidade',
        'imagem'
    ];
}

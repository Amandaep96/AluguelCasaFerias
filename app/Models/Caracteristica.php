<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $table = 'caracteristicas';

    public function bensLocaveis()
    {
        return $this->belongsToMany(BemLocavel::class, 'bens_caracteristica', 'caracteristica_id', 'bem_locavel_id');
    }

    protected $fillable = [
        'nome',
        'descricao'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';


    protected $fillable = [
        'user_id',
        'bem_locavel_id',
        'data_inicio',
        'data_fim',
        'preco_total',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bemLocavel()
    {
        return $this->belongsTo(BemLocavel::class);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\BensLocaveisRepository;

class BensLocaveisController extends Controller
{
    protected $bensLocaveis;

    // Construtor correto em PHP
    public function __construct()
    {
        $this->bensLocaveis = new BensLocaveisRepository();
    }

    public function all_avalible(Request $request)
    {
        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');

        $hospedes = (int) $request->input('hospedes');

        $disponiveis = $this->bensLocaveis->all_avalible($dataInicio, $dataFim, $hospedes);

        //return response()->json($disponiveis);
        return view('disponiveis', ['bens' => $disponiveis]);
    }
}

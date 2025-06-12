<?php

namespace App\Http\Controllers;

use App\Models\BemLocavel;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagamentoController extends Controller
{
    public function iniciar($id)
    {
        $bemLocavel = BemLocavel::findOrFail($id);
        return view('pagamento.iniciar', [
            'bemLocavel' => $bemLocavel,
            'users' => Auth::users(),
        ]);
    }

    public function processar(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['auth' => 'Você precisa estar logado para fazer uma reserva.']);
        }

        $request->validate([
            'bem_locavel_id' => 'required|exists:bens_locaveis,id',
            'data_inicio' => 'required|date|after_or_equal:today',
            'data_fim' => 'required|date|after:data_inicio',
        ]);

        $bemLocavelId = $request->input('bem_locavel_id');
        $dataFim = $request->input('data_fim');
        $dataInicio = $request->input('data_inicio');
        if (!$dataFim || !$dataInicio) {
            return redirect()->back()->withErrors(['data_fim' => 'Data de fim e início são obrigatórias.']);
        }

        $bemLocavel = BemLocavel::findOrFail($bemLocavelId);

        //$diferencaDias = max(1, $dataFim->diffInDays($dataInicio));
        $diferencaDias = (new \DateTime($request->data_inicio))->diff(new \DateTime($request->data_fim))->days;
        $preco_total = $diferencaDias * $bemLocavel->preco_diario; // ajuste conforme o campo da sua tabela

        $referencia = str_pad(mt_rand(0, 999999999), 9, '0', STR_PAD_LEFT);
        $entidade = '123456';

        session(['possivel_reserva' => [
            'data_inicio' => $dataInicio,
            'data_fim' => $dataFim,
            'bem_locavel_id' => $bemLocavelId,
        ]]);

        return view('pagamento.iniciar', [
            'bemLocavel' => $bemLocavel->modelo,
            'valor' => $preco_total,
            'userNome' => $user->name,
            'numero_dias' => $diferencaDias,
            'referencia' => $referencia,
            'entidade' => $entidade,
        ]);
    }
}

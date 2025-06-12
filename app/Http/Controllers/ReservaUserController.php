<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\BemLocavel;
use Illuminate\Support\Facades\Auth;

class ReservaUserController extends Controller
{
    public function create($id)
    {

        $bemLocavel = BemLocavel::findOrFail($id);

        return view('reserva.create', compact('bemLocavel'));
    }

    public function store()
    {
        $possivel_reserva = session('possivel_reserva');
        if (!$possivel_reserva) {
            return redirect()->back()->withErrors(['error' => 'Nenhuma reserva possível encontrada.']);
        }

        $data_inicio = $possivel_reserva['data_inicio'];
        $data_fim = $possivel_reserva['data_fim'];
        $bem_locavel_id = $possivel_reserva['bem_locavel_id'];


        $bemLocavel = BemLocavel::findOrFail($bem_locavel_id);

        // Cálculo do preço total
        $dias = (new \DateTime($data_inicio))->diff(new \DateTime($data_fim))->days;
        $preco_total = $dias * $bemLocavel->preco_diario; // ajuste conforme o campo da sua tabela

        $reserva = Reserva::create([
            'user_id' =>  Auth::user()->id,
            'bem_locavel_id' => $bemLocavel->id,
            'data_inicio' => $data_inicio,
            'data_fim' => $data_fim,
            'preco_total' => $preco_total,
            'status' => 'reservado'
        ]);


        $reservaRelacionamento = Reserva::with([
            'bemLocavel',
            'user',
        ])->findOrFail($reserva->id);

        return view('sucesso', [
            'bemLocavel' => $reservaRelacionamento->bemLocavel,
            'valor' => $reserva->preco_total,
            'userNome' => $reservaRelacionamento->user->name,
            'reservaId' => $reserva->id,
        ]);
    }

    public function redirecionarParaReserva(Request $request)
    {
        return redirect()->route('reservas.create', [
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim
        ]);
    }

    public function minhasReservas()
    {
        $reservas = Reserva::where('user_id', auth()->id())
                          ->with('bemLocavel')
                          ->orderBy('created_at', 'desc')
                          ->paginate(5);

        return view('dashboard', compact('reservas'));
    }
}

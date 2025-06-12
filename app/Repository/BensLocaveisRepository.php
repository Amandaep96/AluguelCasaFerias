<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class BensLocaveisRepository
{

    public function all()
    {
        $disponiveis = DB::table('bens_locaveis')->get();
        return $disponiveis;

    }


    public function all_avalible($dataInicio, $dataFim, $hospedes)
    {
        // Se não houver filtros de data, retorna apenas filtro por hóspedes (se fornecido)
        if (!$dataInicio || !$dataFim) {
            $query = DB::table('bens_locaveis');

            if ($hospedes) {
                $query->where('numero_hospedes', '>=', $hospedes);
            }

            return $query->orderBy('numero_hospedes', 'asc')->get();
        }

        // Query principal com filtros de data e hóspedes
        $query = DB::table('bens_locaveis');

        // Filtro por número de hóspedes (se fornecido)
        if ($hospedes) {
            $query->where('numero_hospedes', '>=', $hospedes);
        }

        // Filtro de disponibilidade - exclui bens com reservas conflitantes
        $query->whereNotExists(function ($subQuery) use ($dataInicio, $dataFim) {
            $subQuery->select(DB::raw(1))
                ->from('reservas')
                ->whereColumn('reservas.bem_locavel_id', 'bens_locaveis.id')
                ->where('status', 'reservado')
                ->where(function ($dateQuery) use ($dataInicio, $dataFim) {
                    // Verifica todos os casos de sobreposição de datas
                    $dateQuery->where(function ($overlap) use ($dataInicio, $dataFim) {
                        // Caso 1: Reserva começa antes e termina durante o período solicitado
                        $overlap->where('data_inicio', '<=', $dataInicio)
                               ->where('data_fim', '>', $dataInicio);
                    })->orWhere(function ($overlap) use ($dataInicio, $dataFim) {
                        // Caso 2: Reserva começa durante e termina depois do período solicitado
                        $overlap->where('data_inicio', '<', $dataFim)
                               ->where('data_fim', '>=', $dataFim);
                    })->orWhere(function ($overlap) use ($dataInicio, $dataFim) {
                        // Caso 3: Reserva está completamente dentro do período solicitado
                        $overlap->where('data_inicio', '>=', $dataInicio)
                               ->where('data_fim', '<=', $dataFim);
                    })->orWhere(function ($overlap) use ($dataInicio, $dataFim) {
                        // Caso 4: Reserva engloba completamente o período solicitado
                        $overlap->where('data_inicio', '<=', $dataInicio)
                               ->where('data_fim', '>=', $dataFim);
                    });
                });
        });

        return $query->orderBy('numero_hospedes', 'asc')->get();
    }


    public function find($id)
    {
        // return Model::findOrFail($id);
    }

    public function create(array $data)
    {
        // return Model::create($data);
    }

    public function update($id, array $data)
    {
        // $model = Model::findOrFail($id);
        // $model->update($data);
        // return $model;
    }

    public function delete($id)
    {
        // return Model::destroy($id);
    }
}

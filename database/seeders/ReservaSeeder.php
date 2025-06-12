<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservaSeeder extends Seeder
{
    public function run(): void
    {
        // Coleta IDs válidos
        $userIds = DB::table('users')->pluck('id');
        $bemLocavelIds = DB::table('bens_locaveis')->pluck('id');

        if ($userIds->isEmpty() || $bemLocavelIds->isEmpty()) {
            $this->command->warn('Tabela users ou bens_locaveis está vazia. Popule-as antes de rodar este seeder.');
            return;
        }

        // Reservas com datas específicas
        $reservas = [
            [
                'data_inicio' => '2025-05-30',
                'data_fim' => '2025-06-01',
            ],
            [
                'data_inicio' => '2025-05-30',
                'data_fim' => '2025-06-03',
            ],
            [
                'data_inicio' => '2025-06-02',
                'data_fim' => '2025-06-05',
            ],
        ];

        foreach ($reservas as $reserva) {
            DB::table('reservas')->insert([
                'user_id' => $userIds->random(),
                'bem_locavel_id' => $bemLocavelIds->random(),
                'data_inicio' => $reserva['data_inicio'],
                'data_fim' => $reserva['data_fim'],
                'preco_total' => rand(300, 1000),
                'status' => 'reservado',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

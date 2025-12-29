<?php

namespace Database\Seeders;

use App\Models\Fundo;
use App\Models\Participante;
use Illuminate\Database\Seeder;

class FundoTableSeeder extends Seeder
{
public function run(): void
    {
        $fundos = Fundo::factory(10)->create();

        $participantes = Participante::factory(100)->create();

        foreach ($participantes as $participante) {
            $participante->fundos()->attach(
                $fundos->random(rand(1, 3))->pluck('id')->toArray(),
                ['cotas' => rand(10, 500)]
            );
        }
    }
}

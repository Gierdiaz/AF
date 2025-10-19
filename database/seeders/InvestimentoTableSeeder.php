<?php

namespace Database\Seeders;

use App\Models\Investimento;
use Illuminate\Database\Seeder;

class InvestimentoTableSeeder extends Seeder
{
    public function run(): void
    {
        Investimento::factory(100)->create();
    }
}

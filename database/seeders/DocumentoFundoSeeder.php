<?php

namespace Database\Seeders;

use App\Models\DocumentoFundo;
use Illuminate\Database\Seeder;

class DocumentoFundoSeeder extends Seeder
{
    public function run(): void
    {
        DocumentoFundo::factory()->count(10)->create();
    }
}

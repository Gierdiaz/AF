<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = DB::table('categorias')->get();
        $produtos = [];

        foreach ($categorias as $categoria) {
            for ($i = 1; $i <= 2; $i++) {
                $produtos[] = [
                    'categoria_id' => $categoria->id,
                    'nome' => "Produto {$i} - {$categoria->nome}",
                    'preco' => rand(50, 500),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('produtos')->insert($produtos);
    }
}

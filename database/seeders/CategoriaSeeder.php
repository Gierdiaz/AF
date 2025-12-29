<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Eletrônicos', 'Livros', 'Roupas', 'Casa', 'Esporte',
            'Beleza', 'Brinquedos', 'Automotivo', 'Informática', 'Games'
        ];

        $data = [];

        foreach ($categorias as $nome) {
            $data[] = [
                'nome' => $nome,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('categorias')->insert($data);

    }
}

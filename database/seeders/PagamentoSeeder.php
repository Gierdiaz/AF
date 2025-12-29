<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pedidos = DB::table('pedidos')->get();
        $metodos = ['cartao_credito', 'pix', 'boleto'];
        $pagamentos = [];

        foreach ($pedidos as $pedido) {
            $pagamentos[] = [
                'pedido_id' => $pedido->id,
                'metodo' => $metodos[array_rand($metodos)],
                'quantidade' => $pedido->total,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('pagamentos')->insert($pagamentos);
    }
}

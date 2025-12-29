<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pedidos = DB::table('pedidos')->get();
        $produtos = DB::table('produtos')->get();
        $items = [];

        foreach ($pedidos as $order) {
            for ($i = 0; $i < 3; $i++) {
                $produto = $produtos->random();

                $items[] = [
                    'pedido_id' => $order->id,
                    'produto_id' => $produto->id,
                    'quantidade' => rand(1, 5),
                    'preco' => $produto->preco,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('pedido_itens')->insert($items);
    }
}

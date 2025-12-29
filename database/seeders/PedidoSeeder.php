<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = DB::table('users')->get();
        $clientes = DB::table('clientes')->get();
        $pedidos = [];

        foreach ($users as $user) {
            for ($i = 0; $i < 2; $i++) {
                $pedidos[] = [
                    'user_id' => $user->id,
                    'cliente_id' => $clientes->random()->id,
                    'total' => rand(100, 1000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('pedidos')->insert($pedidos);
    }
}

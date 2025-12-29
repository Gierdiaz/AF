<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
<<<<<<< HEAD
            FundoTableSeeder::class, 
            DocumentoFundoSeeder::class,
            UsuarioSeeder::class,
            ClientSeeder::class,
            CategoriaSeeder::class,
            ProdutoSeeder::class,
            PedidoSeeder::class,
            PedidoItemSeeder::class,
            PagamentoSeeder::class
=======
            FundoTableSeeder::class,
            InvestimentoTableSeeder::class
            
>>>>>>> 58e04faadf1075b86e9ab3b87b07feb3172628fe
        ]);

    }
}

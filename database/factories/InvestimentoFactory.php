<?php

namespace Database\Factories;

use App\Models\Fundo;
use App\Models\Investimento;
use App\Enums\TipoInvestimentoEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Investimento>
 */
class InvestimentoFactory extends Factory
{
    protected $model = Investimento::class;

    public function definition(): array
    {
        return [
            'fundo_id' => Fundo::factory(),
            'nome' => $this->faker->company . ' Ativo',
            'tipo_investimento' => $this->faker->randomElement(array_column(TipoInvestimentoEnum::cases(), 'value')),
            'valor' => $this->faker->randomFloat(2, 1000, 1000000),
        ];
    }
}

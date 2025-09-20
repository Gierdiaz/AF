<?php

namespace Database\Factories;

use App\Enums\TipoFundoEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fundo>
 */
class FundoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->company . ' Fundo de Investimento',
            'tipo_fundo' => $this->faker->randomElement(array_column(TipoFundoEnum::cases(), 'value')),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Enums\TipoParticipanteEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participante>
 */
class ParticipanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'tipo_participante' => $this->faker->randomElement(array_column(TipoParticipanteEnum::cases(), 'value')),
            
        ];
    }
}

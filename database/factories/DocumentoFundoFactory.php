<?php

namespace Database\Factories;

use App\Enums\TipoDocumentoFundoEnum;
use App\Models\DocumentoFundo;
use App\Models\Fundo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentoFundo>
 */
class DocumentoFundoFactory extends Factory
{
    protected $model = DocumentoFundo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fundo_id' => Fundo::inRandomOrder()->first()?->id,
            'tipo_documento' => $this->faker->randomElement(array_column(TipoDocumentoFundoEnum::cases(), 'value')),
            'data_publicada' => $this->faker->date(),
        ];
    }
}

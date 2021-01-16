<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'assunto' => $this->faker->sentence(6),
            'text' => $this->faker->paragraph(2),
            'postador' => $this->faker->name, // aqui vai o nome do postador e empresa
            'user_id' => $this->faker->numberBetween('1', '5'),
        ];
    }
}

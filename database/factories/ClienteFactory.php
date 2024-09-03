<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class clienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>$this->faker->firstName(),
            'segnombre'=>$this->faker->firstName(),
            'apellidopat'=>$this->faker->lastName(),
            'apellidomat'=>$this->faker->lastName(),
            'telefono'=>$this->faker->phoneNumber(),
            'direccion'=>$this->faker->address(),
            'email'=>$this->faker->safeEmail(),
            'rfc'=>$this->faker->name(),
            'comentarios'=>$this->faker->name()

            //
        ];
    }
}

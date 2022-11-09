<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tienda>
 */
class tiendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Producto'=>fake()->name(),
            'Costo'=>fake()->randomFloat(10,1000,10000),
            'Cantidad'=>fake()->randomFloat(),
            'Descripcion'=>fake()->text()
        ];

    }
}

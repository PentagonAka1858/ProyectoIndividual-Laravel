<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FrutasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            /*
            $table->string('nombre', 100);
            $table->date('fecha_recoleccion');
            $table->date('fecha_caducidad');
            $table->enum('conservacion', ['Frio', 'Ambiente']);
            $table->string('origen');
            $table->decimal('peso',12,2);
            $table->decimal('precio',12,2);
            $table->foreignId('proveedor_id')->constrained('users')->onUpdate('cascade');
            */
            'nombre' => fake()->name(),
            'fecha_recoleccion' => fake()->dateTimeBetween('-1 year', '0 years')->format('Y-m-d'),
            'fecha_caducidad' => fake()->dateTimeBetween('0 years', '+1 years')->format('Y-m-d'),
            'conservacion' => fake()->randomElement(['Frio', 'Ambiente']),
            'origen' => fake()->country(),
            'peso' => fake()->randomFloat(2, 0.1, 20),
            'precio' => fake()->randomFloat(2, 0.1, 20),
            
        ];
    }
}

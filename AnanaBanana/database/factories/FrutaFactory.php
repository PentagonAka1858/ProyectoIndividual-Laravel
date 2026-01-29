<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FrutaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Lista de frutas para elegir una aleatoria como nombre
        $lista_fruta = [
            'Manzana', 'Pera', 'Plátano', 'Naranja', 'Fresa', 'Uva', 'Sandía', 'Melón',
            'Mango', 'Piña', 'Papaya', 'Kiwi', 'Cereza', 'Durazno', 'Albaricoque',
            'Ciruela', 'Granada', 'Limón', 'Lima', 'Mandarina',
            'Pomelo', 'Frambuesa', 'Mora', 'Arándano', 'Grosella',
            'Higo', 'Dátil', 'Coco', 'Guayaba', 'Maracuyá',
            'Lichi', 'Rambután', 'Pitahaya', 'Carambola', 'Chirimoya',
            'Tamarindo', 'Níspero', 'Kumquat', 'Feijoa', 'Mangostán',
            'Acerola', 'Zapote', 'Caimito', 'Salak', 'Ackee',
            'Jaca', 'Yaca', 'Longan', 'Pepino dulce'
        ];

        
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
            'nombre' => fake()->randomElement($lista_fruta),
            'fecha_recoleccion' => fake()->dateTimeBetween('-1 year', '0 years')->format('Y-m-d'),
            'fecha_caducidad' => fake()->dateTimeBetween('0 years', '+1 years')->format('Y-m-d'),
            'conservacion' => fake()->randomElement(['Frio', 'Ambiente']),
            'origen' => fake()->country(),
            'peso' => fake()->randomFloat(2, 0.1, 20),
            'precio_kg' => fake()->randomFloat(2, 1, 20),
            'proveedor_id' => User::factory(),
            
        ];
    }
}

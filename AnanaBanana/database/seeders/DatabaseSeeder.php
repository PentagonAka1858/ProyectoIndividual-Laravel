<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        
        // Create one specific test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        // Creamos 99 usuarios aleatorios
        User::factory(99)->create();
        
        // Get all users from the database
        $users = User::all();
            
        // Create frutas
        Fruta::factory(200)->create([
            'proveedor_id' => fn() => $users->random()->id
        ]);
        
    }
}

<?php

namespace Database\Seeders;

use App\Models\Fruta;
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
            'role' => 'user',
            'email' => 'test@example.com',
        ]);
        
        // Create one specific admin user
        User::factory()->create([
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@example.com',
        ]);
        
        // Creamos 98 usuarios aleatorios
        User::factory(98)->create();
        
        // Get all users from the database
        $users = User::all();
            
        // Create frutas
        Fruta::factory(200)->create([
            'proveedor_id' => fn() => $users->random()->id
        ]);
        
    }
}

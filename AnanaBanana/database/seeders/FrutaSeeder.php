<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fruta;
use App\Models\User;

class FrutaSeeder extends Seeder
{
    public function run(): void
    {
        // Create 5 users first
        $users = User::factory(5)->create();

        // Create 20 frutas assigned to random users
        Fruta::factory(20)->create([
            'proveedor_id' => fn() => $users->random()->id
        ]);
    }
}

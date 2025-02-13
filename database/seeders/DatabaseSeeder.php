<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Exécuter d'abord le RoleSeeder pour créer les rôles
        $this->call(RoleSeeder::class);

        // Créer les utilisateurs et leur assigner des rôles
        $admin = User::factory()->create([
            'name' => 'Fugen l\'ancien',
            'email' => 'chef@mail.fr',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('Chef du village'); // Assigner le rôle 

        $developpeur = User::factory()->create([
            'name' => 'sakura',
            'email' => 'organisateur@mail.fr',
            'password' => Hash::make('password'),
        ]);
        $developpeur->assignRole('organisateur'); // Assigner le rôle 

        $client = User::factory()->create([
            'name' => 'Romanu',
            'email' => 'chasseur@mail.fr',
            'password' => Hash::make('password'),
        ]);
        $client->assignRole('chasseur'); // Assigner le rôle 
    }
}


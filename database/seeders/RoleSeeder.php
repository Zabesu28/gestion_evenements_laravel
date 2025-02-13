<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création des roles
        $admin = Role::create(['name' => 'Chef du village']);
        $developpeur = Role::create(['name' => 'Organisateur']);
        $client = Role::create(['name' => 'Chasseur']);

        // Création de permissions
        Permission::create(['name' => 'creer_projet']);
        Permission::create(['name' => 'creer_role']);
        Permission::create(['name' => 'creer_permission']);
        Permission::create(['name' => 'gerer_taches']);
        Permission::create(['name' => 'gerer_projets']);
        Permission::create(['name' => 'gerer_utilisateurs']);
        Permission::create(['name' => 'gerer_roles']);
        Permission::create(['name' => 'gerer_permissions']);
        Permission::create(['name' => 'valider_tache']);
        Permission::create(['name' => 'valider_projet']);

        // On assigne des permissions aux roles
        $admin->givePermissionTo(['creer_projet', 'creer_role', 'creer_permission', 'gerer_taches', 'gerer_projets', 'gerer_utilisateurs', 'gerer_roles', 'gerer_permissions', 'valider_tache', 'valider_projet', ]);
        $developpeur->givePermissionTo(['gerer_taches', 'valider_tache']);
        $client->givePermissionTo(['valider_projet']);
    }
}

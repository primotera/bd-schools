<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create([
            'nom' => 'Role_Admin',
            'description' => 'Rôle attribué aux administrateurs système avec des privilèges étendus sur l\'ensemble du système. Ces utilisateurs peuvent gérer les paramètres globaux et avoir un accès administratif complet.',
        ]); {
            Role::factory()->create([
                'nom' => 'Role_User',
                'description' => 'Rôle attribué aux utilisateurs simples avec des privilèges étendus sur l\'ensemble du système. Ces utilisateurs peuvent gérer les paramètres globaux et avoir un accès administratif complet.',
            ]);
        }
    }
}

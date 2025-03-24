<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Définir les rôles pour l'application
        $roles = [
            [
                'name' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'teacher',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insérer les rôles
        DB::table('role')->insert($roles);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Lancer les seeders des utilisateurs.
     */
    public function run(): void
    {
        // Créer quelques utilisateurs de test
        $users = [
            [
                'user_id' => Str::uuid()->toString(),
                'email' => 'admin@example.com',
                'username' => 'admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role_id' => DB::table('role')->where('name', 'admin')->first()->role_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => Str::uuid()->toString(),
                'email' => 'user@example.com',
                'username' => 'testuser',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role_id' => DB::table('role')->where('name', 'user')->first()->role_id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insérer les utilisateurs
        DB::table('user')->insert($users);
    }
}

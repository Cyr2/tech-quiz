<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer des quiz basés sur le document PDF fourni
        $quizzes = [
            [
                'quiz_id' => Str::uuid()->toString(),
                'title' => 'JavaScript Quiz',
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => Str::uuid()->toString(),
                'title' => 'HTML Quiz',
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => Str::uuid()->toString(),
                'title' => 'CSS Quiz',
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => Str::uuid()->toString(),
                'title' => 'Web Accessibility Quiz',
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insérer les quiz
        DB::table('quiz')->insert($quizzes);
    }
}

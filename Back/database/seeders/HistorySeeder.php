<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les utilisateurs
        $users = DB::table('user')->get();
        
        // Récupérer les quiz
        $quizzes = DB::table('quiz')->get();
        
        // Créer 20 historiques de quiz pris
        $histories = [];
        
        for ($i = 0; $i < 20; $i++) {
            // Sélectionner un utilisateur aléatoire
            $user = $users->random();
            
            // Sélectionner un quiz aléatoire
            $quiz = $quizzes->random();
            
            // Créer une date aléatoire dans les 30 derniers jours
            $date = Carbon::now()->subDays(rand(0, 30))->format('Y-m-d');
            
            // Générer un score aléatoire entre 0 et 100
            $score = rand(0, 100);
            
            $histories[] = [
                'history_id' => Str::uuid()->toString(),
                'date' => $date,
                'score' => $score,
                'user_id' => $user->user_id,
                'quiz_id' => $quiz->quiz_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        // Insérer les historiques
        DB::table('history')->insert($histories);
    }
}

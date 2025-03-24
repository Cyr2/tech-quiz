<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // JavaScript Quiz - Question 1
        $q1Id = DB::table('question')
            ->where('label', 'What keyword is used to declare a variable in JavaScript?')
            ->first()->question_id;
        
        $jsQ1Answers = [
            [
                'label' => 'let',
                'is_correct' => false,
                'question_id' => $q1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'var',
                'is_correct' => false,
                'question_id' => $q1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'const',
                'is_correct' => false,
                'question_id' => $q1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'All of the above',
                'is_correct' => true,
                'question_id' => $q1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('answer')->insert($jsQ1Answers);

        // JavaScript Quiz - Question 2
        $q2Id = DB::table('question')
            ->where('label', 'What is the output of console.log(typeof []) ?')
            ->first()->question_id;
        
        $jsQ2Answers = [
            [
                'label' => '"array"',
                'is_correct' => false,
                'question_id' => $q2Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => '"object"',
                'is_correct' => true,
                'question_id' => $q2Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => '"undefined"',
                'is_correct' => false,
                'question_id' => $q2Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => '"function"',
                'is_correct' => false,
                'question_id' => $q2Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('answer')->insert($jsQ2Answers);

        // JavaScript Quiz - Question 3
        $q3Id = DB::table('question')
            ->where('label', 'How do you write a single-line comment in JavaScript?')
            ->first()->question_id;
        
        $jsQ3Answers = [
            [
                'label' => '# This is a comment',
                'is_correct' => false,
                'question_id' => $q3Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => '/* This is a comment */',
                'is_correct' => false,
                'question_id' => $q3Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => '// This is a comment',
                'is_correct' => true,
                'question_id' => $q3Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => '-- This is a comment',
                'is_correct' => false,
                'question_id' => $q3Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('answer')->insert($jsQ3Answers);

        // JavaScript Quiz - Question 4
        $q4Id = DB::table('question')
            ->where('label', 'What does the expression Boolean(\'false\') return?')
            ->first()->question_id;
        
        $jsQ4Answers = [
            [
                'label' => 'true',
                'is_correct' => true,
                'question_id' => $q4Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'false',
                'is_correct' => false,
                'question_id' => $q4Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'undefined',
                'is_correct' => false,
                'question_id' => $q4Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'NaN',
                'is_correct' => false,
                'question_id' => $q4Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('answer')->insert($jsQ4Answers);

        // JavaScript Quiz - Question 5
        $q5Id = DB::table('question')
            ->where('label', 'Which method is used to add an element to the end of an array in JavaScript?')
            ->first()->question_id;
        
        $jsQ5Answers = [
            [
                'label' => '.push()',
                'is_correct' => true,
                'question_id' => $q5Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => '.pop()',
                'is_correct' => false,
                'question_id' => $q5Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => '.shift()',
                'is_correct' => false,
                'question_id' => $q5Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => '.unshift()',
                'is_correct' => false,
                'question_id' => $q5Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('answer')->insert($jsQ5Answers);

        // Pour les autres questions, nous allons simplement ajouter les réponses correctes
        // pour démontrer l'approche. Dans un environnement réel, vous voudriez probablement
        // ajouter toutes les réponses pour chaque question.

        // HTML Quiz - Question 1
        $htmlQ1Id = DB::table('question')
            ->where('label', 'What is the role of HTML?')
            ->first()->question_id;
        
        $htmlQ1Answers = [
            [
                'label' => 'Defines the structure of a webpage',
                'is_correct' => true,
                'question_id' => $htmlQ1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'Applies style to webpages',
                'is_correct' => false,
                'question_id' => $htmlQ1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'Adds interactivity',
                'is_correct' => false,
                'question_id' => $htmlQ1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'Stores data',
                'is_correct' => false,
                'question_id' => $htmlQ1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('answer')->insert($htmlQ1Answers);

        // CSS Quiz - Question 1
        $cssQ1Id = DB::table('question')
            ->where('label', 'What does CSS stand for?')
            ->first()->question_id;
        
        $cssQ1Answers = [
            [
                'label' => 'Creative Style Sheets',
                'is_correct' => false,
                'question_id' => $cssQ1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'Cascading Style Sheets',
                'is_correct' => true,
                'question_id' => $cssQ1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'Computer Styled Sections',
                'is_correct' => false,
                'question_id' => $cssQ1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'Colorful Style Sheets',
                'is_correct' => false,
                'question_id' => $cssQ1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('answer')->insert($cssQ1Answers);

        // Accessibility Quiz - Question 1
        $accessQ1Id = DB::table('question')
            ->where('label', 'What is web accessibility?')
            ->first()->question_id;
        
        $accessQ1Answers = [
            [
                'label' => 'A set of rules to make a website faster',
                'is_correct' => false,
                'question_id' => $accessQ1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'Adapting websites for users with disabilities',
                'is_correct' => true,
                'question_id' => $accessQ1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'A principle to improve search engine optimization',
                'is_correct' => false,
                'question_id' => $accessQ1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'label' => 'A technology for creating animations',
                'is_correct' => false,
                'question_id' => $accessQ1Id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('answer')->insert($accessQ1Answers);

        // Note: dans un environnement de production, vous voudriez idéalement
        // mettre toutes les réponses pour toutes les questions
    }
}

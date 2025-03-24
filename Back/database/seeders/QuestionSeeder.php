<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenir les IDs des quiz
        $jsQuizId = DB::table('quiz')->where('title', 'JavaScript Quiz')->first()->quiz_id;
        $htmlQuizId = DB::table('quiz')->where('title', 'HTML Quiz')->first()->quiz_id;
        $cssQuizId = DB::table('quiz')->where('title', 'CSS Quiz')->first()->quiz_id;
        $accessibilityQuizId = DB::table('quiz')->where('title', 'Web Accessibility Quiz')->first()->quiz_id;

        // Questions JavaScript
        $jsQuestions = [
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What keyword is used to declare a variable in JavaScript?',
                'quiz_id' => $jsQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What is the output of console.log(typeof []) ?',
                'quiz_id' => $jsQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'How do you write a single-line comment in JavaScript?',
                'quiz_id' => $jsQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What does the expression Boolean(\'false\') return?',
                'quiz_id' => $jsQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which method is used to add an element to the end of an array in JavaScript?',
                'quiz_id' => $jsQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What is the output of console.log(2 + \'2\') ?',
                'quiz_id' => $jsQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which structure is used to execute code repeatedly?',
                'quiz_id' => $jsQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which object is used to manipulate dates in JavaScript?',
                'quiz_id' => $jsQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What does the JSON.stringify() method do?',
                'quiz_id' => $jsQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What is the difference between == and === in JavaScript?',
                'quiz_id' => $jsQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Questions HTML
        $htmlQuestions = [
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What is the role of HTML?',
                'quiz_id' => $htmlQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What is the correct tag to insert an image in HTML?',
                'quiz_id' => $htmlQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which tag is used to create a hyperlink?',
                'quiz_id' => $htmlQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What is the basic structure of an HTML document?',
                'quiz_id' => $htmlQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which tag is used to insert an unordered list?',
                'quiz_id' => $htmlQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'How do you create an input field for a form in HTML?',
                'quiz_id' => $htmlQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which tag is used to create a table in HTML?',
                'quiz_id' => $htmlQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which attribute allows you to open a link in a new tab?',
                'quiz_id' => $htmlQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which tag is used to define a navigation section?',
                'quiz_id' => $htmlQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What is the correct semantics for a first-level heading in HTML?',
                'quiz_id' => $htmlQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Questions CSS
        $cssQuestions = [
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What does CSS stand for?',
                'quiz_id' => $cssQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which CSS property is used to change the text color?',
                'quiz_id' => $cssQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which CSS selector is used to target an element with id="menu" ?',
                'quiz_id' => $cssQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which of these CSS rules adds 10px of padding inside an element?',
                'quiz_id' => $cssQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What is the effect of display: flex; on an element?',
                'quiz_id' => $cssQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which CSS property is used to round the corners of an element?',
                'quiz_id' => $cssQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which position value allows an element to stay fixed at the top of the page while scrolling?',
                'quiz_id' => $cssQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which property is used to add a shadow to text in CSS?',
                'quiz_id' => $cssQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which CSS rule is used to apply a style only when the user hovers over an element?',
                'quiz_id' => $cssQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which CSS unit is relative to the parent element\'s font size?',
                'quiz_id' => $cssQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Questions Accessibility
        $accessibilityQuestions = [
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What is web accessibility?',
                'quiz_id' => $accessibilityQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which HTML tag is used to provide alternative text for images?',
                'quiz_id' => $accessibilityQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What does WCAG stand for?',
                'quiz_id' => $accessibilityQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which text color provides the best contrast on a white background?',
                'quiz_id' => $accessibilityQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which ARIA attribute is used to define a text alternative when no visible text is available?',
                'quiz_id' => $accessibilityQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What does keyboard navigation allow?',
                'quiz_id' => $accessibilityQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Why is it important to use semantic HTML tags ( <header> , <nav> , <main> , <footer> )?',
                'quiz_id' => $accessibilityQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'What is essential to make a website accessible to visually impaired users?',
                'quiz_id' => $accessibilityQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which CSS property improves readability for dyslexic people?',
                'quiz_id' => $accessibilityQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_id' => Str::uuid()->toString(),
                'label' => 'Which tool can be used to test the accessibility of a website?',
                'quiz_id' => $accessibilityQuizId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insérer toutes les questions
        DB::table('question')->insert(array_merge($jsQuestions, $htmlQuestions, $cssQuestions, $accessibilityQuestions));
    }
}

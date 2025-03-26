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
        // JavaScript Quiz - All 10 Questions
        $jsQuestions = [
            'What keyword is used to declare a variable in JavaScript?',
            'What is the output of console.log(typeof []) ?',
            'How do you write a single-line comment in JavaScript?',
            'What does the expression Boolean(\'false\') return?',
            'Which method is used to add an element to the end of an array in JavaScript?',
            'What is the output of console.log(2 + \'2\') ?',
            'Which structure is used to execute code repeatedly?',
            'Which object is used to manipulate dates in JavaScript?',
            'What does the JSON.stringify() method do?',
            'What is the difference between == and === in JavaScript?'
        ];

        $jsQuizAnswers = [
            [
                ['let', false],
                ['var', false],
                ['const', false],
                ['All of the above', true]
            ],
            [
                ['"array"', false],
                ['"object"', true],
                ['"undefined"', false],
                ['"function"', false]
            ],
            [
                ['# This is a comment', false],
                ['/* This is a comment */', false],
                ['// This is a comment', true],
                [' This is a comment', false]
            ],
            [
                ['true', true],
                ['false', false],
                ['undefined', false],
                ['NaN', false]
            ],
            [
                ['.push()', true],
                ['.pop()', false],
                ['.shift()', false],
                ['.unshift()', false]
            ],
            [
                ['4', false],
                ['22', true],
                ['NaN', false],
                ['TypeError', false]
            ],
            [
                ['if', false],
                ['switch', false],
                ['loop', false],
                ['for', true]
            ],
            [
                ['Date', true],
                ['Time', false],
                ['Clock', false],
                ['Calendar', false]
            ],
            [
                ['Converts a JavaScript object to a JSON string', true],
                ['Converts a JSON string to a JavaScript object', false],
                ['Checks if a string is in JSON format', false],
                ['None of the above', false]
            ],
            [
                ['No difference', false],
                ['== compares values only, while === compares both values and types', true],
                ['=== compares values only', false],
                ['== compares memory references', false]
            ]
        ];

        // HTML Quiz - All 10 Questions
        $htmlQuestions = [
            'What is the role of HTML?',
            'What is the correct tag to insert an image in HTML?',
            'Which tag is used to create a hyperlink?',
            'What is the basic structure of an HTML document?',
            'Which tag is used to insert an unordered list?',
            'How do you create an input field for a form in HTML?',
            'Which tag is used to create a table in HTML?',
            'Which attribute allows you to open a link in a new tab?',
            'Which tag is used to define a navigation section?',
            'What is the correct semantics for a first-level heading in HTML?'
        ];

        $htmlQuizAnswers = [
            [
                ['Defines the structure of a webpage', true],
                ['Applies style to webpages', false],
                ['Adds interactivity', false],
                ['Stores data', false]
            ],
            [
                ['<image>', false],
                ['<img>', true],
                ['<picture>', false],
                ['<photo>', false]
            ],
            [
                ['<link>', false],
                ['<a>', true],
                ['<href>', false],
                ['<url>', false]
            ],
            [
                ['<html><head><title></title></head><body></body></html>', true],
                ['<header><body><footer>', false],
                ['<main><article><section>', false],
                ['<head><content><footer>', false]
            ],
            [
                ['<ol>', false],
                ['<ul>', true],
                ['<li>', false],
                ['<list>', false]
            ],
            [
                ['<text>', false],
                ['<input type="text">', true],
                ['<textbox>', false],
                ['<field>', false]
            ],
            [
                ['<table>', true],
                ['<tr>', false],
                ['<td>', false],
                ['<tab>', false]
            ],
            [
                ['target="_self"', false],
                ['target="_new"', false],
                ['target="_blank"', true],
                ['target="new_tab"', false]
            ],
            [
                ['<nav>', true],
                ['<menu>', false],
                ['<section>', false],
                ['<header>', false]
            ],
            [
                ['<head>', false],
                ['<title>', false],
                ['<h1>', true],
                ['<header>', false]
            ]
        ];

        // CSS Quiz - All 10 Questions
        $cssQuestions = [
            'What does CSS stand for?',
            'Which CSS property is used to change the text color?',
            'Which CSS selector is used to target an element with id="menu" ?',
            'Which of these CSS rules adds 10px of padding inside an element?',
            'What is the effect of display: flex; on an element?',
            'Which CSS property is used to round the corners of an element?',
            'Which position value allows an element to stay fixed at the top of the page while scrolling?',
            'Which property is used to add a shadow to text in CSS?',
            'Which CSS rule is used to apply a style only when the user hovers over an element?',
            'Which CSS unit is relative to the parent element\'s font size?'
        ];

        $cssQuizAnswers = [
            [
                ['Creative Style Sheets', false],
                ['Cascading Style Sheets', true],
                ['Computer Styled Sections', false],
                ['Colorful Style Sheets', false]
            ],
            [
                ['text-color', false],
                ['color', true],
                ['font-color', false],
                ['text-style', false]
            ],
            [
                ['.menu', false],
                ['#menu', true],
                ['menu', false],
                ['*menu*', false]
            ],
            [
                ['margin: 10px;', false],
                ['padding: 10px;', true],
                ['spacing: 10px;', false],
                ['border-spacing: 10px;', false]
            ],
            [
                ['It prevents the element from being displayed', false],
                ['It aligns child elements in a row or column', true],
                ['It turns the element into a table', false],
                ['It forces the element to take up the full width', false]
            ],
            [
                ['corner-radius', false],
                ['border-radius', true],
                ['rounding', false],
                ['border-style', false]
            ],
            [
                ['relative', false],
                ['absolute', false],
                ['fixed', true],
                ['static', false]
            ],
            [
                ['text-decoration', false],
                ['text-shadow', true],
                ['box-shadow', false],
                ['shadow-effect', false]
            ],
            [
                [':focus', false],
                [':visited', false],
                [':hover', true],
                [':active', false]
            ],
            [
                ['px', false],
                ['em', true],
                ['%', false],
                ['vh', false]
            ]
        ];

        // Web Accessibility Quiz - All 10 Questions
        $accessibilityQuestions = [
            'What is web accessibility?',
            'Which HTML tag is used to provide alternative text for images?',
            'What does WCAG stand for?',
            'Which text color provides the best contrast on a white background?',
            'Which ARIA attribute is used to define a text alternative when no visible text is available?',
            'What does keyboard navigation allow?',
            'Why is it important to use semantic HTML tags ( <header> , <nav> , <main> , <footer> )?',
            'What is essential to make a website accessible to visually impaired users?',
            'Which CSS property improves readability for dyslexic people?',
            'Which tool can be used to test the accessibility of a website?'
        ];

        $accessibilityQuizAnswers = [
            [
                ['A set of rules to make a website faster', false],
                ['Adapting websites for users with disabilities', true],
                ['A principle to improve search engine optimization', false],
                ['A technology for creating animations', false]
            ],
            [
                ['title', false],
                ['alt', true],
                ['aria-label', false],
                ['desc', false]
            ],
            [
                ['Web Content Accessibility Guidelines', true],
                ['Web Compliance and Accessibility Guide', false],
                ['Worldwide Content Accessibility Guide', false],
                ['Web Color Accessibility Guidelines', false]
            ],
            [
                ['Yellow', false],
                ['Light blue', false],
                ['Black', true],
                ['Light gray', false]
            ],
            [
                ['aria-hidden', false],
                ['aria-label', true],
                ['aria-description', false],
                ['alt', false]
            ],
            [
                ['Navigating only in forms', false],
                ['Navigating a website without using the mouse', true],
                ['Modifying page displays', false],
                ['Using keyboard shortcuts to code', false]
            ],
            [
                ['To better structure the page and improve accessibility', true],
                ['To make the website faster', false],
                ['To avoid using CSS', false],
                ['To add animations', false]
            ],
            [
                ['A colorful design', false],
                ['Text that is readable with good contrast', true],
                ['Fancy fonts', false],
                ['Large images', false]
            ],
            [
                ['letter-spacing: 0;', false],
                ['font-family: Arial, sans-serif;', true],
                ['text-transform: uppercase;', false],
                ['word-spacing: 2px;', false]
            ],
            [
                ['Google PageSpeed', false],
                ['Lighthouse', true],
                ['Photoshop', false],
                ['Figma', false]
            ]
        ];

        // Process and insert answers for each quiz
        $quizzes = [
            'JavaScript Quiz' => $jsQuizAnswers,
            'HTML Quiz' => $htmlQuizAnswers,
            'CSS Quiz' => $cssQuizAnswers,
            'Web Accessibility Quiz' => $accessibilityQuizAnswers
        ];

        $quizQuestionsMap = [
            'JavaScript Quiz' => $jsQuestions,
            'HTML Quiz' => $htmlQuestions,
            'CSS Quiz' => $cssQuestions,
            'Web Accessibility Quiz' => $accessibilityQuestions,
        ];

        foreach ($quizzes as $quizTitle => $quizAnswers) {
            $quizId = DB::table('quiz')->where('title', $quizTitle)->first()->quiz_id;
            $questions = DB::table('question')->where('quiz_id', $quizId)->get();

            foreach ($questions as $question) {
                // Utilisez la correspondance explicite pour obtenir les questions
                $questionIndex = array_search($question->label, $quizQuestionsMap[$quizTitle]);

                if ($questionIndex === false) {
                    continue; // Skip if the question is not found
                }

                $answers = array_map(function($answer) use ($question) {
                    return [
                        'label' => $answer[0],
                        'is_correct' => $answer[1],
                        'question_id' => $question->question_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }, $quizAnswers[$questionIndex]);

                DB::table('answer')->insert($answers);
            }
        }
    }
}
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\HistoryController;


// Routes publiques pour l'authentification
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


// Routes protégées
Route::middleware('\App\Http\Middleware\EnsureAuthenticated::class')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::post('/create/user', [UserController::class, 'store']);
    Route::post('/update/user/{id}', [UserController::class, 'update']);
    Route::delete('/delete/user/{id}', [UserController::class, 'destroy']);

    Route::get('/quiz', [QuizController::class, 'index']);
    Route::get('/quiz/{id}', [QuizController::class, 'show']);
    Route::post('/create/quiz', [QuizController::class, 'store']);
    Route::post('/update/quiz/{id}', [QuizController::class, 'update']);
    Route::delete('/delete/quiz/{id}', [QuizController::class, 'destroy']);

    Route::get('/questions', [QuestionController::class, 'index']);
    Route::get('/question/{id}', [QuestionController::class, 'show']);
    Route::post('/create/question', [QuestionController::class, 'store']);
    Route::post('/update/question/{id}', [QuestionController::class, 'update']);
    Route::delete('/delete/question/{id}', [QuestionController::class, 'destroy']);
    Route::get('/question/quiz/{id}', [QuestionController::class, 'showByQuiz']);

    Route::get('/answers', [AnswerController::class, 'index']);
    Route::get('/answer/{id}', [AnswerController::class, 'show']);
    Route::post('/create/answer', [AnswerController::class, 'store']);
    Route::post('/update/answer/{id}', [AnswerController::class, 'update']);
    Route::delete('/delete/answer/{id}', [AnswerController::class, 'destroy']);
    Route::get('/answer/question/{id}', [AnswerController::class, 'showByQuestion']);

    Route::get('/history', [HistoryController::class, 'index']);
    Route::get('/history/{id}', [HistoryController::class, 'show']);
    Route::post('/create/history', [HistoryController::class, 'store']);
    Route::put('/update/history/{id}', [HistoryController::class, 'update']);
    Route::delete('/delete/history/{id}', [HistoryController::class, 'destroy']);
    Route::get('/history/user/{id}', [HistoryController::class, 'showByUser']);
    Route::get('/history/quiz/{id}', [HistoryController::class, 'showByQuiz']);


});
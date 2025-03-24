<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        schema::create('history', function (Blueprint $table) {
            $table->string('history_id')->primary();
            $table->date('date');
            $table->string('score');
            $table->string('user_id')->references('user_id')->on('user');
            $table->string('quiz_id');
            $table->foreign('quiz_id')->references('quiz_id')->on('quiz');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};

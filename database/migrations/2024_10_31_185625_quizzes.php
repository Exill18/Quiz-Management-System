<?php

// database/migrations/create_quizzes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Creator of the quiz
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Pivot table for users who completed quizzes
        Schema::create('quiz_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable(); // null if the user is a guest
            $table->string('username'); // for guest users
            $table->integer('score')->nullable();
            $table->timestamps();
        });

        // Quiz-Tag Relationship
        Schema::create('quiz_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_user');
        Schema::dropIfExists('quiz_tag');
        Schema::dropIfExists('quizzes');
    }
};

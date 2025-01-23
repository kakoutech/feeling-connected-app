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

        // Attendees Table
        Schema::create('attendees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->timestamps();
        });

        // Activities Table
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('venue');
            $table->string('postal_code');
            $table->timestamps();
        });

        // Venues Table
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('venue');
            $table->string('postal_code');
            $table->timestamps();
        });

        // Surveys Table
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Survey Questions Table
        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained()->onDelete('cascade');
            $table->text('question');
            $table->timestamps();
        });

        // Survey Question Options Table
        Schema::create('survey_question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_question_id')->constrained()->onDelete('cascade');
            $table->string('option');
            $table->timestamps();
        });

        // Survey Answers Table
        Schema::create('survey_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendee_id')->constrained()->onDelete('cascade');
            $table->foreignId('survey_question_id')->constrained()->onDelete('cascade');
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->foreignId('venue_id')->constrained()->onDelete('cascade');
            $table->string('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_answers');
        Schema::dropIfExists('survey_question_options');
        Schema::dropIfExists('survey_questions');
        Schema::dropIfExists('surveys');
        Schema::dropIfExists('venues');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('attendees');
    }
};

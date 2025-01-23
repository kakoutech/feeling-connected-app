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
          // Modify the column to allow NULL values
          Schema::table('survey_answers', function (Blueprint $table) {
              $table->string('answer')->nullable(false)->change();
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('survey_answers', function (Blueprint $table) {
            $table->string('answer')->nullable()->change();
        });
    }
};

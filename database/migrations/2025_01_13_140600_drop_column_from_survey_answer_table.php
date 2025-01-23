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
        Schema::table('survey_answers', function (Blueprint $table) {
            $table->dropForeign(['venue_id']); 

            // Drop the column
            $table->dropColumn('venue_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('survey_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('venue_id')->nullable();

            // Add the foreign key constraint back
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
        });
    }
};

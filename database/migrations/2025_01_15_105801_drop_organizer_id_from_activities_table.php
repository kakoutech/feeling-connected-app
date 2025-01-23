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
        Schema::table('activities', function (Blueprint $table) {
            // Check if the column exists before trying to drop it
            if (Schema::hasColumn('activities', 'organizer_id')) {
                $table->dropColumn('organizer_id');  // Drop the column only if it exists
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            // Add the column back in the down method
            $table->string('organizer_id')->nullable();
        });
    }
};

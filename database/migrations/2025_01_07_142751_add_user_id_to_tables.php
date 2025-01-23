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
            if (!Schema::hasColumn('activities', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            }
        });
    
        Schema::table('venues', function (Blueprint $table) {
            if (!Schema::hasColumn('venues', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            }
        });
    
        Schema::table('surveys', function (Blueprint $table) {
            if (!Schema::hasColumn('surveys', 'user_id')) {
                $table->foreignId('user_id')->after('name')->nullable()->constrained()->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('activities', function (Blueprint $table) {
        //     // Skip dropping the foreign key if it doesn't exist
        //     if (Schema::hasColumn('activities', 'user_id')) {
        //         $table->dropForeign(['user_id']);
        //     }
        //     $table->dropColumn('user_id');
        // });
    
        // Schema::table('venues', function (Blueprint $table) {
        //     if (Schema::hasColumn('venues', 'user_id')) {
        //         $table->dropForeign(['user_id']);
        //     }
        //     $table->dropColumn('user_id');
        // });
    
        // Schema::table('surveys', function (Blueprint $table) {
        //     if (Schema::hasColumn('surveys', 'user_id')) {
        //         $table->dropForeign(['user_id']);
        //     }
        //     $table->dropColumn('user_id');
        // });
        
    }
};

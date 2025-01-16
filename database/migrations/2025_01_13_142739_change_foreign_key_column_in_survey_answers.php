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
                    if (Schema::hasColumn('survey_answers', 'attendee_id')) {
                        $table->dropForeign(['attendee_id']);
                        $table->dropColumn('attendee_id');
                    }
                    if (!Schema::hasColumn('survey_answers', 'postal_code')) {
                        $table->string('postal_code')->after('answer');
                    }
                });
            }

            /**
             * Reverse the migrations.
             */
            public function down(): void
            {
                Schema::table('survey_answers', function (Blueprint $table) {
                    if (Schema::hasColumn('survey_answers', 'attendee_id')) {
                        $table->dropColumn('attendee_id');
                    }
                    if (Schema::hasColumn('survey_answers', 'postal_code')) {
                        $table->dropColumn('postal_code');
                    }
                });
            }
        };

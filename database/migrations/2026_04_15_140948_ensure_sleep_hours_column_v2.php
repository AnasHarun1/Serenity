<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('moods', 'sleep_hours')) {
            Schema::table('moods', function (Blueprint $table) {
                $table->decimal('sleep_hours', 4, 1)->nullable()->after('emoji_level');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('moods', 'sleep_hours')) {
            Schema::table('moods', function (Blueprint $table) {
                $table->dropColumn('sleep_hours');
            });
        }
    }
};

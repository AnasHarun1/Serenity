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
        Schema::table('users', function (Blueprint $table) {
            $table->string('chat_mode')->default('ai')->after('name');
        });

        Schema::table('chat_messages', function (Blueprint $table) {
            $table->string('sender_type')->nullable()->after('is_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('chat_mode');
        });

        Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropColumn('sender_type');
        });
    }
};

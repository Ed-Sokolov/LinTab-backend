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
            $table->string('nickname', 50)->unique();
            $table->string('avatar')->nullable();
            $table->string('about')->nullable();

            $table->string('name', 100)->nullable()->change();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nickname');
            $table->dropColumn('about');
            $table->dropColumn('avatar');

            $table->string('name')->change();

            $table->dropSoftDeletes();
        });
    }
};

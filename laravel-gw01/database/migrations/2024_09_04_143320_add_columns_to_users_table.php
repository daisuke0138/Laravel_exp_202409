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
        Schema::table('users', function (Blueprint $table) {
            $table->string('department')->nullable();
            $table->string('class')->nullable();
            $table->string('profile_image')->nullable();
            $table->integer('number')->nullable();
            $table->string('hobby')->nullable();
            $table->text('business_experience')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('department');
            $table->dropColumn('class');
            $table->dropColumn('profile_image');
            $table->dropColumn('number');
            $table->dropColumn('hobby');
            $table->dropColumn('business_experience');
        });
    }
};
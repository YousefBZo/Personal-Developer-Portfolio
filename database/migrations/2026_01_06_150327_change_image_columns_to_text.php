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
        // Change users.image to longText for Base64 storage
        Schema::table('users', function (Blueprint $table) {
            $table->longText('image')->nullable()->change();
        });

        // Change projects.image to longText for Base64 storage
        Schema::table('projects', function (Blueprint $table) {
            $table->longText('image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });
    }
};

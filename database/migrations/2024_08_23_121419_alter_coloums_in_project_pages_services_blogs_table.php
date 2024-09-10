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
        Schema::table('projects', function (Blueprint $table) {
            $table->longtext('translated_page_id')->nullable()->change();
        });
        Schema::table('services', function (Blueprint $table) {
            $table->longtext('translated_page_id')->nullable()->change();
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->longtext('translated_page_id')->nullable()->change();
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->longtext('translated_page_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};

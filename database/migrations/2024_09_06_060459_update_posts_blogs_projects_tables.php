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
            $table->string('parent_page_name')->nullable()->after('slug');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->string('parent_page_name')->nullable()->after('slug');
        });
        Schema::table('services', function (Blueprint $table) {
            $table->string('parent_page_name')->nullable()->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('parent_page_name');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('parent_page_name');
        });
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('parent_page_name');
        });
    }
};

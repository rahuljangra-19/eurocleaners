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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->constrained()->cascadeOnDelete();
            $table->string('page_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable(); 
            $table->text('meta_description')->nullable();
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->nullable();
            $table->json('components')->nullable();
            $table->boolean('is_menu')->default(false);
            $table->boolean('have_sub_menu')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};

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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->constrained()->cascadeOnDelete();
            $table->string('slug')->nullable();
            $table->bigInteger('translated_page_id')->nullable();
            $table->bigInteger('parent_page')->nullable();
            $table->text('title')->nullable();
            $table->longText('descriptions')->nullable();
            $table->json('author')->nullable();
            // $table->string('banner_image')->nullable();
            $table->string('feature_image')->nullable();
            $table->integer('sort_order')->nullable();
            $table->boolean('status')->default(false);
            $table->json('components')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id')->references('id')->on('articles')->onDelete('set null');
            $table->unsignedBigInteger('author_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('rating');
            $table->string('title');
            $table->longtext('text');
            $table->integer('agree_count')->default(0);
            $table->integer('disagree_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

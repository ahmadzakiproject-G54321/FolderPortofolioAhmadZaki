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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Informasi Project
            $table->string('title');
            $table->string('slug')->unique();

            // Thumbnail Project
            $table->string('thumbnail')->nullable();

            // Deskripsi Project
            $table->text('description');

            // Teknologi yang digunakan
            $table->string('technology')->nullable();

            // URL
            $table->string('github_url')->nullable();
            $table->string('demo_url')->nullable();

            // Project Unggulan
            $table->boolean('featured')->default(false);

            // Status Project
            $table->enum('status', ['Published', 'Draft'])->default('Published');

            // Urutan Tampil
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
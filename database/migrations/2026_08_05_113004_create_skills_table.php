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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();

            // Kategori Skill
            $table->string('category');

            // Nama Skill
            $table->string('skill_name');

            // Persentase Penguasaan (0 - 100)
            $table->unsignedTinyInteger('level')->default(0);

            // Icon (contoh: fa-brands fa-laravel)
            $table->string('icon')->nullable();

            // Urutan Tampil
            $table->unsignedInteger('sort_order')->default(0);

            // Status Tampil
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
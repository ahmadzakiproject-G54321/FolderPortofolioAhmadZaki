<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('education', function (Blueprint $table) {
            $table->string('education_level', 20)->default('Kuliah')->after('institution');
            $table->decimal('gpa', 5, 2)->nullable()->change();
        });

        // Data education yang sudah ada diasumsikan sebagai riwayat kuliah.
        // Nilai lama tidak diubah.
    }

    public function down(): void
    {
        Schema::table('education', function (Blueprint $table) {
            $table->dropColumn('education_level');
            $table->decimal('gpa', 3, 2)->nullable()->change();
        });
    }
};

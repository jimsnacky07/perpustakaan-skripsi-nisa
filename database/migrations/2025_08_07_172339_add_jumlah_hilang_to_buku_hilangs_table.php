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
        Schema::table('buku_hilangs', function (Blueprint $table) {
            $table->integer('jumlah_hilang')->default(1)->after('pengarang_buku');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buku_hilangs', function (Blueprint $table) {
            $table->dropColumn('jumlah_hilang');
        });
    }
};

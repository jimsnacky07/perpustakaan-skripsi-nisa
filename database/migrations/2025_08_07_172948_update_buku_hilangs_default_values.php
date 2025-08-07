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
            $table->string('penerbit_buku', 100)->nullable()->default('')->change();
            $table->string('pengarang_buku', 191)->nullable()->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buku_hilangs', function (Blueprint $table) {
            $table->string('penerbit_buku', 100)->nullable()->change();
            $table->string('pengarang_buku', 191)->nullable()->change();
        });
    }
};

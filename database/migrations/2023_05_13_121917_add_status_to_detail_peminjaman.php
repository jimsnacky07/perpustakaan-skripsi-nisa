<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_peminjaman', function (Blueprint $table) {
            $table->string('status')->nullable()->after('jumlah_buku');
            $table->string('id_buku_pinjam')->nullable()->after('id_peminjaman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_peminjaman', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('id_buku_pinjam');
        });
    }
};

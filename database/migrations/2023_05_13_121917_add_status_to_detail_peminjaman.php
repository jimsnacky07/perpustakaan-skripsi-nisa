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
            $table->unsignedBigInteger('id_buku_pinjam')->nullable()->after('id_peminjaman');
            $table->foreign('id_buku_pinjam')->references('id')->on('books')->onDelete('set null');
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
            $table->dropForeign(['id_buku_pinjam']);
            $table->dropColumn('id_buku_pinjam');
        });
    }
};

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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_buku_id');
            $table->string('judul_buku');
            $table->string('no_isbn');
            $table->string('tahun_terbit');
            $table->string('penerbit_buku');
            $table->string('pengarang_buku');
            $table->string('rak_buku_id');
            $table->string('jumlah_buku');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};

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
            $table->unsignedBigInteger('jenis_buku_id');
            $table->string('judul_buku');
            $table->string('no_isbn');
            $table->string('tahun_terbit');
            $table->string('penerbit_buku');
            $table->string('pengarang_buku');
            $table->unsignedBigInteger('rak_buku_id');
            $table->integer('jumlah_buku');
            $table->string('gambar');
            $table->timestamps();
            $table->foreign('jenis_buku_id')->references('id')->on('jenis_bukus')->onDelete('cascade');
            $table->foreign('rak_buku_id')->references('id')->on('rak_bukus')->onDelete('cascade');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('buku_hilangs', function (Blueprint $table) {
            $table->id();
            $table->string('judul_buku', 100);
            $table->string('penerbit_buku', 100)->nullable()->default('');
            $table->string('pengarang_buku', 191)->nullable()->default('');
            $table->date('tanggal_hilang')->nullable();
            $table->unsignedBigInteger('book_id')->nullable();
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('buku_hilangs');
    }
};

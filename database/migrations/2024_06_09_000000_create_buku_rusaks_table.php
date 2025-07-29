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
        Schema::create('buku_rusaks', function (Blueprint $table) {
            $table->id();
            $table->string('judulbuku', 100);
            $table->unsignedInteger('jumlahrusak')->nullable();
            $table->string('penyebab', 100)->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->unsignedBigInteger('book_id')->nullable();
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku_rusaks');
    }
};

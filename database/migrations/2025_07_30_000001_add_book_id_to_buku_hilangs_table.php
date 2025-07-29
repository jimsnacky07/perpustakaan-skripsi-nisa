<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('buku_hilangs', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id')->nullable()->after('tanggal_hilang');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('buku_hilangs', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropColumn('book_id');
        });
    }
};
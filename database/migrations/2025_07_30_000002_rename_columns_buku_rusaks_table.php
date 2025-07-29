<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('buku_rusaks', function (Blueprint $table) {
            $table->renameColumn('judulbuku', 'judul_buku');
            $table->renameColumn('jumlahrusak', 'jumlah_rusak');
        });
    }

    public function down()
    {
        Schema::table('buku_rusaks', function (Blueprint $table) {
            $table->renameColumn('judul_buku', 'judulbuku');
            $table->renameColumn('jumlah_rusak', 'jumlahrusak');
        });
    }
};
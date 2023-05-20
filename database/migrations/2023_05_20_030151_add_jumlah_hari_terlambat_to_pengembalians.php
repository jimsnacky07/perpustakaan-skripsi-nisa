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
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->string('jumlah_hari_terlambat')->after('tanggal_pengembalian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->dropColumn('jumlah_hari_terlambat');
        });
    }
};

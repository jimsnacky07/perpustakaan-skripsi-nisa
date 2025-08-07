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
        Schema::create('faktur', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_faktur')->unique();
            $table->enum('jenis_faktur', ['peminjaman', 'pengembalian', 'denda']);
            $table->unsignedBigInteger('id_transaksi')->nullable(); // ID peminjaman atau pengembalian
            $table->unsignedBigInteger('id_anggota');
            $table->text('detail_items'); // JSON untuk detail buku/denda
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->enum('status', ['dibayar', 'belum_dibayar'])->default('belum_dibayar');
            $table->date('tanggal_faktur');
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            $table->foreign('id_anggota')->references('id')->on('anggotas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faktur');
    }
};

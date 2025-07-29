<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanSeeder extends Seeder
{
    public function run()
    {
        DB::table('peminjaman')->insert([
            ["id" => 27, "kode_peminjaman" => "20240922060146722", "tgl_pinjam" => "2024-09-22", "tgl_kembali" => "2024-12-22", "id_anggota_peminjaman" => "29", "created_at" => null, "updated_at" => null],
            ["id" => 28, "kode_peminjaman" => "20240922063412668", "tgl_pinjam" => "2024-09-22", "tgl_kembali" => "2024-12-22", "id_anggota_peminjaman" => "30", "created_at" => null, "updated_at" => null],
            ["id" => 29, "kode_peminjaman" => "20240923063033342", "tgl_pinjam" => "2024-09-23", "tgl_kembali" => "2024-12-23", "id_anggota_peminjaman" => "31", "created_at" => null, "updated_at" => null],
            ["id" => 30, "kode_peminjaman" => "20240923063437431", "tgl_pinjam" => "2024-09-23", "tgl_kembali" => "2024-12-23", "id_anggota_peminjaman" => "29", "created_at" => null, "updated_at" => null]
        ]);
    }
}

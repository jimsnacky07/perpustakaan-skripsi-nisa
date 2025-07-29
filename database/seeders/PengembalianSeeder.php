<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengembalianSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengembalians')->insert([
            ["id" => 13, "id_anggota" => 30, "id_buku" => 43, "qty" => 1, "tanggal_pengembalian" => "2024-09-24", "jumlah_hari_terlambat" => 0, "denda" => 0, "created_at" => null, "updated_at" => null]
        ]);
    }
}

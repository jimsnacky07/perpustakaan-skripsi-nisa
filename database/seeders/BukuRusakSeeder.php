<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuRusakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buku_rusaks')->insert([
            [
                'judul_buku' => 'Buku Matematika',
                'jumlah_rusak' => 3,
                'penyebab' => 'Halaman sobek',
                'keterangan' => 'Rusak parah',
                'book_id' => 43,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_buku' => 'Buku IPA',
                'jumlah_rusak' => 1,
                'penyebab' => 'Kena air',
                'keterangan' => 'Sedikit rusak',
                'book_id' => 46,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuHilangSeeder extends Seeder
{
    public function run()
    {
        DB::table('buku_hilangs')->insert([
            [
                'judul_buku' => 'Buku Matematika',
                'penerbit_buku' => 'Erlangga',
                'pengarang_buku' => 'Budi Santoso',
                'tanggal_hilang' => '2024-06-01',
                'book_id' => 43,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul_buku' => 'Buku IPA',
                'penerbit_buku' => 'Gramedia',
                'pengarang_buku' => 'Siti Aminah',
                'tanggal_hilang' => '2024-06-05',
                'book_id' => 46,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

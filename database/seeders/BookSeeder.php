<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->insert([
            ["id" => 43, "jenis_buku_id" => 11, "judul_buku" => "SEJARAH", "no_isbn" => "978-602-453-048-85", "tahun_terbit" => "2019", "penerbit_buku" => "grasindo", "pengarang_buku" => "Adinul", "rak_buku_id" => 23, "jumlah_buku" => 49, "gambar" => "pcW4Zc0InoDgL8UFHJqNifcGvYOGBbcN5Svbn5GT.jpg", "created_at" => "2024-09-22 06:00:47", "updated_at" => "2024-09-22 06:00:47"],
            ["id" => 46, "jenis_buku_id" => 12, "judul_buku" => "kancil", "no_isbn" => "978-602-453-048-008", "tahun_terbit" => "2022", "penerbit_buku" => "atril", "pengarang_buku" => "fuzan", "rak_buku_id" => 24, "jumlah_buku" => 99, "gambar" => "GD65XwYPD0i2KxHL2VZbnmHv4PUdvkHauiEw1fiv.jpg", "created_at" => "2024-09-23 06:25:07", "updated_at" => "2024-09-23 06:25:07"]
        ]);
    }
}

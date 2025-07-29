<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotaSeeder extends Seeder
{
    public function run()
    {
        DB::table('anggotas')->insert([
            ["id" => 34, "nisn" => "2121", "nama" => "randu", "jk" => "P", "no_hp" => "0768745345", "alamat" => "iiut", "user_id" => 40, "created_at" => "2025-07-21 08:50:19", "updated_at" => "2025-07-21 08:50:19", "kelas" => "6"],
            ["id" => 35, "nisn" => "9090", "nama" => "caca", "jk" => "P", "no_hp" => "0823456775353", "alamat" => "pasaman", "user_id" => 41, "created_at" => "2025-07-21 10:45:50", "updated_at" => "2025-07-21 10:45:50", "kelas" => "8"],
            ["id" => 36, "nisn" => "3434", "nama" => "rafu hafid elvaco", "jk" => "L", "no_hp" => "0834234513", "alamat" => "pesisir", "user_id" => 42, "created_at" => "2025-07-21 15:11:59", "updated_at" => "2025-07-21 15:11:59", "kelas" => "8"],
            ["id" => 37, "nisn" => "4444", "nama" => "caca", "jk" => "P", "no_hp" => "234567876543", "alamat" => "dfvcx", "user_id" => 43, "created_at" => "2025-07-21 16:14:04", "updated_at" => "2025-07-21 16:14:04", "kelas" => "5"],
            ["id" => 38, "nisn" => "5656", "nama" => "mimi", "jk" => "P", "no_hp" => "08235422", "alamat" => "pasang", "user_id" => 44, "created_at" => "2025-07-21 16:22:24", "updated_at" => "2025-07-21 16:22:24", "kelas" => "9"],
            ["id" => 39, "nisn" => "343466", "nama" => "meme", "jk" => "P", "no_hp" => "08675433556", "alamat" => "padang", "user_id" => 45, "created_at" => "2025-07-21 16:35:58", "updated_at" => "2025-07-21 16:35:58", "kelas" => "8"],
            ["id" => 40, "nisn" => "89876", "nama" => "cici", "jk" => "P", "no_hp" => "08788888", "alamat" => "lubeg", "user_id" => 46, "created_at" => "2025-07-21 16:40:04", "updated_at" => "2025-07-21 16:40:04", "kelas" => "6"],
            ["id" => 41, "nisn" => "8888", "nama" => "kaka", "jk" => "L", "no_hp" => "091234543", "alamat" => "gor", "user_id" => 47, "created_at" => "2025-07-21 16:51:35", "updated_at" => "2025-07-21 16:51:35", "kelas" => "8"],
            ["id" => 42, "nisn" => "2121111", "nama" => "budi", "jk" => "P", "no_hp" => "08123456543", "alamat" => "gor", "user_id" => 49, "created_at" => "2025-07-21 17:08:16", "updated_at" => "2025-07-21 17:08:16", "kelas" => "9"],
            ["id" => 43, "nisn" => "3333", "nama" => "lulu", "jk" => "P", "no_hp" => "0867554567", "alamat" => "piai", "user_id" => 50, "created_at" => "2025-07-21 17:21:30", "updated_at" => "2025-07-21 17:21:30", "kelas" => "8"]
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AnggotaSeeder::class,
            JenisBukuSeeder::class,
            RakBukuSeeder::class,
            BookSeeder::class,
            PeminjamanSeeder::class,
            PeminjamanTempSeeder::class,
            PengembalianSeeder::class,
            BukuRusakSeeder::class,
            BukuHilangSeeder::class,
        ]);
    }
}

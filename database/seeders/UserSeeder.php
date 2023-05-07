<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Anggota',
                'email' => 'anggota@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 0,
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 1,
            ],
            [
                'name' => 'Pimpinan',
                'email' => 'pimpinan@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 2,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

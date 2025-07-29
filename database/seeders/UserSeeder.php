<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ["id" => 2, "name" => "Admin", "email" => "admin@gmail.com", "email_verified_at" => null, "password" => '$2y$10$I5m7r2qBg0znyQ7Cd74zQu2GU/hjTAV4FfcAKuQtnzCZtzlN89Zf2', "role" => 1, "remember_token" => null, "created_at" => "2023-05-07 14:00:22", "updated_at" => "2023-05-07 14:00:22"],
            ["id" => 38, "name" => "randu", "email" => "randu@gmail.com", "email_verified_at" => null, "password" => '$2y$10$yQozoJM.DTI1Omi17bLYS.UUdakkeiJ7Wx/OzBYDUsRi/P0w3lMku', "role" => 0, "remember_token" => null, "created_at" => "2025-07-21 08:25:44", "updated_at" => "2025-07-21 08:25:44"],
            ["id" => 40, "name" => "rara@gmail.com", "email" => "rara@gmail.com", "email_verified_at" => null, "password" => '$2y$10$kZHoC64gGy30FcNwP3i3juTPDnZwgs9GCjWsT9LsRDuKZp2fol64S', "role" => 0, "remember_token" => null, "created_at" => "2025-07-21 08:50:18", "updated_at" => "2025-07-21 08:50:18"],
            ["id" => 41, "name" => "kutir@gmail.com", "email" => "kutir@gmail.com", "email_verified_at" => null, "password" => '$2y$10$KsPu6kxyhefVpowIoAXrYu5J8WfqtVu1wB32EXOmL0qM2jAJDzuba', "role" => 0, "remember_token" => null, "created_at" => "2025-07-21 10:45:49", "updated_at" => "2025-07-21 10:45:49"],
            ["id" => 42, "name" => "rafu@gmail.com", "email" => "rafu@gmail.com", "email_verified_at" => null, "password" => '$2y$10$yNOiHkD6k0nC5H7xL8g7.OzOLqMLWbkhWwMNzQ7QB/YrrDO4YBwue', "role" => 0, "remember_token" => null, "created_at" => "2025-07-21 15:11:58", "updated_at" => "2025-07-21 15:11:58"],
            ["id" => 43, "name" => "caca@gmail.com", "email" => "caca@gmail.com", "email_verified_at" => null, "password" => '$2y$10$HgGyX9O4hCe8xUpm6oFbT.2yL8bzyaJcyyLDpKQALmA2Idnw8VQU.', "role" => 0, "remember_token" => null, "created_at" => "2025-07-21 16:14:03", "updated_at" => "2025-07-21 16:14:03"],
            ["id" => 44, "name" => "mimgmail.com", "email" => "mimi@gmail.com", "email_verified_at" => null, "password" => '$2y$10$MLzW2Zs2hXk1wQQFpvzZ8u7WRmVcn5ux6tzoqlERNTVTonwJIt23W', "role" => 0, "remember_token" => null, "created_at" => "2025-07-21 16:22:24", "updated_at" => "2025-07-21 16:22:24"],
            ["id" => 45, "name" => "meme@gmail.com", "email" => "meme@gmal.com", "email_verified_at" => null, "password" => '$2y$10$.9ztFH7xePI7b6REnJww6OrPe2ZgrTi9.JFne4QrfduKckyKktCi.', "role" => 0, "remember_token" => null, "created_at" => "2025-07-21 16:35:58", "updated_at" => "2025-07-21 16:35:58"],
            ["id" => 46, "name" => "cici@gmail.com", "email" => "cici@gmail.com", "email_verified_at" => null, "password" => '$2y$10$Wwp6Iez7HDuIFYXp8JxYNOM7tTPk4oaCzYam2eBBaCzpPefcliDXS', "role" => 0, "remember_token" => null, "created_at" => "2025-07-21 16:40:04", "updated_at" => "2025-07-21 16:40:04"],
            ["id" => 47, "name" => "kaka@gmail.com", "email" => "kaka@gmail.com", "email_verified_at" => null, "password" => '$2y$10$ByKHiz4KJZfyJakdmoCFB.GioGOClykMe5g0NLP4PyHTuEODDw2GK', "role" => 0, "remember_token" => null, "created_at" => "2025-07-21 16:51:35", "updated_at" => "2025-07-21 16:51:35"],
            ["id" => 49, "name" => "admin@gmail.com", "email" => "budi@gmail.com", "email_verified_at" => null, "password" => '$2y$10$y.ZDuIvOeHrU1lvuEmSi8uvYahdbOK5yinO0RQ0536RSyKPpBgvsS', "role" => 0, "remember_token" => null, "created_at" => "2025-07-21 17:08:16", "updated_at" => "2025-07-21 17:08:16"],
            ["id" => 50, "name" => "lulu@gmail.com", "email" => "lulu@gmail.com", "email_verified_at" => null, "password" => '$2y$10$ewJ5PibeY8Yjv/2oZOIKX.scvRef221jba1dKDByikZ5IinGVcChq', "role" => 0, "remember_token" => null, "created_at" => "2025-07-21 17:21:30", "updated_at" => "2025-07-21 17:21:30"]
        ]);
    }
}

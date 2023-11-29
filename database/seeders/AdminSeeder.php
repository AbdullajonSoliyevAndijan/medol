<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => '$2y$10$cDXqF/1UCAg5XExiuJy.B.7XYDJSpV2ekMlxgBiafqICeQPyKs1Ai', // 12345678
        ]);
    }
}

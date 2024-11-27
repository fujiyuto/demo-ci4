<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Database\Seeds\UserSeeder;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);
    }
}

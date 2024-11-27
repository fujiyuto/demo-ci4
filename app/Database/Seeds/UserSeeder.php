<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 5; $i++) {
            $data[] = [
                'user_name' => 'test_user'.$i,
                'email'     => 'test'.$i.'@gmail.com',
                'password'  => password_hash('password', PASSWORD_DEFAULT),
                'sex'       => $i < 2 ? UserModel::MEN : UserModel::WOMEN,
            ];
        }

        $db      = db_connect();
        $builder = $db->table('users');
        $builder->insertBatch($data);
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'user_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'comment'    => 'ユーザー名',
                'unique'     => true
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'comment'    => 'メールアドレス'
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'comment'    => 'パスワード'
            ],
            'sex' => [
                'type'       => 'ENUM',
                'constraint' => ['1', '2'],
                'comment'    => '性別（1:男性, 2:女性）'
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
        ]);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}

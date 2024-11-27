<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CiSessions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
                'comment' => 'ID'
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
                'comment' => 'IPアドレス',
            ],
            'timestamp' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
                'comment' => 'タイムスタンプ'
            ],
            'data' => [
                'type' => 'BLOB',
                'comment' => 'データ'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('timestamp', false, false, 'ci_sessions_timestamp');
        $this->forge->createTable('ci_sessions');
    }

    public function down()
    {
        $this->forge->dropTable('ci_sessions');
    }
}

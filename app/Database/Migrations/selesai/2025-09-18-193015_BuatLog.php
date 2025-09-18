<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatLog extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user'     => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'role'        => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'activity'    => [
                'type'       => 'TEXT',
            ],
            'ip_address'  => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'user_agent'  => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('activity_log');
    }

    public function down()
    {
        $this->forge->dropTable('activity_log');
    }
}

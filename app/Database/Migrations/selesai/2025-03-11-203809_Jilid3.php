<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jilid3 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_status'    => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true
            ]
        ]);
        $this->forge->addKey('id_status', true);
        $this->forge->createTable('status_surat');
    }

    public function down()
    {
        $this->forge->dropTable('status_surat');
    }
}

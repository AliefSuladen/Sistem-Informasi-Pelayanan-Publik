<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jilid2 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jabatan');
    }

    public function down()
    {
        $this->forge->dropTable('jabatan');
    }
}

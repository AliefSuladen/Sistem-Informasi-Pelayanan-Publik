<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pusingg extends Migration
{
    public function up()
    {
        // Tabel user
        $this->forge->addField([
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'nik' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
            ],
            'nama_user' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['masyarakat', 'admin_desa', 'admin_kecamatan'],
                'default' => 'masyarakat',
            ],
            'id_desa' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('user');

        // Tabel desa
        $this->forge->addField([
            'id_desa' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'nama_desa' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id_desa', true);
        $this->forge->createTable('desa');

        // Tabel jenis_surat
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'nama_jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jenis_surat');

        // Tabel permohonan_surat
        $this->forge->addField([
            'id_permohonan' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_jenis' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'id_status' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'file_surat' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_permohonan', true);
        $this->forge->createTable('permohonan_surat');

        // Tabel dokumen_pengajuan
        $this->forge->addField([
            'id_dokumen' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'id_permohonan' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'nama_dokumen' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_dokumen' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id_dokumen', true);
        $this->forge->createTable('dokumen_pengajuan');
    }

    public function down()
    {
        $this->forge->dropTable('user');
        $this->forge->dropTable('desa');
        $this->forge->dropTable('jenis_surat');
        $this->forge->dropTable('permohonan_surat');
        $this->forge->dropTable('dokumen_pengajuan');
    }
}

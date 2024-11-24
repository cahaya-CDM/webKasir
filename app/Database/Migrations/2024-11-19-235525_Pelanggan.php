<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelanggan'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                // 'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama'    => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                // 'null'       => false,
            ],
            'alamat'    => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                // 'null'       => false,
            ],
            'no_tlp'    =>  [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                // 'null'       => false,
            ],
            'created_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_pelanggan', true); // Primary key
        $this->forge->createTable('tb_pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pelanggan');
    }
}

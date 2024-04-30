<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tipos extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
			'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('tipos');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tipos');
    }
}

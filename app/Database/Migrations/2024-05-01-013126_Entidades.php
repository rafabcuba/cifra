<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Entidades extends Migration
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
            ],
            'municipio_id' => [
                'type'       => 'INT',
                'constraint' => '5',
                'unsigned' => true,
            ],
            'tipo_id' => [
                'type'       => 'INT',
                'constraint' => '5',
                'unsigned' => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('municipio_id', 'municipios', 'id');
        $this->forge->addForeignKey('tipo_id', 'tipos', 'id');
        $this->forge->createTable('entidades');
    }

    public function down()
    {
        //
        $this->forge->dropTable('entidades');
    }
}

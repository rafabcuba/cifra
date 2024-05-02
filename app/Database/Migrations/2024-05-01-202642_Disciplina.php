<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Disciplina extends Migration
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
            'fecha' => [
                'type'       => 'DATE',
            ],
            'entidad_id' => [
                'type'       => 'INT',
                'constraint' => '5',
                'unsigned' => true,
            ],
            'formulario_id' => [
                'type'       => 'INT',
                'constraint' => '5',
                'unsigned' => true,
            ],
            'indisciplina' => [
                'type'       => 'BOOLEAN',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('entidad_id', 'entidades', 'id');
        $this->forge->addForeignKey('formulario_id', 'formularios', 'id');
        $this->forge->createTable('disciplina');
    }

    public function down()
    {
        //
        $this->forge->dropTable('disciplina');
    }
}

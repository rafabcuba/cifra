<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Municipios extends Migration
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
            'created_at' => [
                'type'      =>  'DATETIME',
            ],
            'updated_at' => [
                'type'      =>  'DATETIME',
            ],
            'deleted_at' => [
                'type'      =>  'DATETIME',
            ],
		]);
		$this->forge->addKey('id', true);
        $this->forge->createTable('municipios');
    }

    public function down()
    {
        $this->forge->dropTable('municipios');
    }
}

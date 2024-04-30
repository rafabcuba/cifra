<?php

namespace App\Database\Seeds;

use App\Models\FormularioModel;
use CodeIgniter\Database\Seeder;

class FormularioSeeder extends Seeder
{
    public function run()
    {
        //
        $csvFile = fopen("data/formularios.csv", "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
				$object = new FormularioModel;
				$object->insert([
					"nombre" => $data['1'],
                    "descripcion" => $data['2'],
				]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}

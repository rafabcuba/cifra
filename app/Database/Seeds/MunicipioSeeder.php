<?php

namespace App\Database\Seeds;

use App\Models\MunicipioModel;
use CodeIgniter\Database\Seeder;

class MunicipioSeeder extends Seeder
{
    public function run()
    {
        //
        $csvFile = fopen("data/municipios.csv", "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
				$object = new MunicipioModel;
				$object->insert((object)[
					"nombre" => $data['1']
				]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}

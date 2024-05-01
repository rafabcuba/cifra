<?php

namespace App\Database\Seeds;

use App\Models\TipoModel;
use CodeIgniter\Database\Seeder;

class TipoSeeder extends Seeder
{
    public function run()
    {
        //
        $csvFile = fopen("data/tipos.csv", "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
				$object = new TipoModel;
				$object->insert((object)[
					"nombre" => $data['1']
				]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}

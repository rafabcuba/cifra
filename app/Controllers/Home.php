<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // $db = db_connect();
        // $sql = 'select * from municipio';
        // $query = $db->query($sql);
        // foreach ($query->getResult() as $row) {
        //     echo $row->id;
        //     echo $row->nombre;
        // }
        return view('welcome_message');
    }
}

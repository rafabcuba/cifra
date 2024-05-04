<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Controllers\Reportes;

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $loggedUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedUserId);
        $reportes = new Reportes();

        $headerData = [
            'title' => 'Dashboard',
            'userInfo' => $userInfo,
        ];

        $db = db_connect();
        $db->simpleQuery("SET lc_time_names = 'es_ES'");

        $disciplinas = $reportes->get_disciplina_query()->getResult('array');
        $calidad = $reportes->get_calidad_query()->getResult('array');
        $calidadxmes = $reportes->get_calidad_x_mes_query()->getResult('array');

        $municipios = array_column($disciplinas,'nombre');
        $entiempo = array_column($disciplinas,'entiempo');
        $indisciplinas = array_column($disciplinas,'indisciplinas');
        $totalci = array_column($disciplinas,'total');
        $entiempoc = array_column($calidad,'entiempo');
        $indisciplinasc = array_column($calidad,'indisciplinas');
        $meses = array_column($calidadxmes,'mes');
        $indisciplinasm = array_column($calidadxmes,'indisciplinas');
        
        $porcentajes = [];
        foreach ($entiempo as $clave => $valor) {
            $porcentaje = round(($valor / $totalci[$clave]) * 100,1);
            $porcentajes[] = $porcentaje;
        }

        $data = [
            'municipios' => json_encode($municipios, JSON_HEX_TAG),
            'entiempo' => json_encode($entiempo, JSON_HEX_TAG),
            'indisciplinas' => json_encode($indisciplinas, JSON_HEX_TAG),
            'totalci' => json_encode($totalci, JSON_HEX_TAG),
            'porcentajes' => json_encode($porcentajes, JSON_HEX_TAG),
            'entiempoc' => json_encode($entiempoc, JSON_HEX_TAG),
            'indisciplinasc' => json_encode($indisciplinasc, JSON_HEX_TAG),
            'meses' => json_encode($meses, JSON_HEX_TAG),
            'indisciplinasm' => json_encode($indisciplinasm, JSON_HEX_TAG),
        ];

        return view('header', $headerData)
            . view('menu')
            . view('dashboard/index', $data)
            . view('footer');
    }
}

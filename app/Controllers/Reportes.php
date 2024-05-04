<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel;
use App\Libraries\Hash;
use App\Models\MunicipioModel;
use App\Models\FormularioModel;

class Reportes extends BaseController
{
    protected $userModel,$userInfo,$municipioModel,$formularioModel;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->userModel = new UserModel();

        $loggedUserId = session()->get('loggedInUser');
        $this->userInfo = $this->userModel->find($loggedUserId);
        $this->municipioModel = new MunicipioModel();
        $this->formularioModel = new FormularioModel();
    }
    public function index()
    {
        //
    }

    public function get_disciplina_query($filter = null)
    {
        $db = db_connect();

        $condition = '';

        if ($filter == 'fecha') {
            $fecha_inicial = $this->request->getVar('fecha_inicial');
            $fecha_final = $this->request->getVar('fecha_final');
            $condition = 'WHERE d.fecha >= "'.$fecha_inicial.'" AND d.fecha <= "'.$fecha_final.'"';
        } else if ($filter == 'municipio') {
            $municipio_id = $this->request->getVar('municipio_id');
            $condition = 'WHERE m.id = '.$municipio_id;
        } else if ($filter == 'formulario') {
            $formulario_id = $this->request->getVar('formulario_id');
            $condition = 'WHERE f.id = '.$formulario_id;
        }

        $query = '
        SELECT
            m.nombre AS nombre,
            SUM( CASE WHEN d.indisciplina = FALSE THEN 1 ELSE 0 END ) AS entiempo,
            SUM( CASE WHEN d.indisciplina = TRUE THEN 1 ELSE 0 END ) AS indisciplinas,
            COUNT(*) AS total 
        FROM
            disciplina d
            INNER JOIN entidades e ON d.entidad_id = e.id
            INNER JOIN municipios m ON e.municipio_id = m.id
            INNER JOIN formularios f ON d.formulario_id = f.id '
            .$condition.
            ' 
        GROUP BY
            m.nombre
        ';

        $query= $db->query($query);

        return $query;
    }

    public function get_calidad_query($filter = null)
    {
        $db = db_connect();

        $condition = '';

        if ($filter == 'fecha') {
            $fecha_inicial = $this->request->getVar('fecha_inicial');
            $fecha_final = $this->request->getVar('fecha_final');
            $condition = 'WHERE d.fecha >= "'.$fecha_inicial.'" AND d.fecha <= "'.$fecha_final.'"';
        } else if ($filter == 'municipio') {
            $municipio_id = $this->request->getVar('municipio_id');
            $condition = 'WHERE m.id = '.$municipio_id;
        } else if ($filter == 'formulario') {
            $formulario_id = $this->request->getVar('formulario_id');
            $condition = 'WHERE f.id = '.$formulario_id;
        }

        $query = '
        SELECT
            SUM( CASE WHEN d.indisciplina = FALSE THEN 1 ELSE 0 END ) AS entiempo,
            SUM( CASE WHEN d.indisciplina = TRUE THEN 1 ELSE 0 END ) AS indisciplinas,
            COUNT(*) AS total 
        FROM
            disciplina d
            INNER JOIN entidades e ON d.entidad_id = e.id
            INNER JOIN municipios m ON e.municipio_id = m.id
            INNER JOIN formularios f ON d.formulario_id = f.id '
            .$condition
            ;

        $query= $db->query($query);

        return $query;
    }

    public function get_calidad_x_mes_query($filter = null)
    {
        $db = db_connect();

        $condition = '';

        if ($filter == 'fecha') {
            $fecha_inicial = $this->request->getVar('fecha_inicial');
            $fecha_final = $this->request->getVar('fecha_final');
            $condition = 'WHERE d.fecha >= "'.$fecha_inicial.'" AND d.fecha <= "'.$fecha_final.'"';
        } else if ($filter == 'municipio') {
            $municipio_id = $this->request->getVar('municipio_id');
            $condition = 'WHERE m.id = '.$municipio_id;
        } else if ($filter == 'formulario') {
            $formulario_id = $this->request->getVar('formulario_id');
            $condition = 'WHERE f.id = '.$formulario_id;
        }

        $query = "
        SELECT
            MONTHNAME(d.fecha) AS mes,
            SUM( CASE WHEN d.indisciplina = FALSE THEN 1 ELSE 0 END ) AS entiempo,
            SUM( CASE WHEN d.indisciplina = TRUE THEN 1 ELSE 0 END ) AS indisciplinas,
            COUNT(*) AS total 
        FROM
            disciplina d
            INNER JOIN entidades e ON d.entidad_id = e.id
            INNER JOIN municipios m ON e.municipio_id = m.id
            INNER JOIN formularios f ON d.formulario_id = f.id "
        .$condition."
        GROUP BY MONTHNAME(d.fecha)
        ORDER BY MONTHNAME(d.fecha) ASC
        "
        ;

        $query= $db->query($query);

        return $query;
    }

    public function disciplina($filter = null)
    {
        //
        $detalle = '';
        if ($filter == 'fecha') {
            $fecha_inicial = $this->request->getVar('fecha_inicial');
            $fecha_final = $this->request->getVar('fecha_final');
            $detalle = 'desde: '.$fecha_inicial.' hasta: '.$fecha_final;
            $title = 'Disciplina estadística por '.$filter.' ('.$detalle.')';
        } else if ($filter == 'municipio') {
            $municipio_id = $this->request->getVar('municipio_id');
            $detalle = $this->municipioModel->find($municipio_id)['nombre'];
            $title = 'Disciplina estadística por '.$filter.' ('.$detalle.')';
        } else if ($filter == 'formulario') {
            $formulario_id = $this->request->getVar('formulario_id');
            $detalle = $this->formularioModel->find($formulario_id)['nombre'];
            $title = 'Disciplina estadística por '.$filter.' ('.$detalle.')';
        } else {
            $title = 'Disciplina estadística';
        }

        $headerData = [
            'title' => $title,
            'userInfo' => $this->userInfo,
        ];

        $query = $this->get_disciplina_query($filter);

        $data['municipios'] = $query->getResult('array');

        return view('header', $headerData)
            . view('menu')
            . view('reportes/disciplina_estadistica', $data)
            . view('footer');
    }

    public function DisciplinaXFecha()
    {
        $headerData = [
            'title' => 'Escoger rango de fechas',
            'userInfo' => $this->userInfo,
            'action' => '/reportes/disciplina-x-fecha-action',
        ];

        return view('header', $headerData)
            . view('menu')
            . view('wizards/date_wizard')
            . view('footer');
    }

    public function DisciplinaXMunicipio()
    {
        $headerData = [
            'title' => 'Escoger municipio',
            'userInfo' => $this->userInfo,
            'action' => '/reportes/disciplina-x-municipio-action',
        ];

        $municipios = $this->municipioModel->orderBy('id', 'ASC')->findAll();

        $data = [
            'municipios' => $municipios,
        ];

        return view('header', $headerData)
            . view('menu')
            . view('wizards/municipio_wizard',$data)
            . view('footer');
    }

    public function DisciplinaXFormulario()
    {
        $headerData = [
            'title' => 'Escoger formulario',
            'userInfo' => $this->userInfo,
            'action' => '/reportes/disciplina-x-formulario-action',
        ];

        $formularios = $this->formularioModel->orderBy('id', 'ASC')->findAll();

        $data = [
            'formularios' => $formularios,
        ];

        return view('header', $headerData)
            . view('menu')
            . view('wizards/formulario_wizard',$data)
            . view('footer');
    }

    public function GraficasXFecha()
    {
        $headerData = [
            'title' => 'Escoger rango de fechas',
            'userInfo' => $this->userInfo,
            'action' => '/reportes/graficas-action/fecha',
        ];

        return view('header', $headerData)
            . view('menu')
            . view('wizards/date_wizard')
            . view('footer');
    }

    public function GraficasXMunicipio()
    {
        $headerData = [
            'title' => 'Escoger municipio',
            'userInfo' => $this->userInfo,
            'action' => '/reportes/graficas-action/municipio',
        ];

        $municipios = $this->municipioModel->orderBy('id', 'ASC')->findAll();

        $data = [
            'municipios' => $municipios,
        ];

        return view('header', $headerData)
            . view('menu')
            . view('wizards/municipio_wizard',$data)
            . view('footer');
    }

    public function GraficasXFormulario()
    {
        $headerData = [
            'title' => 'Escoger formulario',
            'userInfo' => $this->userInfo,
            'action' => '/reportes/graficas-action/formulario',
        ];

        $formularios = $this->formularioModel->orderBy('id', 'ASC')->findAll();

        $data = [
            'formularios' => $formularios,
        ];

        return view('header', $headerData)
            . view('menu')
            . view('wizards/formulario_wizard',$data)
            . view('footer');
    }

    public function graficas($filter = null)
    {
        $detalle = '';
        if ($filter == 'fecha') {
            $fecha_inicial = $this->request->getVar('fecha_inicial');
            $fecha_final = $this->request->getVar('fecha_final');
            $detalle = 'desde: '.$fecha_inicial.' hasta: '.$fecha_final;
            $title = 'Gráficas estadísticas por '.$filter.' ('.$detalle.')';
        } else if ($filter == 'municipio') {
            $municipio_id = $this->request->getVar('municipio_id');
            $detalle = $this->municipioModel->find($municipio_id)['nombre'];
            $title = 'Gráficas estadísticas por '.$filter.' ('.$detalle.')';
        } else if ($filter == 'formulario') {
            $formulario_id = $this->request->getVar('formulario_id');
            $detalle = $this->formularioModel->find($formulario_id)['nombre'];
            $title = 'Gráficas estadísticas por '.$filter.' ('.$detalle.')';
        } else {
            $title = 'Gráficas estadísticas generales';
        }

        $headerData = [
            'title' => $title,
            'userInfo' => $this->userInfo,
        ];

        $db = db_connect();
        $db->simpleQuery("SET lc_time_names = 'es_ES'");

        $disciplinas = $this->get_disciplina_query($filter)->getResult('array');
        $calidad = $this->get_calidad_query($filter)->getResult('array');
        $calidadxmes = $this->get_calidad_x_mes_query($filter)->getResult('array');

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

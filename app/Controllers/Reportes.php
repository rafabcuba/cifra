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

    public function disciplina($filter = null)
    {
        //
        $headerData = [
            'title' => 'Disciplina estadística',
            'userInfo' => $this->userInfo,
        ];

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
}

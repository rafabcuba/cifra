<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel;
use App\Libraries\Hash;

class Reportes extends BaseController
{
    protected $userModel,$userInfo;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->userModel = new UserModel();

        $loggedUserId = session()->get('loggedInUser');
        $this->userInfo = $this->userModel->find($loggedUserId);
    }
    public function index()
    {
        //
    }

    public function disciplina()
    {
        //
        $headerData = [
            'title' => 'Disciplina estadística',
            'userInfo' => $this->userInfo,
        ];

        $db = db_connect();
        // $query= $db->query('select * from disciplina');

        $query= $db->query('
            SELECT
                m.nombre AS nombre,
                SUM( CASE WHEN d.indisciplina = TRUE THEN 1 ELSE 0 END ) AS indisciplinas,
                COUNT(*) AS total 
            FROM
                disciplina d
                INNER JOIN entidades e ON d.entidad_id = e.id
                INNER JOIN municipios m ON e.municipio_id = m.id
                INNER JOIN formularios f ON d.formulario_id = f.id 
            GROUP BY
                m.nombre
        ');

        
        $data['municipios'] = $query->getResult('array');

        // var_dump($data);
        // die();

        return view('header', $headerData)
            . view('menu')
            . view('reportes/disciplina_estadistica', $data)
            . view('footer');
    }
}

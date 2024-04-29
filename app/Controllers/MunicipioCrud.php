<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MunicipioModel;
use App\Models\UserModel;

class MunicipioCrud extends BaseController
{
    public function index()
    {
        //
        $userModel = new UserModel();
        $municipioModel = new municipioModel();
        $loggedUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedUserId);

        $headerData = [
            'title' => 'Municipios',
            'userInfo' => $userInfo,
        ];

        $data['municipios'] = $municipioModel->orderBy('id', 'ASC')->findAll();

        return view('header', $headerData)
            . view('menu')
            . view('municipio/municipio_view', $data)
            . view('footer');
    }
}

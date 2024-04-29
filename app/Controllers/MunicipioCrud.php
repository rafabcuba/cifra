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

    public function create()
    {
        $userModel = new UserModel();
        $loggedUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedUserId);

        $headerData = [
            'title' => 'Usuarios',
            'userInfo' => $userInfo,
        ];

        return view('header', $headerData)
            . view('menu')
            . view('municipio/add_municipio')
            . view('footer');
    }

    public function store()
    {
        $municipioModel = new MunicipioModel();
        $data = [
            'nombre' => $this->request->getVar('name'),
        ];
    $municipioModel->insert($data);
    return $this->response->redirect(site_url('/municipios-list'));
    }

    public function edit($id = null)
    {
        $userModel = new UserModel();
        $loggedUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedUserId);

        $headerData = [
            'title' => 'Editar usuario',
            'userInfo' => $userInfo,
        ];

        $municipioModel = new MunicipioModel();

        $data['municipio_obj'] = $municipioModel->where('id',$id)->first();

        return view('header', $headerData)
            . view('menu')
            . view('municipio/edit_municipio',$data)
            . view('footer');
    }

    public function update()
    {
        $municipioModel = new MunicipioModel();
        $id = $this->request->getVar('id');
        $data = [
            'nombre' => $this->request->getVar('name'),
        ];

        $municipioModel->update($id,$data);
        return $this->response->redirect(site_url('/municipios-list'));
    }

    public function delete($id = null)
    {
        $municipioModel = new MunicipioModel();
        $data['municipio'] = $municipioModel->where('id',$id)->delete($id);
        return $this->response->redirect(site_url('/municipios-list'));
    }

}

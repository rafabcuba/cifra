<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TipoModel;
use App\Models\UserModel;

class TipoCrud extends BaseController
{
    public function index()
    {
        //
        $userModel = new UserModel();
        $tipoModel = new tipoModel();
        $loggedUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedUserId);

        $headerData = [
            'title' => 'Tipos',
            'userInfo' => $userInfo,
        ];

        $data['tipos'] = $tipoModel->orderBy('id', 'ASC')->findAll();

        return view('header', $headerData)
            . view('menu')
            . view('tipo/tipo_view', $data)
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
            . view('tipo/add_tipo')
            . view('footer');
    }

    public function store()
    {
        $tipoModel = new tipoModel();
        $data = [
            'nombre' => $this->request->getVar('name'),
        ];
    $tipoModel->insert($data);
    return $this->response->redirect(site_url('/tipos-list'));
    }

    public function edit($id = null)
    {
        $userModel = new UserModel();
        $loggedUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedUserId);

        $headerData = [
            'title' => 'Editar tipo',
            'userInfo' => $userInfo,
        ];

        $tipoModel = new tipoModel();

        $data['tipo_obj'] = $tipoModel->where('id',$id)->first();

        return view('header', $headerData)
            . view('menu')
            . view('tipo/edit_tipo',$data)
            . view('footer');
    }

    public function update()
    {
        $tipoModel = new tipoModel();
        $id = $this->request->getVar('id');
        $data = [
            'nombre' => $this->request->getVar('name'),
        ];

        $tipoModel->update($id,$data);
        return $this->response->redirect(site_url('/tipos-list'));
    }

    public function delete($id = null)
    {
        $tipoModel = new tipoModel();
        $data['tipo'] = $tipoModel->where('id',$id)->delete($id);
        return $this->response->redirect(site_url('/tipos-list'));
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\FormularioModel;

class FormularioCrud extends BaseController
{
    public function index()
    {
        //
        $userModel = new UserModel();
        $formularioModel = new formularioModel();
        $loggedUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedUserId);

        $headerData = [
            'title' => 'Tipos',
            'userInfo' => $userInfo,
        ];

        $data['formularios'] = $formularioModel->orderBy('id', 'ASC')->findAll();

        return view('header', $headerData)
            . view('menu')
            . view('formulario/formulario_view', $data)
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
            . view('formulario/add_formulario')
            . view('footer');
    }

    public function store()
    {
        $formularioModel = new formularioModel();
        $data = [
            'nombre' => $this->request->getVar('name'),
            'descripcion' => $this->request->getVar('descripcion'),
        ];
    $formularioModel->insert($data);
    return $this->response->redirect(site_url('/formularios-list'));
    }

    public function edit($id = null)
    {
        $userModel = new UserModel();
        $loggedUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedUserId);

        $headerData = [
            'title' => 'Editar formulario',
            'userInfo' => $userInfo,
        ];

        $formularioModel = new formularioModel();

        $data['formulario_obj'] = $formularioModel->where('id',$id)->first();

        return view('header', $headerData)
            . view('menu')
            . view('formulario/edit_formulario',$data)
            . view('footer');
    }

    public function update()
    {
        $formularioModel = new formularioModel();
        $id = $this->request->getVar('id');
        $data = [
            'nombre' => $this->request->getVar('name'),
            'descripcion' => $this->request->getVar('descripcion'),
        ];

        $formularioModel->update($id,$data);
        return $this->response->redirect(site_url('/formularios-list'));
    }

    public function delete($id = null)
    {
        $formularioModel = new formularioModel();
        $data['formulario'] = $formularioModel->where('id',$id)->delete($id);
        return $this->response->redirect(site_url('/formularios-list'));
    }
}

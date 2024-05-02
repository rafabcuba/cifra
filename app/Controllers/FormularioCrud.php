<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel;
use App\Models\FormularioModel;

class FormularioCrud extends BaseController
{
    protected $userModel,$formularioModel,$userInfo;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->userModel = new UserModel();
        $this->formularioModel = new FormularioModel();

        $loggedUserId = session()->get('loggedInUser');
        $this->userInfo = $this->userModel->find($loggedUserId);
    }

    public function index()
    {
        //
        $headerData = [
            'title' => 'Formularios',
            'userInfo' => $this->userInfo,
        ];

        $data['formularios'] = $this->formularioModel->orderBy('id', 'ASC')->findAll();

        return view('header', $headerData)
            . view('menu')
            . view('formulario/formulario_view', $data)
            . view('footer');
    }

    public function create()
    {
        $headerData = [
            'title' => 'Adicionar formulario',
            'userInfo' => $this->userInfo,
        ];

        return view('header', $headerData)
            . view('menu')
            . view('formulario/add_formulario')
            . view('footer');
    }

    public function store()
    {
        $data = (object)[
            'nombre' => $this->request->getVar('name'),
            'descripcion' => $this->request->getVar('descripcion'),
        ];
        $this->formularioModel->insert($data);
        return $this->response->redirect(site_url('/formularios-list'));
    }

    public function edit($id = null)
    {
        $headerData = [
            'title' => 'Editar formulario',
            'userInfo' => $this->userInfo,
        ];

        $data['formulario_obj'] = $this->formularioModel->where('id',$id)->first();

        return view('header', $headerData)
            . view('menu')
            . view('formulario/edit_formulario',$data)
            . view('footer');
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $data = (object)[
            'nombre' => $this->request->getVar('name'),
            'descripcion' => $this->request->getVar('descripcion'),
        ];

        $this->formularioModel->update($id,$data);
        return $this->response->redirect(site_url('/formularios-list'));
    }

    public function delete($id = null)
    {
        try {
            $deleted = true;
            $this->formularioModel->where('id',$id)->delete($id);
        }
        catch (\CodeIgniter\Database\Exceptions\DatabaseException $e){
            $deleted = false;
            log_message('error', 'Database error: ' . $e->getMessage());
            $data['error'] = 'No se ha podido eliminar el registro';
        }
        
        if ($deleted){
            return $this->response->redirect(site_url('/formularios-list'));
        }
        else {
            $headerData = [
                'title' => 'Editar municipio',
                'userInfo' => $this->userInfo,
            ];
            return view('header', $headerData)
            . view('menu')
            . view('errors/custom_error',$data)
            . view('footer');
        }
    }
}

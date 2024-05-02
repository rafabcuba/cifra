<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;
use App\Models\TipoModel;
use App\Models\UserModel;

class TipoCrud extends BaseController
{
    protected $userModel,$tipoModel,$userInfo;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->userModel = new UserModel();
        $this->tipoModel = new TipoModel();

        $loggedUserId = session()->get('loggedInUser');
        $this->userInfo = $this->userModel->find($loggedUserId);
    }

    public function index()
    {
        //
        $headerData = [
            'title' => 'Tipos',
            'userInfo' => $this->userInfo,
        ];

        $data['tipos'] = $this->tipoModel->orderBy('id', 'ASC')->findAll();

        return view('header', $headerData)
            . view('menu')
            . view('tipo/tipo_view', $data)
            . view('footer');
    }

    public function create()
    {

        $headerData = [
            'title' => 'Adicionar tipo',
            'userInfo' => $this->userInfo,
        ];

        return view('header', $headerData)
            . view('menu')
            . view('tipo/add_tipo')
            . view('footer');
    }

    public function store()
    {
        $data = (object)[
            'nombre' => $this->request->getVar('name'),
        ];
        $this->tipoModel->insert($data);
        return $this->response->redirect(site_url('/tipos-list'));
    }

    public function edit($id = null)
    {
        $headerData = [
            'title' => 'Editar tipo',
            'userInfo' => $this->userInfo,
        ];

        $data['tipo_obj'] = $this->tipoModel->where('id',$id)->first();

        return view('header', $headerData)
            . view('menu')
            . view('tipo/edit_tipo',$data)
            . view('footer');
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $data = (object)[
            'nombre' => $this->request->getVar('name'),
        ];

        $this->tipoModel->update($id,$data);
        return $this->response->redirect(site_url('/tipos-list'));
    }

    public function delete($id = null)
    {
        try {
            $deleted = true;
            $this->tipoModel->where('id',$id)->delete($id);
        }
        catch (\CodeIgniter\Database\Exceptions\DatabaseException $e){
            $deleted = false;
            log_message('error', 'Database error: ' . $e->getMessage());
            $data['error'] = 'No se ha podido eliminar el registro';
        }
        
        if ($deleted){
            return $this->response->redirect(site_url('/tipos-list'));
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

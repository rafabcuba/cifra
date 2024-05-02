<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;
use App\Models\EntidadModel;
use App\Models\MunicipioModel;
use App\Models\TipoModel;
use App\Models\UserModel;

class EntidadCrud extends BaseController
{
    protected $userModel,$entidadModel,$userInfo,$municipioModel,$tipoModel;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        helper(['related']);

        $this->userModel = new UserModel();
        $this->entidadModel = new EntidadModel();
        $this->municipioModel = new MunicipioModel();
        $this->tipoModel = new TipoModel();

        $loggedUserId = session()->get('loggedInUser');
        $this->userInfo = $this->userModel->find($loggedUserId);
    }

    public function index()
    {
        //
        $headerData = [
            'title' => 'Entidades',
            'userInfo' => $this->userInfo,
        ];

        $data = [
            'entidades' => $this->entidadModel->orderBy('id', 'ASC')->findAll(), 
        ];

        return view('header', $headerData)
            . view('menu')
            . view('entidad/entidad_view', $data)
            . view('footer');
    }

    public function create()
    {

        $headerData = [
            'title' => 'Crear entidad',
            'userInfo' => $this->userInfo,
        ];

        $municipios = $this->municipioModel->orderBy('id', 'ASC')->findAll();
        $tipos = $this->tipoModel->orderBy('id', 'ASC')->findAll();

        $data = [
            'municipios' => $municipios,
            'tipos' => $tipos
        ];

        return view('header', $headerData)
            . view('menu')
            . view('entidad/add_entidad',$data)
            . view('footer');
    }

    public function store()
    {
        $data = (object)[
            'nombre' => $this->request->getVar('name'),
            'municipio_id' => $this->request->getVar('municipio_id'),
            'tipo_id' => $this->request->getVar('tipo_id'),
        ];
        $this->entidadModel->insert($data);
        return $this->response->redirect(site_url('/entidades-list'));
    }

    public function edit($id = null)
    {
        $headerData = [
            'title' => 'Editar entidad',
            'userInfo' => $this->userInfo,
        ];

        $municipios = $this->municipioModel->orderBy('id', 'ASC')->findAll();
        $tipos = $this->tipoModel->orderBy('id', 'ASC')->findAll();

        $data = [
            'entidad_obj' => $this->entidadModel->where('id',$id)->first(),
            'municipios' => $municipios,
            'tipos' => $tipos
        ];

        return view('header', $headerData)
            . view('menu')
            . view('entidad/edit_entidad',$data)
            . view('footer');
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $data = (object)[
            'nombre' => $this->request->getVar('name'),
            'municipio_id' => $this->request->getVar('municipio_id'),
            'tipo_id' => $this->request->getVar('tipo_id'),
        ];

        $this->entidadModel->update($id,$data);
        return $this->response->redirect(site_url('/entidades-list'));
    }

    public function delete($id = null)
    {
        try {
            $deleted = true;
            $this->entidadModel->where('id',$id)->delete($id);
        }
        catch (\CodeIgniter\Database\Exceptions\DatabaseException $e){
            $deleted = false;
            log_message('error', 'Database error: ' . $e->getMessage());
            $data['error'] = 'No se ha podido eliminar el registro';
        }
        
        if ($deleted){
            return $this->response->redirect(site_url('/entidades-list'));
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

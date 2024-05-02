<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;
use App\Models\MunicipioModel;
use App\Models\UserModel;

class MunicipioCrud extends BaseController
{
    protected $userModel,$municipioModel,$userInfo;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->userModel = new UserModel();
        $this->municipioModel = new municipioModel();

        $loggedUserId = session()->get('loggedInUser');
        $this->userInfo = $this->userModel->find($loggedUserId);
    }

    public function index()
    {
        //
        $headerData = [
            'title' => 'Municipios',
            'userInfo' => $this->userInfo,
        ];

        $data['municipios'] = $this->municipioModel->orderBy('id', 'ASC')->findAll();

        return view('header', $headerData)
            . view('menu')
            . view('municipio/municipio_view', $data)
            . view('footer');
    }

    public function create()
    {
        $headerData = [
            'title' => 'Adicionar municipio',
            'userInfo' => $this->userInfo,
        ];

        return view('header', $headerData)
            . view('menu')
            . view('municipio/add_municipio')
            . view('footer');
    }

    public function store()
    {
        $data = (object)[
            'nombre' => $this->request->getVar('name'),
        ];
    $this->municipioModel->insert($data);
    return $this->response->redirect(site_url('/municipios-list'));
    }

    public function edit($id = null)
    {
        $headerData = [
            'title' => 'Editar municipio',
            'userInfo' => $this->userInfo,
        ];

        $data['municipio_obj'] = $this->municipioModel->where('id',$id)->first();

        return view('header', $headerData)
            . view('menu')
            . view('municipio/edit_municipio',$data)
            . view('footer');
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $data = (object)[
            'nombre' => $this->request->getVar('name'),
        ];

        $this->municipioModel->update($id,$data);
        return $this->response->redirect(site_url('/municipios-list'));
    }

    public function delete($id = null)
    {
        $data['municipio'] = $this->municipioModel->where('id',$id)->delete($id);
        return $this->response->redirect(site_url('/municipios-list'));
    }

}

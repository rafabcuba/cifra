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
use App\Models\FormularioModel;
use App\Models\DisciplinaModel;

class DisciplinaCrud extends BaseController
{
    protected $userModel,$entidadModel,$userInfo,$municipioModel,$tipoModel,$formularioModel,$disciplinaModel;

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
        $this->formularioModel = new FormularioModel();
        $this->disciplinaModel = new DisciplinaModel();

        $loggedUserId = session()->get('loggedInUser');
        $this->userInfo = $this->userModel->find($loggedUserId);
    }

    public function index()
    {
        //
        $headerData = [
            'title' => 'Disciplina estadística',
            'userInfo' => $this->userInfo,
        ];

        $data = [
            'disciplinas' => $this->disciplinaModel->orderBy('fecha', 'ASC')->findAll(), 
        ];

        return view('header', $headerData)
            . view('menu')
            . view('disciplina/disciplina_view', $data)
            . view('footer');
    }

    public function create()
    {

        $headerData = [
            'title' => 'Registrar disciplina',
            'userInfo' => $this->userInfo,
        ];

        $entidades = $this->entidadModel->orderBy('id', 'ASC')->findAll();
        $formularios = $this->formularioModel->orderBy('id', 'ASC')->findAll();

        $data = [
            'entidades' => $entidades,
            'formularios' => $formularios
        ];

        return view('header', $headerData)
            . view('menu')
            . view('disciplina/add_disciplina',$data)
            . view('footer');
    }

    public function store()
    {
        $data = (object)[
            'fecha' => $this->request->getVar('fecha'),
            'entidad_id' => $this->request->getVar('entidad_id'),
            'formulario_id' => $this->request->getVar('formulario_id'),
            'indisciplina' => $this->request->getVar('indisciplina') == 'indisciplina',
        ];
        $this->disciplinaModel->insert($data);
        return $this->response->redirect(site_url('/disciplinas-list'));
    }

    public function edit($id = null)
    {
        $headerData = [
            'title' => 'Editar disciplina',
            'userInfo' => $this->userInfo,
        ];

        $entidades = $this->entidadModel->orderBy('id', 'ASC')->findAll();
        $formularios = $this->formularioModel->orderBy('id', 'ASC')->findAll();

        $data = [
            'disciplina_obj' => $this->disciplinaModel->where('id',$id)->first(),
            'entidades' => $entidades,
            'formularios' => $formularios
        ];

        return view('header', $headerData)
            . view('menu')
            . view('disciplina/edit_disciplina',$data)
            . view('footer');
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $data = (object)[
            'fecha' => $this->request->getVar('fecha'),
            'entidad_id' => $this->request->getVar('entidad_id'),
            'formulario_id' => $this->request->getVar('formulario_id'),
            'indisciplina' => $this->request->getVar('indisciplina') == 'indisciplina',
        ];

        $this->disciplinaModel->update($id,$data);
        return $this->response->redirect(site_url('/disciplinas-list'));
    }

    public function delete($id = null)
    {
        $data['disciplina'] = $this->disciplinaModel->where('id',$id)->delete($id);
        return $this->response->redirect(site_url('/disciplinas-list'));
    }
}

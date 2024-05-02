<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RequestInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel;
use App\Libraries\Hash;

class UserCrud extends BaseController
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

        $headerData = [
            'title' => 'Usuarios',
            'userInfo' => $this->userInfo,
        ];

        $data['users'] = $this->userModel->orderBy('id', 'ASC')->findAll();

        return view('header', $headerData)
            . view('menu')
            . view('user/user_view', $data)
            . view('footer');
    }

    public function create()
    {
        $headerData = [
            'title' => 'Adicionar usuario',
            'userInfo' => $this->userInfo,
        ];

        return view('header', $headerData)
            . view('menu')
            . view('user/add_user')
            . view('footer');
    }

    public function store()
    {
        $data = (object)[
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => Hash::encrypt($this->request->getVar('password')),
            'admin' => $this->request->getVar('admin')=='admin'
        ];
    $this->userModel->insert($data);
    return $this->response->redirect(site_url('/users-list'));
    }

    public function edit($id = null)
    {
        $headerData = [
            'title' => 'Editar usuario',
            'userInfo' => $this->userInfo,
        ];

        $data['user_obj'] = $this->userModel->where('id',$id)->first();

        return view('header', $headerData)
            . view('menu')
            . view('user/edit_user',$data)
            . view('footer');
    }
    public function update()
    {
        $id = $this->request->getVar('id');
        $data = (object)[
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => Hash::encrypt($this->request->getVar('password')),
            'admin' => $this->request->getVar('admin')=='admin'
        ];
        $this->userModel->update($id,$data);
        return $this->response->redirect(site_url('/users-list'));
    }

    public function delete($id = null)
    {
        try {
            $deleted = true;
            $this->userModel->where('id',$id)->delete($id);
        }
        catch (\CodeIgniter\Database\Exceptions\DatabaseException $e){
            $deleted = false;
            log_message('error', 'Database error: ' . $e->getMessage());
            $data['error'] = 'No se ha podido eliminar el registro';
        }
        
        if ($deleted){
            return $this->response->redirect(site_url('/users-list'));
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

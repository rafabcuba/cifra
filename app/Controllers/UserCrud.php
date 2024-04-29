<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Libraries\Hash;

class UserCrud extends BaseController
{
    public function index()
    {
        //
        $userModel = new UserModel();
        $loggedUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedUserId);

        $headerData = [
            'title' => 'Usuarios',
            'userInfo' => $userInfo,
        ];

        $data['users'] = $userModel->orderBy('id', 'ASC')->findAll();

        return view('header', $headerData)
            . view('menu')
            . view('user/user_view', $data)
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
            . view('user/add_user')
            . view('footer');
    }

    public function store()
    {
        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => Hash::encrypt($this->request->getVar('password')),
            'admin' => $this->request->getVar('admin')=='admin'
        ];
    $userModel->insert($data);
    return $this->response->redirect(site_url('/users-list'));
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

        $data['user_obj'] = $userModel->where('id',$id)->first();

        return view('header', $headerData)
            . view('menu')
            . view('user/edit_user',$data)
            . view('footer');
    }
    public function update()
    {
        $userModel = new UserModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => Hash::encrypt($this->request->getVar('password')),
            'admin' => $this->request->getVar('admin')=='admin'
        ];
        $userModel->update($id,$data);
        return $this->response->redirect(site_url('/users-list'));
    }

    public function delete($id = null)
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->where('id',$id)->delete($id);
        return $this->response->redirect(site_url('/users-list'));
    }
}

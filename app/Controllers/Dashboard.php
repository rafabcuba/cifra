<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $loggedUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedUserId);

        $headerData = [
            'title' => 'Dashboard',
            'userInfo' => $userInfo,
        ];

        $data = [
            'userInfo' => $userInfo,
        ];

        // return view('dashboard/index', $data);

        return view('header', $headerData)
            . view('menu')
            . view('dashboard/index', $data)
            . view('footer');
    }
}

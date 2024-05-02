<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{

    //habilitando features
    public function __construct()
    {
        helper(['url','form']);

    }

    /**
     * vista de login
     */
    public function login()
    {
        return view('auth/login');
    }

    /**
     * vista de registro
     */
    public function register()
    {
        return view('auth/register');
    }

    /**
     * Salva en nuevo usuario al db
     */
    public function registerUser()
    {
        $validated = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nombre requerido',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Correo requerido',
                    'valid_email' => 'correo inválido',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Contraseña requerida',
                    'min_length' => '5 caracteres como mínimo',
                ]
            ],
            'passwordConf' => [
                'rules' => 'required|min_length[5]|matches[password]',
                'errors' => [
                    'required' => 'Contraseña requerida',
                    'min_length' => '5 caracteres como mínimo',
                    'matches' => 'no coincide',
                ]
            ],
        ]);

        if (!$validated)
        {
            return view('auth/register', ['validation' => $this->validator]); 
        }

        // acá salvamos el usuario al db

        $name=$this->request->getPost('name');
        $email=$this->request->getPost('email');
        $password=$this->request->getPost('password');
        $passwordConf=$this->request->getPost('passwordConf');

        $data = (object)[
            'name' => $name,
            'email' => $email,
            'password' => Hash::encrypt($password)
        ];

        $userModel = new UserModel();
        $query = $userModel->insert($data);

        if (!$query)
        {
            return redirect()->back()->with('fail', 'fallo al salvar usuario');
        }
        else
        {
            return redirect()->back()->with('success', 'registro exitoso');
        }
    }

    /**
     * Método de autenticación de usuario
     */
    public function loginUser()
    {
        // Validando usuario

        $validated = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Correo requerido',
                    'valid_email' => 'correo inválido',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Contraseña requerida',
                    'min_length' => '5 caracteres como mínimo',
                ]
            ],
        ]);

        if (!$validated)
        {
            return view('auth/login', ['validation' => $this->validator]); 
        }
        else
        {
            // Chequeo de los detalles de usuario en la BD
            $email=$this->request->getPost('email');
            $password=$this->request->getPost('password');

            $userModel = new UserModel();
            $userInfo = $userModel->where('email', $email)->first();

            $checkPassword = Hash::check($password,$userInfo['password']);

            if (!$checkPassword)
            {
                session()->setFlashdata('fail', 'usuario o contraseñna incorrecto');
                return redirect()->to('auth/login');
            }
            else
            {
                  // procesamos la info de usuario
                  $userId = $userInfo['id'];

                  session()->set('loggedInUser', $userId);

                  return redirect()->to('/');
            }

        }

    }

    /**
     * Desconectar usuario
     */
    public function logout()
    {
        if (session()->has('loggedInUser'))
        {
            session()->remove('loggedInUser');
        }
        return redirect()->to('auth/login?access=loggetout')->with('fail','usted se ha desconectado');
    }
}

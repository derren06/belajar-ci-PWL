<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Codeigniter\HTTP\RequestInterface;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        helper('form');
        $this->userModel = new UserModel();
    }
    public function login()
    {
        if ($this->request->getPost()) {
            $rules = [
    'username' => 'required|min_length[6]',
    'password' => 'required|min_length[7]|numeric',
];
    if ($this->validate($rules)) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $dataUser = $this->userModel ->where(['username' => $username])->first();

           

            if ($dataUser) {
	if (password_verify($password, $dataUser['password'])) {

                    // ✅ SESSION
                    session()->set([
                        'username' => $dataUser['username'],
                        'email' => $dataUser['email'],
                        'role' => $dataUser['role'],
                        'logged_in' => true,
                        'login_time' => date('Y-m-d H:i:s')
                    ]);

                    return redirect()->to('/profile');
                } else {
                    session()->setFlashdata('failed', 'Password Salah');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                return redirect()->back();
            }
        }  else {
    session()->setFlashdata('failed', $this->validator->listErrors());
    return redirect()->back();
} 
        }
        else{
         return view('v_login');
        }

    }   
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}

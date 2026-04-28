<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AuthController extends BaseController
{
    public function __construct()
    {
        helper('form');
    }
    public function login()
    {
        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            // data dummy
            $dataUser = [
                'username' => 'april',
                'password' => '202cb962ac59075b964b07152d234b70', // 123
                'email' => 'april@gmail.com',
                'role' => 'admin'
            ];

            if ($username == $dataUser['username']) {
                if (md5($password) == $dataUser['password']) {

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
        }

        return view('v_login');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}

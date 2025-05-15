<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
{
    // Selalu kirim $error, walaupun kosong
    return view('auth/login');
}

public function cekLogin()
{
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $userModel = new UserModel();
    $user = $userModel->where('email', $email)->first();

    if ($user && password_verify($password, $user['password'])) {
        session()->set('user', $user);

        // CEK ADA redirect_after_login
        $redirect = session('redirect_after_login');
        if ($redirect) {
            session()->remove('redirect_after_login'); // hapus setelah dipakai
            return redirect()->to($redirect);
        }

        // Kalau tidak ada, baru default
        if ($user['role'] === 'admin') {
            return redirect()->to('/alatberat');
        } else {
            return redirect()->to('/');
        }
    } else {
        return redirect()->to('/login')->with('error', 'Login tidak berhasil, cek email atau password.');
    }
}


public function register()
{
    return view('auth/register');
}

public function registerdata()
{
   
        $userModel = new UserModel();

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'user',
        ];

        if ($userModel->save($data)) {
            return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login.');
        } else {
            // Tambahkan ini biar kelihatan errornya
            return redirect()->back()->withInput()->with('error', implode(', ', $userModel->errors()));
        }
    

}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

}

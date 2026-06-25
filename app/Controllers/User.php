<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function login()
    {
        $data = [
            'title' => 'Login Admin',
        ];

        // Jika ada pengiriman data (tombol login diklik)
        if ($this->request->is('post')) {
            $model = new UserModel();
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            // Cari user berdasarkan kolom 'useremail' di database
            $user = $model->where('useremail', $email)->first();

            if ($user) {
                // Cek password (Sederhana sesuai modul praktikum)
                if ($password === $user['userpassword']) {
                    
                    // Set data session (Tanda pengenal login)
                    session()->set([
                        'user_id'   => $user['id'],
                        'username'  => $user['username'],
                        'useremail' => $user['useremail'],
                        'logged_in' => true,
                    ]);

                    // Berhasil login, arahkan ke dashboard admin
                    return redirect()->to('/admin/artikel');
                } else {
                    // Password salah
                    session()->setFlashdata('error', 'Password yang Anda masukkan salah.');
                    return redirect()->to('/user/login');
                }
            } else {
                // Email tidak ditemukan
                session()->setFlashdata('error', 'Email tidak terdaftar dalam sistem.');
                return redirect()->to('/user/login');
            }
        }

        // Tampilkan halaman form login (GET request)
        return view('user/login', $data);
    }

    /**
     * Fungsi untuk keluar dari sistem
     */
    public function logout()
    {
        // Menghapus seluruh data session
        session()->destroy();
        
        // Sesuai permintaan: arahkan kembali ke daftar artikel awal (Halaman Publik)
        return redirect()->to('/artikel');
    }
}
<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{
    use ResponseTrait;

    public function login()
    {
        // 1. Ambil payload JSON dari Axios
        $json = $this->request->getJSON();
        $usernameInput = trim($json->username ?? $this->request->getVar('username') ?? '');
        $passwordInput = trim($json->password ?? $this->request->getVar('password') ?? '');

        // Validasi input kosong
        if (empty($usernameInput) || empty($passwordInput)) {
            return $this->fail('Username dan Password wajib diisi.', 400);
        }

        // 2. Koneksi ke database
        $db = \Config\Database::connect();
        $builder = $db->table('user');

        // 3. Pencarian user
        $builder->groupStart()
                    ->where('useremail', $usernameInput)
                    ->orWhere('username', $usernameInput)
                ->groupEnd();
        
        $user = $builder->get()->getRowArray();

        // 4. Validasi kecocokan password
        if ($user && (password_verify($passwordInput, $user['userpassword']) || $passwordInput === trim($user['userpassword']))) {
            
            // Menggunakan respond() dari ResponseTrait, secara default sudah mengirimkan header Content-Type: application/json
            return $this->respond([
                'status'   => 200,
                'error'    => null,
                'messages' => 'Login Berhasil',
                'data'     => [
                    'id'       => $user['id'],
                    'username' => $user['username'],
                    'token'    => base64_encode("TOKEN-SECRET-" . $user['username'])
                ]
            ], 200);
        }

        // 5. Jika gagal
        return $this->failUnauthorized('Username atau Password salah.');
    }
}
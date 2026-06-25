<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ArtikelModel;

class AjaxController extends Controller
{
    /**
     * Menampilkan halaman utama untuk praktikum AJAX.
     * Fungsi ini merender view yang berisi tabel kosong dan skrip jQuery.
     */
    public function index()
    {
        $data = [
            'title' => 'Manajemen Artikel - AJAX Mode',
        ];
        return view('ajax/index', $data);
    }

    /**
     * Mengambil seluruh data artikel dari database.
     * Data dikirimkan dalam format JSON agar dapat diproses oleh fungsi $.ajax() di frontend.
     */
    public function getData()
    {
        $model = new ArtikelModel();
        $data = $model->findAll();

        // Mengirimkan data dalam format JSON sebagai respon
        return $this->response->setJSON($data);
    }

    /**
     * Menghapus data artikel berdasarkan ID secara asynchronous.
     * Setelah data dihapus, server akan mengirimkan status 'OK'.
     */
    public function delete($id)
    {
        $model = new ArtikelModel();
        
        // Melakukan proses hapus pada database berdasarkan primary key ($id)
        if ($model->delete($id)) {
            $data = [
                'status' => 'OK',
                'message' => 'Artikel berhasil dihapus tanpa reload halaman.'
            ];
        } else {
            $data = [
                'status' => 'ERROR',
                'message' => 'Gagal menghapus artikel.'
            ];
        }

        // Kirim respon balik ke JavaScript agar tabel bisa diperbarui secara real-time[cite: 1]
        return $this->response->setJSON($data);
    }
}
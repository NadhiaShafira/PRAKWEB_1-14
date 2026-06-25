<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ArtikelModel;

class Post extends ResourceController
{
    use ResponseTrait;

    // 1. GET /post (Menampilkan semua data artikel - Sinkron dengan VueJS)
    public function index()
    {
        $model = new ArtikelModel();
        // Mengambil semua data artikel diurutkan dari yang terbaru
        $data = $model->orderBy('id', 'DESC')->findAll();
        
        // Langsung mengembalikan array data murni agar mudah di-looping oleh v-for di VueJS
        return $this->respond($data, 200);
    }

    // 2. GET /post/{id} (Menampilkan detail satu artikel berdasarkan ID)
    public function show($id = null)
    {
        $model = new ArtikelModel();
        $data = $model->where('id', $id)->first();
        
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }

    // 3. POST /post (Menambahkan data artikel baru)
    public function create()
    {
        $model = new ArtikelModel();
        
        // Mengambil data dari request input body
        $data = [
            'judul' => $this->request->getVar('judul'),
            'isi'   => $this->request->getVar('isi'),
        ];
        
        // Validasi sederhana jika input kosong
        if (empty($data['judul']) || empty($data['isi'])) {
            return $this->failValidationErrors('Judul dan Isi artikel tidak boleh kosong.');
        }

        $model->insert($data);
        
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data artikel berhasil ditambahkan.'
            ]
        ];
        
        return $this->respondCreated($response);
    }

    // 4. PUT /post/{id} (Mengubah data artikel berdasarkan ID)
    public function update($id = null)
    {
        $model = new ArtikelModel();
        
        // Memastikan data yang mau diubah ada di database
        $cekData = $model->find($id);
        if (!$cekData) {
            return $this->failNotFound('Data tidak ditemukan.');
        }

        // Mengambil raw data input (PUT request)
        $data = [
            'judul' => $this->request->getRawInput()['judul'] ?? $cekData['judul'],
            'isi'   => $this->request->getRawInput()['isi'] ?? $cekData['isi'],
        ];

        $model->update($id, $data);
        
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data artikel berhasil diubah.'
            ]
        ];
        
        return $this->respond($response, 200);
    }

    // 5. DELETE /post/{id} (Menghapus data artikel berdasarkan ID)
    public function delete($id = null)
    {
        $model = new ArtikelModel();
        $data = $model->find($id);
        
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data artikel berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
}
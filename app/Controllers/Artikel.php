<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Artikel extends BaseController
{
    protected $artikelModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
        $this->kategoriModel = new KategoriModel();
    }

    // ==========================================
    // BAGIAN USER (HALAMAN DEPAN)
    // ==========================================

    public function index()
    {
        $q = $this->request->getVar('q') ?? '';

        $data = [
            'title'   => 'Daftar Artikel',
            'q'       => $q,
            'artikel' => $this->artikelModel->select('artikel.*, kategori.nama_kategori')
                            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
                            ->like('artikel.judul', $q)
                            ->paginate(6, 'artikel'), 
            'pager'   => $this->artikelModel->pager,
        ];

        return view('artikel/index', $data);
    }

    public function view($slug = null)
    {
        // 1. PENGAMAN UTAMA: Jika slug kosong atau bernilai index.php karena bug server local, kembalikan ke index
        if (empty($slug) || $slug === 'index.php') {
            return redirect()->to('/artikel');
        }

        // Bersihkan data parameter string
        $slug = trim(esc($slug));

        // 2. QUERY UTAMA: Cari artikel berdasarkan kolom slug data
        $artikel = $this->artikelModel->select('artikel.*, kategori.nama_kategori')
                                      ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
                                      ->where('artikel.slug', $slug)
                                      ->first();

        // 3. FALLBACK DETEKSI CADANGAN: Jika pencarian lewat slug gagal, coba cari berdasarkan ID Angka
        if (!$artikel) {
            $artikel = $this->artikelModel->select('artikel.*, kategori.nama_kategori')
                                          ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left')
                                          ->find($slug);
        }

        // Jika setelah dua metode di atas tetap tidak ada hasil di database, lempar Error 404 asli
        if (!$artikel) {
            throw PageNotFoundException::forPageNotFound("Artikel '" . $slug . "' tidak ditemukan di database.");
        }

        $data = [
            'title'   => $artikel['judul'],
            'artikel' => $artikel
        ];

        return view('artikel/view', $data);
    }

    // ==========================================
    // BAGIAN ADMIN - MODIFIKASI MODUL 9 (AJAX)
    // ==========================================

    public function admin_index()
    {
        $title = 'Halaman Admin - Artikel';
        
        // Ambil parameter dari request AJAX atau URL 
        $q = $this->request->getVar('q') ?? '';
        $kategori_id = $this->request->getVar('kategori_id') ?? '';
        $page = $this->request->getVar('page') ?? 1;

        // Query Builder 
        $builder = $this->artikelModel->table('artikel')
                        ->select('artikel.*, kategori.nama_kategori')
                        ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');

        // Logika Pencarian
        if ($q != '') {
            $builder->like('artikel.judul', $q);
        }

        // Logika Filter Kategori
        if ($kategori_id != '') {
            $builder->where('artikel.id_kategori', $kategori_id);
        }

        // Ambil data dengan pagination
        $artikel = $builder->paginate(10, 'artikel', $page);
        
        $data = [
            'title'       => $title,
            'q'           => $q,
            'kategori_id' => $kategori_id,
            'artikel'     => $artikel,
            'pager'       => $this->artikelModel->pager->makeLinks($page, 10, $this->artikelModel->countAllResults(false), 'default_full')
        ];

        // Cek jika request adalah AJAX
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($data);
        } else {
            // Jika bukan AJAX (pemuatan halaman biasa), ambil data kategori untuk dropdown
            $data['kategori'] = $this->kategoriModel->findAll();
            return view('admin/artikel_index', $data);
        }
    }

    // ==========================================
    // FUNGSI CRUD LAINNYA 
    // ==========================================

    public function add()
    {
        if ($this->request->is('post')) {
            $fileGambar = $this->request->getFile('gambar');
            $namaGambar = null;

            if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
                $namaGambar = $fileGambar->getRandomName();
                $fileGambar->move('uploads', $namaGambar);
            }

            $this->artikelModel->save([
                'judul'       => $this->request->getPost('judul'),
                'id_kategori' => $this->request->getPost('id_kategori'), 
                'isi'         => $this->request->getPost('isi'),
                'status'      => $this->request->getPost('status') ?? 1,
                'gambar'      => $namaGambar,
                'slug'        => url_title($this->request->getPost('judul'), '-', true)
            ]);

            session()->setFlashdata('pesan', 'Artikel berhasil diterbitkan!');
            return redirect()->to('/admin/artikel');
        }

        return view('admin/artikel_add', [
            'title'    => 'Tambah Artikel',
            'kategori' => $this->kategoriModel->findAll() 
        ]);
    }

    public function edit($id)
    {
        $artikelLama = $this->artikelModel->find($id);

        if (!$artikelLama) {
            throw PageNotFoundException::forPageNotFound("Data tidak ditemukan.");
        }

        if ($this->request->is('post')) {
            $fileGambar = $this->request->getFile('gambar');
            $namaGambar = $artikelLama['gambar'];

            if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
                $namaGambar = $fileGambar->getRandomName();
                $fileGambar->move('uploads', $namaGambar);

                if ($artikelLama['gambar'] && file_exists('uploads/' . $artikelLama['gambar'])) {
                    unlink('uploads/' . $artikelLama['gambar']);
                }
            }

            $this->artikelModel->update($id, [
                'judul'       => $this->request->getPost('judul'),
                'id_kategori' => $this->request->getPost('id_kategori'), 
                'isi'         => $this->request->getPost('isi'),
                'status'      => $this->request->getPost('status'),
                'gambar'      => $namaGambar,
                'slug'        => url_title($this->request->getPost('judul'), '-', true)
            ]);

            session()->setFlashdata('pesan', 'Artikel berhasil diperbarui!');
            return redirect()->to('/admin/artikel');
        }

        return view('admin/artikel_edit', [
            'title'    => 'Edit Artikel',
            'artikel'  => $artikelLama,
            'kategori' => $this->kategoriModel->findAll() 
        ]);
    }

    public function delete($id)
    {
        $artikel = $this->artikelModel->find($id);
        if ($artikel) {
            if ($artikel['gambar'] && file_exists('uploads/' . $artikel['gambar'])) {
                unlink('uploads/' . $artikel['gambar']);
            }
            $this->artikelModel->delete($id);
            session()->setFlashdata('pesan', 'Artikel telah dihapus.');
        }
        return redirect()->to('/admin/artikel');
    }
}
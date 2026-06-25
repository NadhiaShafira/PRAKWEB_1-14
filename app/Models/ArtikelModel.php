<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table      = 'artikel';
    protected $primaryKey = 'id';
    
    // id_kategori wajib ada agar relasi tersimpan
    protected $allowedFields = ['judul', 'isi', 'slug', 'status', 'gambar', 'id_kategori'];

    // Matikan ini karena kolomnya tidak ada di database (penyebab error Unknown Column)
    protected $useTimestamps = false;
}
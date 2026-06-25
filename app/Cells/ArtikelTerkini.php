<?php 

namespace App\Cells; 

use App\Models\ArtikelModel; 

/**
 * Tidak perlu lagi 'extends Cell' untuk menghindari 
 * error ArgumentCountError di CI 4.7.0
 */
class ArtikelTerkini 
{ 
    public function render(): string 
    { 
        $model = new ArtikelModel(); 
        
        // Ambil 5 artikel terbaru
        $artikel = $model->orderBy('id', 'DESC')->limit(5)->findAll(); 

        return view('components/artikel_terkini', [ 
            'artikel' => $artikel 
        ]); 
    } 
}
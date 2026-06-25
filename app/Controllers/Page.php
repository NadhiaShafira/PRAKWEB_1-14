<?php

namespace App\Controllers;

class Page extends BaseController
{
    /**
     * Menampilkan profil website dan visi misi
     */
    public function about()
    {
        $data = [
            'title'   => 'Tentang Portal Berita Fajar',
            'content' => 'Portal Berita Fajar adalah platform informasi digital yang didedikasikan untuk menyampaikan kabar terkini seputar dunia teknologi, pemrograman, dan aktivitas akademik di lingkungan Informatika Engineering. Kami berkomitmen untuk menyajikan konten yang edukatif, akurat, dan inspiratif bagi para mahasiswa dan pengembang web di Indonesia.'
        ];

        return view('about', $data);
    }

    /**
     * Menampilkan informasi kontak dan lokasi
     */
    public function contact()
    {
        $data = [
            'title'   => 'Hubungi Kami',
            'content' => 'Punya pertanyaan, saran, atau ingin bekerja sama? Kami sangat terbuka untuk mendengar suara Anda. Silakan hubungi tim redaksi kami melalui saluran resmi di bawah ini.'
        ];

        return view('contact', $data);
    }

    /**
     * Menampilkan pertanyaan yang sering diajukan
     */
    public function faqs()
    {
        $data = [
            'title'   => 'Frequently Asked Questions (FAQ)',
            'content' => 'Temukan jawaban cepat untuk pertanyaan-pertanyaan yang sering diajukan mengenai penggunaan portal ini, kontribusi artikel, dan kebijakan privasi kami.'
        ];

        return view('faqs', $data);
    }
}
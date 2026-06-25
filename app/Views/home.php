<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Banner Utama dengan Gradasi Pink Soft & Biru Muda Langit Pastel -->
<div style="background: linear-gradient(135deg, rgba(255, 183, 178, 0.9), rgba(199, 214, 255, 0.9)), url('https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=1000&q=80'); 
            background-size: cover; background-position: center; padding: 60px 20px; color: #4a4a4a; border-radius: 20px; margin-bottom: 30px; text-align: center; box-shadow: 0 8px 24px rgba(255, 183, 178, 0.15);">
    <h1 style="font-size: 36px; margin-bottom: 12px; font-weight: 700; color: #5d5b8d; text-shadow: 1px 1px 2px rgba(255,255,255,0.8);">
        Selamat Datang di Dunia Nadhia Shafir ✨🌸
    </h1>
    <p style="font-size: 16px; max-width: 800px; margin: 0 auto 25px; line-height: 1.6; color: #555;">
        Menyajikan informasi paling hangat, akurat, dan terpercaya seputar dunia Teknologi, Pemrograman, dan Berita Kampus setiap harinya. ☁️🎀
    </p>
    <a href="<?= base_url('/artikel'); ?>" style="display: inline-block; background: #ffffff; color: #ff9aa2; padding: 12px 28px; text-decoration: none; border-radius: 25px; font-weight: bold; box-shadow: 0 4px 10px rgba(0,0,0,0.05); transition: 0.3s;">
        Jelajahi Artikel 🎀 &rarr;
    </a>
</div>

<!-- Grid Kotak Fitur dengan Border Atas Warna Pastel -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <!-- Kotak 1: Pink Pastel -->
    <div style="background: #fff; padding: 20px; border-top: 5px solid #ffb7b2; box-shadow: 0 4px 15px rgba(255,183,178,0.1); border-radius: 12px;">
        <h3 style="margin-top: 0; color: #5d5b8d;">📰 Berita Terkini</h3>
        <p style="color: #666; font-size: 14px; line-height: 1.5;">Dapatkan update harian mengenai perkembangan teknologi web dan framework terbaru langsung dari sumbernya.</p>
    </div>
    <!-- Kotak 2: Biru Langit Pastel -->
    <div style="background: #fff; padding: 20px; border-top: 5px solid #c7d6ff; box-shadow: 0 4px 15px rgba(199,214,255,0.1); border-radius: 12px;">
        <h3 style="margin-top: 0; color: #5d5b8d;">💻 Tips & Tutorial</h3>
        <p style="color: #666; font-size: 14px; line-height: 1.5;">Tersedia berbagai panduan pemrograman PHP, JavaScript, hingga manajemen database untuk mengasah skill Anda.</p>
    </div>
    <!-- Kotak 3: Kuning Krim Pastel -->
    <div style="background: #fff; padding: 20px; border-top: 5px solid #e2f0cb; box-shadow: 0 4px 15px rgba(226,240,203,0.1); border-radius: 12px;">
        <h3 style="margin-top: 0; color: #5d5b8d;">🎓 Seputar Kampus</h3>
        <p style="color: #666; font-size: 14px; line-height: 1.5;">Informasi kegiatan akademik dan proyek mahasiswa Informatika Engineering untuk inspirasi belajar bersama.</p>
    </div>
</div>

<!-- Bagian Sapaan / Halaman Home Akhir -->
<div style="padding: 25px; border-left: 5px solid #ffb7b2; background-color: #fff5f6; margin-bottom: 30px; border-radius: 0 15px 15px 0; box-shadow: 0 4px 10px rgba(255,183,178,0.05);">
    <h2 style="margin-top: 0; color: #5d5b8d; display: flex; align-items: center; gap: 8px;">
        <span>🏠</span> <?= esc($title) ?>
    </h2>
    <p style="line-height: 1.8; color: #555; font-size: 15px;">
        Halo rekan-rekan pembaca! **Space Berita Nadhia Shafir** hadir sebagai media informasi yang berfokus pada kualitas konten dan kemudahan akses. Kami percaya bahwa informasi yang tepat adalah kunci kesuksesan di era digital ini. ✨
    </p>
    <p style="line-height: 1.8; color: #555; font-size: 15px;">
        Silakan jelajahi daftar artikel kami atau gunakan menu navigasi untuk melihat fitur-fitur lainnya. Jangan lupa untuk mengecek kolom **Artikel Terkini** di bagian samping untuk melihat berita terbaru yang baru saja diterbitkan. ☁️🌸
    </p>
</div>

<?= $this->endSection() ?>
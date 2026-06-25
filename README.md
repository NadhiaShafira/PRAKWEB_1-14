# 🌸 Space Berita Nadhia Shafira — Web Desain Project ✨

Selamat datang di repositori **Space Berita Nadhia Shafira**! Website ini merupakan platform media informasi modern bertema estetika *pastel pink-blue gradient* yang menyajikan berbagai artikel seputar dunia Teknologi, Pemrograman, dan Berita Kampus. Proyek website ini dikembangkan menggunakan framework **CodeIgniter 4** dan mendukung pengelolaan data dinamis berbasis **AJAX**.

---

## 🚀 Fitur Utama Website
* **Homepage Estetik:** Tampilan beranda minimalis dengan kombinasi warna pastel yang ramah di mata.
* **Autentikasi Admin:** Sistem login aman untuk masuk ke panel kendali (dashboard) admin.
* **Manajemen Artikel (CRUD):** Admin dapat menambah, melihat, mengubah, dan menghapus artikel.
* **AJAX Mode Integration:** Pengelolaan artikel secara *real-time* tanpa perlu memuat ulang (*refresh*) halaman.
* **Responsif & UI Modern:** Tata letak grid yang rapi yang memudahkan pembaca menjelajahi artikel.

---

## 📦 Teknologi yang Digunakan
* **Framework:** CodeIgniter 4 (PHP)
* **Database:** MySQL
* **Frontend:** HTML5, CSS3 (Custom Gradient Styles), JavaScript (AJAX)
* **Server Lokal:** XAMPP

---

## 📸 Dokumentasi Antarmuka (Screenshots)

Berikut adalah alur pengerjaan dan tampilan fitur dari website yang telah diselesaikan:

### 1. Halaman Utama (Beranda Pengunjung)
Tampilan awal website saat pertama kali diakses oleh pengguna.
![Halaman Utama](https://github.com/NadhiaShafira/PRAKWEB_1-14/blob/18afdc14eee475d9e52375a32eae2ab92f7a801b/SS_PRAK1-14/1_halaman_home.png)

### 2. Form Login Admin
Halaman gerbang masuk khusus bagi admin untuk mengelola konten web.
![Login Admin](https://github.com/NadhiaShafira/PRAKWEB_1-14/blob/a06297de864a25091dcce14d485db42bd3eb13ad/SS_PRAK1-14/2_halaman_login.png)

### 3. Dashboard Panel Admin
Halaman utama admin yang menampilkan tabel data artikel dalam mode AJAX.
![Dashboard Admin](https://github.com/NadhiaShafira/PRAKWEB_1-14/blob/ad922e05442dcdea44b32b504a529cbac6416f2d/SS_PRAK1-14/3_dashboard_admin.png)

### 4. Form Tambah Artikel Baru
Fasilitas bagi admin untuk menginput judul, kategori, gambar unggulan, serta konten berita.
![Tambah Artikel](4_tambah_artikel.png)

### 5. Notifikasi Artikel Berhasil Diterbitkan
Bukti validasi sistem saat artikel baru berhasil tersimpan ke dalam database.
![Artikel Sukses](5_artikel_berhasil_ditambah.png)

### 6. Eksplorasi Artikel Terbaru (Sisi User)
Tampilan kartu artikel baru yang dinamis di halaman depan pengunjung.
![Daftar Artikel User](6_halaman_daftar_artikel.png)

### 7. Manajemen Artikel Ter-update (AJAX Mode)
Tampilan tabel manajemen artikel admin yang otomatis memperbarui data lewat AJAX.
![Manajemen AJAX](7_halaman_ajax_mode.png)

### 8. Halaman Detail Konten Artikel
Halaman penuh saat pengunjung mengklik "Baca Selengkapnya" untuk membaca isi berita secara utuh.
![Detail Artikel](8_detail_artikel.png)

---

## 🛠️ Cara Menjalankan Proyek di Lokal
1. **Clone Repositori:**
```bash
   git clone [https://github.com/username-kamu/nama-repo-kamu.git](https://github.com/username-kamu/nama-repo-kamu.git)
```

2.**Nyalakan XAMPP:**
- Buka XAMPP Control Panel, lalu aktifkan modul Apache dan MySQL.
- Konfigurasi Database:
- Masuk ke localhost/phpmyadmin.
- Buat database baru dan import file .sql proyek ini.
- Sesuaikan pengaturan database di file .env.

3. **Jalankan Server:**
Buka terminal di VS Code, lalu ketik perintah:
```bash
php spark serve
```
Akses Website:
Buka browser dan ketik alamat ```http://localhost:8080```




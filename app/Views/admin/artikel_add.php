<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="content-admin">
    <h2 style="border-bottom: 3px solid #4285f4; padding-bottom: 10px; margin-bottom: 25px; color: #333;">
        Tambah Artikel Baru
    </h2>

    <div style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #eee;">
        <form action="<?= base_url('/admin/artikel/add'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #555;">Judul Artikel</label>
                <input type="text" name="judul" placeholder="Masukkan judul berita yang menarik..." 
                       style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;" required autofocus>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #555;">Kategori Artikel</label>
                <select name="id_kategori" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; background: #fff; font-size: 14px;" required>
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    <?php foreach($kategori as $k): ?>
                        <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #555;">Gambar Unggulan</label>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <input type="file" name="gambar" id="gambar" accept="image/*" 
                           style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; background: #f9f9f9; font-size: 14px;"
                           onchange="previewImage()">
                    <small style="color: #888;">Format: JPG, JPEG, PNG, atau WEBP (Maksimal 2MB)</small>
                    <img class="img-preview" style="max-width: 200px; border-radius: 5px; display: none; margin-top: 10px; border: 1px solid #eee;">
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #555;">Konten Berita</label>
                <textarea name="isi" rows="12" placeholder="Tuliskan isi berita di sini..." 
                          style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; font-family: sans-serif; line-height: 1.6;" required></textarea>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #555;">Status</label>
                <select name="status" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; background: #fff; font-size: 14px;">
                    <option value="1">Published (Terbitkan)</option>
                    <option value="0">Draft (Simpan Sementara)</option>
                </select>
            </div>

            <div style="display: flex; align-items: center; gap: 15px; border-top: 1px solid #eee; padding-top: 20px;">
                <button type="submit" 
                        style="background-color: #4285f4; color: white; padding: 12px 25px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; transition: 0.3s; font-size: 14px;">
                    🚀 Terbitkan Sekarang
                </button>
                <a href="<?= base_url('/admin/artikel'); ?>" 
                   style="text-decoration: none; color: #666; font-size: 14px; font-weight: 500;">Batal & Kembali</a>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#gambar');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

<?= $this->endSection(); ?>
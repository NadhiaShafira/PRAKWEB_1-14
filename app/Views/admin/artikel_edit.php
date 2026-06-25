<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="content-admin">
    <h2 style="margin-top: 0; border-bottom: 2px solid #4285f4; padding-bottom: 10px;">Ubah Artikel</h2>
    
    <div style="background: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <form action="" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Judul Artikel</label>
                <input type="text" name="judul" value="<?= $artikel['judul']; ?>" 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Kategori Artikel</label>
                <select name="id_kategori" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" required>
                    <?php foreach($kategori as $k): ?>
                        <option value="<?= $k['id_kategori']; ?>" <?= ($artikel['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                            <?= $k['nama_kategori']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Isi Artikel</label>
                <textarea name="isi" rows="10" 
                          style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-family: sans-serif;" required><?= $artikel['isi']; ?></textarea>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px;">Status</label>
                <select name="status" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="1" <?= $artikel['status'] == 1 ? 'selected' : ''; ?>>Published</option>
                    <option value="0" <?= $artikel['status'] == 0 ? 'selected' : ''; ?>>Draft</option>
                </select>
            </div>

            <div style="margin-top: 20px;">
                <button type="submit" class="btn-submit" 
                        style="background-color: #4285f4; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
                    Simpan Perubahan
                </button>
                <a href="<?= base_url('/admin/artikel'); ?>" 
                   style="margin-left: 10px; text-decoration: none; color: #666; font-size: 14px;">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
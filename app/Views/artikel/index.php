<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="artikel-container">
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #4285f4; padding-bottom: 10px; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
        <h2 style="margin: 0; color: #333;">Eksplorasi Artikel Terbaru</h2>

        <form action="<?= site_url('artikel'); ?>" method="get" style="display: flex; gap: 5px;">
            <input type="text" name="q" value="<?= esc($q ?? ''); ?>" placeholder="Cari artikel..." 
                   style="padding: 8px 15px; border: 1px solid #ddd; border-radius: 20px; font-size: 14px; width: 200px; outline: none;">
            <button type="submit" style="background: #4285f4; color: white; border: none; padding: 8px 15px; border-radius: 20px; cursor: pointer; font-weight: bold; font-size: 14px;">
                Cari
            </button>
        </form>
    </div>

    <?php if(!empty($q)): ?>
        <p style="margin-bottom: 20px; color: #666; font-size: 14px;">
            Menampilkan hasil untuk: <strong>"<?= esc($q); ?>"</strong> 
            <a href="<?= site_url('artikel'); ?>" style="color: #dc3545; text-decoration: none; margin-left: 10px;">&times; Hapus Pencarian</a>
        </p>
    <?php endif; ?>

    <?php if(session()->getFlashdata('pesan')): ?>
        <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 8px; border: 1px solid #c3e6cb;">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <?php if($artikel): ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px;">
            <?php foreach($artikel as $row): ?>
                <article style="background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #eee; display: flex; flex-direction: column; transition: transform 0.3s ease;">
                    
                    <div style="width: 100%; height: 180px; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #adb5bd; overflow: hidden;">
                        <?php if(!empty($row['gambar'])): ?>
                            <img src="<?= base_url('uploads/' . $row['gambar']); ?>" alt="<?= $row['judul']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <span style="font-size: 50px;">📰</span>
                        <?php endif; ?>
                    </div>

                    <div style="padding: 20px; flex-grow: 1;">
                        <div style="margin-bottom: 10px;">
                            <span style="background: #e8f0fe; color: #1967d2; font-size: 11px; font-weight: bold; padding: 3px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                                📁 <?= $row['nama_kategori'] ?? 'Umum'; ?>
                            </span>
                        </div>

                        <h3 style="margin: 0 0 10px 0; font-size: 18px; line-height: 1.4; height: 50px; overflow: hidden;">
                            <a href="<?= site_url('artikel/' . $row['slug']); ?>" style="text-decoration: none; color: #333; transition: 0.2s;">
                                <?= $row['judul']; ?>
                            </a>
                        </h3>
                        <p style="color: #666; font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                            <?= substr(strip_tags($row['isi']), 0, 100); ?>...
                        </p>
                    </div>

                    <div style="padding: 15px 20px; background: #f8f9fa; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 12px; color: #999;">👤 Admin</span>
                        <a href="<?= site_url('artikel/' . $row['slug']); ?>" style="color: #4285f4; font-weight: bold; text-decoration: none; font-size: 14px;">
                            Baca Selengkapnya &raquo;
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 50px; background: #f9f9f9; border-radius: 8px;">
            <h3>Data tidak ditemukan.</h3>
            <p>Silakan coba kata kunci lain atau kembali ke daftar utama.</p>
        </div>
    <?php endif; ?>
</div>

<?php if (isset($pager)): ?>
    <div style="margin-top: 40px; text-align: center;" class="pagination-container">
        <?= $pager->only(['q'])->links('artikel', 'default_full'); ?>
    </div>
<?php endif; ?>

<?= $this->endSection(); ?>
<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #eee;">
    <h2 style="border-bottom: 2px solid #4285f4; padding-bottom: 10px;"><?= $title; ?></h2>
    <p style="margin: 20px 0; color: #666;"><?= $content; ?></p>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div style="padding: 15px; background: #f9f9f9; border-radius: 5px;">
            <h4 style="margin-top: 0;">📍 Alamat</h4>
            <p style="font-size: 14px;">Bekasi Regency, West Java, Indonesia</p>
        </div>
        <div style="padding: 15px; background: #f9f9f9; border-radius: 5px;">
            <h4 style="margin-top: 0;">📧 Email & Sosmed</h4>
            <p style="font-size: 14px;">admin@fajar.com<br>Instagram: @jarzzz27_</p>
        </div>
    </div>

    <form style="margin-top: 30px;">
        <input type="text" placeholder="Nama Anda" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px;">
        <textarea placeholder="Pesan Anda" rows="5" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
        <button type="button" style="background: #4285f4; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Kirim Pesan</button>
    </form>
</div>
<?= $this->endSection(); ?>
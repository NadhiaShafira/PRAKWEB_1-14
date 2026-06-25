<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div style="max-width: 400px; margin: 40px auto; padding: 30px; background: #fff; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 1px solid #eee;">
    
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="color: #333; margin-bottom: 10px; font-size: 24px;">Sign In Admin</h2>
        <p style="color: #777; font-size: 14px;">Gunakan akun terdaftar untuk masuk ke panel kontrol.</p>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div style="background-color: #fff5f5; color: #c53030; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; border: 1px solid #feb2b2; text-align: center;">
            <strong>Gagal!</strong> <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('/user/login'); ?>" method="post">
        <?= csrf_field(); ?>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #555; font-size: 14px;">Alamat Email</label>
            <input type="email" name="email" placeholder="contoh@email.com" 
                   style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; outline: none; transition: 0.3s; font-size: 14px;" 
                   required autofocus>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; margin-bottom: 8px; font-weight: bold; color: #555; font-size: 14px;">Password</label>
            <input type="password" name="password" placeholder="Masukkan password" 
                   style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; outline: none; transition: 0.3s; font-size: 14px;" 
                   required>
        </div>

        <button type="submit" 
                style="width: 100%; padding: 14px; background-color: #4285f4; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 6px rgba(66, 133, 244, 0.2);">
            Login ke Dashboard
        </button>
    </form>

    <div style="text-align: center; margin-top: 25px; padding-top: 20px; border-top: 1px solid #eee;">
        <a href="<?= base_url('/'); ?>" style="color: #4285f4; text-decoration: none; font-size: 13px; font-weight: 500;">&larr; Kembali ke Beranda</a>
    </div>
</div>
<?= $this->endSection(); ?>
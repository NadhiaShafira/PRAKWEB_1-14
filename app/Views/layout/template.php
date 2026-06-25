<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        /* CSS Sederhana agar sama dengan screenshot awal kamu */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f4f4; }
        header { background: #4285f4; color: white; padding: 20px; }
        nav { background: #333; color: white; padding: 10px; }
        nav a { color: white; margin-right: 15px; text-decoration: none; font-size: 14px; }
        .container { display: flex; max-width: 1000px; margin: 20px auto; background: white; min-height: 80vh; }
        main { flex: 3; padding: 20px; border-right: 1px solid #ddd; }
        aside { flex: 1; padding: 20px; background: #fafafa; font-size: 13px; }
        h1 { color: #333; }
    </style>
</head>
<body>

<header>
    <h1>Layout Sederhana</h1>
</header>

<nav>
    <a href="<?= base_url('/'); ?>">Home</a>
    <a href="<?= base_url('artikel'); ?>">Artikel</a>
    <a href="<?= base_url('about'); ?>">About</a>
    <a href="<?= base_url('contact'); ?>">Kontak</a>
</nav>

<div class="container">
    <main>
        <?= $this->renderSection('content'); ?>
    </main>

    <aside>
        <h3>Artikel Terkini</h3>
        <?= view_cell('App\Cells\ArtikelTerkini::render') ?>
    </aside>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> | Nadhia Shafir Space</title>
    
    <!-- Google Fonts & Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Main Style -->
    <link rel="stylesheet" href="<?= base_url('style.css');?>">
    
    <style>
        :root {
            /* Tema warna: Pink Soft & Biru Muda Langit */
            --primary: #ffb7b2;
            --primary-dark: #ff9aa2;
            --sky-blue: #b5ead7;
            --dark: #4a4a4a;
            --light: #ffffff;
            --gray: #fff0f5; /* Background pink super soft */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--gray);
            margin: 0;
            color: #555;
        }

        /* Animasi Mengambang Lucu untuk Teks & Emoji */
        @keyframes floatCute {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-6px) rotate(3deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

        .animated-cute {
            display: inline-block;
            animation: floatCute 3s ease-in-out infinite;
        }

        /* Animasi khusus text shadow bercahaya lembut */
        @keyframes glowText {
            0% { text-shadow: 0 0 5px rgba(255,255,255,0.5); }
            50% { text-shadow: 0 0 15px rgba(255,255,255,0.9), 0 0 20px #ffb7b2; }
            100% { text-shadow: 0 0 5px rgba(255,255,255,0.5); }
        }

        /* Glassmorphism Header dengan Gradasi Pink Soft & Biru Langit */
        header {
            background: linear-gradient(135deg, rgba(255, 183, 178, 0.85), rgba(199, 214, 255, 0.85));
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            color: #4a4a4a;
            padding: 25px 5%;
            box-shadow: 0 4px 20px rgba(255, 183, 178, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 2px solid rgba(255, 255, 255, 0.5);
        }

        .header-title {
            margin: 0; 
            font-weight: 700; 
            letter-spacing: -0.5px; 
            color: #5d5b8d;
            animation: glowText 4s ease-in-out infinite;
        }

        nav {
            background: linear-gradient(90deg, #ffb7b2, #e2f0cb);
            padding: 0 5%;
            display: flex;
            align-items: center;
            height: 50px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        nav a {
            color: #5d5b8d;
            text-decoration: none;
            padding: 0 15px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.3s;
            line-height: 50px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        nav a:hover {
            background: rgba(255, 255, 255, 0.4);
            color: #ff6b6b;
            border-radius: 20px;
            height: 35px;
            line-height: 35px;
            align-self: center;
        }

        #container {
            max-width: 1200px;
            margin: 30px auto;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(255,183,178,0.15);
            border: 1px solid rgba(255, 255, 255, 0.7);
        }

        #wrapper {
            display: flex;
            gap: 30px;
            padding: 30px;
        }

        #main {
            flex: 3;
            min-height: 500px;
        }

        /* Modern Sidebar */
        #sidebar {
            flex: 1;
            background: #fff;
            padding: 20px;
            border-left: 1px solid #ffe5ec;
            border-radius: 15px;
        }

        .sidebar-title {
            font-weight: 700;
            color: #5d5b8d;
            border-bottom: 3px dashed var(--primary);
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        footer {
            background: linear-gradient(0deg, #ffe5ec, #ffffff);
            color: #777;
            padding: 40px 20px;
            text-align: center;
            font-size: 13px;
            border-top: 1px solid #ffe5ec;
        }

        /* Button Modern */
        .btn-modern {
            background: linear-gradient(135deg, #ffb7b2, #ff9aa2);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(255,154,162,0.3);
            transition: 0.3s;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255,154,162,0.5);
        }
    </style>
</head>
<body>

    <header>
        <div style="display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: auto;">
            <!-- Nama diganti Nadhia Shafir + Sentuhan Animasi Bergerak di Teks & Emoji -->
            <h1 class="header-title">
                <span class="animated-cute">🌸</span> Nadhia <span style="color: #ff8b94;">Shafir</span> <span class="animated-cute" style="animation-delay: 0.5s;">✨</span>
            </h1>
            <div class="user-status">
                <?php if (session()->get('logged_in')): ?>
                    <span style="font-size: 13px; color: #5d5b8d;">Welcome back, <strong>Admin Kelinci 🐰</strong></span>
                <?php endif; ?>
            </div>
        </div>
    </header>
    
    <nav>
        <a href="<?= base_url('/'); ?>"><i class="fas fa-home"></i> Home 🏠</a>
        <a href="<?= base_url('/artikel'); ?>"><i class="fas fa-newspaper"></i> Artikel 📝</a>
        <a href="<?= base_url('/ajax'); ?>"><i class="fas fa-bolt"></i> AJAX ⚡</a>
        <a href="<?= base_url('/about'); ?>">About 👑</a>
        
        <div style="margin-left: auto; display: flex; align-items: center;">
            <?php if (session()->get('logged_in')): ?>
                <a href="<?= base_url('/admin/artikel'); ?>" style="color: #ff6b6b;">Dashboard 💎</a>
                <a href="<?= base_url('/user/logout'); ?>" style="color: #ff4d4d;"><i class="fas fa-sign-out-alt"></i> Logout</a>
            <?php else: ?>
                <a href="<?= base_url('/user/login'); ?>"><i class="fas fa-user-lock"></i> Login Admin 🔒</a>
            <?php endif; ?>
        </div>
    </nav>

    <div id="container">
        <section id="wrapper">
            <main id="main">
                <?= $this->renderSection('content'); ?>
            </main>

            <aside id="sidebar">
                <div class="sidebar-title">🎀 ARTIKEL TERBARU 🎀</div>
                <?= view_cell('App\Cells\ArtikelTerkini::render'); ?>
            </aside>
        </section>

        <footer>
            <p>&copy; 2026 Space Berita Nadhia Shafir - Universitas Pelita Bangsa ☁️</p>
            <p style="font-size: 11px; opacity: 0.7;">Nadhia Shafir | Web Design Project ✨</p>
        </footer>
    </div>

    <!-- Pustaka jQuery Lokal -->
    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js'); ?>"></script>
    
    <!-- Script tambahan per halaman -->
    <?= $this->renderSection('scripts'); ?>
</body>
</html>
const Home = {
    template: `
    <div class="home-container">
        <h2>Selamat Datang di Portal Admin Artikel</h2>
        <p>Gunakan menu navigasi di atas untuk mengelola data artikel secara real-time memanfaatkan RESTful API CodeIgniter 4 dan VueJS 3.</p>
    </div>
    `
};

// Daftarkan komponen ke lingkup window global agar dibaca oleh Vue Router di app.js
window.Home = Home;
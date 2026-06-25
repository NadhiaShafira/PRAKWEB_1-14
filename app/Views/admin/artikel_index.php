<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="content-admin" style="padding: 20px;">
    <h2 style="margin-top: 0; border-bottom: 2px solid #4285f4; padding-bottom: 10px; color: #333;">Daftar Artikel (AJAX Mode)</h2>
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 15px; flex-wrap: wrap;">
        <form id="search-form" style="display: flex; gap: 10px; align-items: center;">
            <input type="text" name="q" id="search-box" value="<?= $q; ?>" placeholder="Cari judul artikel..." 
                   style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; width: 200px;">
            
            <select name="kategori_id" id="category-filter" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; background: white;">
                <option value="">Semua Kategori</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" style="background-color: #4285f4; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; font-weight: bold;">
                <i class="fas fa-search"></i> Cari
            </button>
        </form>

        <a href="<?= base_url('/admin/artikel/add'); ?>" 
           style="background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 14px;">
            + Tambah Artikel
        </a>
    </div>

    <?php if(session()->getFlashdata('pesan')): ?>
        <div id="flash-message" style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 4px; border: 1px solid #c3e6cb; margin-bottom: 20px; font-size: 14px;">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <div id="article-container" style="background-color: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #eee;">
        <div style="text-align: center; padding: 50px;">
            <i class="fas fa-spinner fa-spin fa-3x" style="color: #4285f4; margin-bottom: 15px;"></i>
            <p style="color: #666;">Menghubungkan ke server...</p>
        </div>
    </div>

    <div id="pagination-container" style="margin-top: 30px; display: flex; justify-content: center;"></div>
</div>

<style>
    /* Styling Pagination AJAX */
    #pagination-container ul { display: flex; list-style: none; padding: 0; gap: 5px; }
    #pagination-container li a, #pagination-container li span { 
        padding: 8px 14px; border: 1px solid #ddd; color: #4285f4; text-decoration: none; border-radius: 4px; cursor: pointer;
    }
    #pagination-container li.active span { background-color: #4285f4; color: white; border-color: #4285f4; }
    #pagination-container li a:hover { background-color: #f1f3f4; }
</style>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
$(document).ready(function() {
    const articleContainer = $('#article-container');
    const paginationContainer = $('#pagination-container');
    const searchForm = $('#search-form');

    // 1. Fungsi Utama Ambil Data (Fetch)
    const fetchData = (url) => {
        // Tampilkan Indikator Loading (Tugas Modul 9 No. 3)
        articleContainer.css('opacity', '0.5');
        
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers: {'X-Requested-With': 'XMLHttpRequest'}, 
            success: function(data) {
                articleContainer.css('opacity', '1');
                renderArticles(data.artikel);
                renderPagination(data.pager);
            },
            error: function() {
                articleContainer.html('<div style="padding:40px; text-align:center; color:red;">Gagal memuat data. Periksa koneksi atau controller Anda.</div>');
            }
        });
    };

    // 2. Fungsi Render Tabel
    const renderArticles = (articles) => {
        let html = `<table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8f9fa; color: #333; text-align: left; border-bottom: 2px solid #eee;">
                    <th width="50" style="text-align: center; padding: 15px;">ID</th>
                    <th style="padding: 15px;">Judul Artikel</th>
                    <th width="100" style="text-align: center; padding: 15px;">Status</th>
                    <th width="150" style="text-align: center; padding: 15px;">Aksi</th>
                </tr>
            </thead>
            <tbody>`;

        if (articles.length > 0) {
            articles.forEach(row => {
                let statusColor = row.status == 1 ? '#2e7d32' : '#ef6c00';
                let statusBg = row.status == 1 ? '#e8f5e9' : '#fff3e0';
                let isiSingkat = row.isi.replace(/(<([^>]+)>)/gi, "").substring(0, 80);

                html += `<tr style="border-bottom: 1px solid #eee;">
                    <td style="text-align: center; color: #666; padding: 12px;">${row.id}</td>
                    <td style="padding: 12px;">
                        <div style="font-weight: bold; color: #333; margin-bottom: 4px;">${row.judul}</div>
                        <div style="font-size: 11px; color: #888;">Kategori: ${row.nama_kategori || 'Umum'} | ${isiSingkat}...</div>
                    </td>
                    <td style="text-align: center;">
                        <span style="padding: 4px 10px; border-radius: 20px; font-size: 10px; font-weight: bold; 
                                     background-color: ${statusBg}; color: ${statusColor}; border: 1px solid currentColor;">
                            ${row.status == 1 ? 'PUBLISHED' : 'DRAFT'}
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 10px;">
                            <a href="<?= base_url('admin/artikel/edit'); ?>/${row.id}" style="color: #4285f4; text-decoration: none; font-size: 13px; font-weight: bold;">Ubah</a>
                            <span style="color: #ddd;">|</span>
                            <a onclick="return confirm('Yakin hapus?')" href="<?= base_url('admin/artikel/delete'); ?>/${row.id}" style="color: #dc3545; text-decoration: none; font-size: 13px; font-weight: bold;">Hapus</a>
                        </div>
                    </td>
                </tr>`;
            });
        } else {
            html += '<tr><td colspan="4" style="text-align:center; padding:50px; color:#999;">Tidak ada data ditemukan.</td></tr>';
        }
        html += '</tbody></table>';
        articleContainer.html(html);
    };

    // 3. Fungsi Render Pagination
    const renderPagination = (pagerHtml) => {
        paginationContainer.html(pagerHtml);
        
        // Intercept klik link pagination agar tidak reload halaman
        $('#pagination-container a').on('click', function(e) {
            e.preventDefault();
            fetchData($(this).attr('href'));
        });
    };

    // 4. Event Handler Pencarian
    searchForm.on('submit', function(e) {
        e.preventDefault();
        const q = $('#search-box').val();
        const kategori_id = $('#category-filter').val();
        fetchData(`<?= base_url('admin/artikel'); ?>?q=${q}&kategori_id=${kategori_id}`);
    });

    // 5. Jalankan pertama kali saat halaman dibuka
    fetchData('<?= base_url('admin/artikel'); ?>');
});
</script>
<?= $this->endSection(); ?>
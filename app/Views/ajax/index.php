<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div style="padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0; color: var(--dark);">Manajemen Artikel <span style="font-size: 14px; font-weight: normal; color: var(--primary); background: #eef4ff; padding: 4px 10px; border-radius: 20px; margin-left: 10px;">AJAX Mode</span></h2>
        <button onclick="location.reload()" class="btn-modern" style="background: #34a853; border: none; cursor: pointer;">
            <i class="fas fa-sync-alt"></i> Refresh
        </button>
    </div>

    <table class="table-data" id="artikelTable" style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden;">
        <thead>
            <tr style="background: var(--gray); text-align: left;">
                <th style="padding: 15px; border-bottom: 2px solid #eee;">ID</th>
                <th style="padding: 15px; border-bottom: 2px solid #eee;">Judul Berita</th>
                <th style="padding: 15px; border-bottom: 2px solid #eee;">Status</th>
                <th style="padding: 15px; border-bottom: 2px solid #eee; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Area ini akan diisi secara otomatis oleh JavaScript[cite: 1] -->
            <tr>
                <td colspan="4" style="text-align: center; padding: 50px; color: #888;">
                    <i class="fas fa-spinner fa-spin" style="font-size: 24px; margin-bottom: 10px;"></i><br>
                    Menghubungkan ke server...
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function() {
        // Panggil fungsi muat data saat halaman pertama kali dibuka
        loadData();

        function loadData() {
            $.ajax({
                url: "<?= base_url('ajax/getData') ?>",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    var tableBody = "";
                    
                    if (data.length === 0) {
                        tableBody = '<tr><td colspan="4" style="text-align: center; padding: 30px;">Belum ada artikel yang tersedia.</td></tr>';
                    } else {
                        $.each(data, function(index, row) {
                            tableBody += '<tr style="border-bottom: 1px solid #eee; transition: 0.2s;" onmouseover="this.style.background=\'#fdfdfd\'" onmouseout="this.style.background=\'transparent\'">';
                            tableBody += '<td style="padding: 15px;">' + row.id + '</td>';
                            tableBody += '<td style="padding: 15px; font-weight: 600;">' + row.judul + '</td>';
                            tableBody += '<td style="padding: 15px;"><span style="background: #e6f4ea; color: #1e8e3e; padding: 4px 12px; border-radius: 15px; font-size: 12px; font-weight: 600;">Published</span></td>';
                            tableBody += '<td style="padding: 15px; text-align: center;">';
                            tableBody += '<a href="<?= base_url('admin/artikel/edit/') ?>' + row.id + '" class="btn-modern" style="padding: 5px 12px; font-size: 12px; margin-right: 5px; background: #4285f4;"><i class="fas fa-edit"></i></a>';
                            tableBody += '<button class="btn-modern btn-delete" data-id="' + row.id + '" style="padding: 5px 12px; font-size: 12px; background: #ea4335; border: none; cursor: pointer;"><i class="fas fa-trash-alt"></i></button>';
                            tableBody += '</td>';
                            tableBody += '</tr>';
                        });
                    }
                    // Masukkan baris yang telah dibuat ke dalam tabel tanpa reload
                    $('#artikelTable tbody').html(tableBody);
                },
                error: function() {
                    $('#artikelTable tbody').html('<tr><td colspan="4" style="text-align: center; padding: 30px; color: #ea4335;">Gagal memuat data dari server.</td></tr>');
                }
            });
        }

        // Handle Klik Tombol Delete via AJAX
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            
            if (confirm('Apakah Anda yakin ingin menghapus artikel ID ' + id + ' ini?')) {
                $.ajax({
                    url: "<?= base_url('ajax/delete/') ?>" + id,
                    method: "DELETE",
                    success: function(response) {
                        if (response.status === 'OK') {
                            // Refresh data tabel saja tanpa reload seluruh halaman[cite: 1]
                            loadData(); 
                        } else {
                            alert('Gagal menghapus: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan pada server saat mencoba menghapus data.');
                    }
                });
            }
        });
    });
</script>
<?= $this->endSection(); ?>
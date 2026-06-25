const Artikel = {
    template: `
    <div>
        <h2>Manajemen Data Artikel</h2>
        <button class="btn btn-primary" style="background-color: #28a745; margin-bottom: 15px;" @click="tambah">+ Tambah Data</button>
        
        <div class="modal" :class="{ 'modal-show': showForm }">
            <div class="modal-content">
                <span class="close" @click="showForm = false">&times;</span>
                <form @submit.prevent="saveData">
                    <h3>{{ formTitle }}</h3>
                    <div class="form-group">
                        <label>Judul Artikel</label>
                        <input type="text" v-model="formData.judul" placeholder="Judul Artikel" required>
                    </div>
                    <div class="form-group">
                        <label>Isi Artikel</label>
                        <textarea v-model="formData.isi" rows="5" placeholder="Isi Artikel" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select v-model="formData.status" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                            <option v-for="option in statusOptions" :key="option.value" :value="option.value">
                                {{ option.text }}
                            </option>
                        </select>
                    </div>
                    <input type="hidden" v-model="formData.id">
                    <div style="text-align: right; gap: 10px; display: flex; justify-content: flex-end; margin-top: 15px;">
                        <button type="button" @click="showForm = false" class="btn" style="background-color: #bbb; color: white;">Batal</button>
                        <button type="submit" class="btn" style="background-color: #4285f4; color: white;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th width="50">ID</th>
                    <th>Judul</th>
                    <th width="100">Status</th>
                    <th width="150" style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(row, index) in artikel" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td style="font-weight: bold; color: #4285f4;">{{ row.judul }}</td>
                    <td><span :style="{color: parseInt(row.status) === 1 ? 'green' : 'orange'}">{{ statusText(row.status) }}</span></td>
                    <td style="text-align: center;">
                        <button @click="edit(row)" class="btn" style="background-color: #ffc107; color: black; padding: 5px 10px; font-size: 12px; margin-right: 5px;">Edit</button>
                        <button @click="hapus(index, row.id)" class="btn btn-danger">Hapus</button>
                    </td>
                </tr>
                <tr v-if="artikel.length === 0">
                    <td colspan="4" style="text-align: center; color: #999; padding: 40px;">Tidak ada data artikel tersedia.</td>
                </tr>
            </tbody>
        </table>
    </div>
    `,
    data() {
        return {
            artikel: [],
            formData: { id: null, judul: '', isi: '', status: 0 },
            showForm: false,
            formTitle: 'Tambah Data',
            statusOptions: [
                { text: 'Draft', value: 0 },
                { text: 'Publish', value: 1 }
            ]
        }
    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData() {
            axios.get(apiUrl + '/post')
                .then(response => {
                    // Penyesuaian mapping payload format RESTful API CodeIgniter 4
                    this.artikel = response.data.artikel || response.data;
                })
                .catch(error => console.error("Gagal memuat data dari API:", error));
        },
        tambah() {
            this.showForm = true;
            this.formTitle = 'Tambah Data';
            this.formData = { id: null, judul: '', isi: '', status: 0 };
        },
        edit(data) {
            this.showForm = true;
            this.formTitle = 'Ubah Data';
            this.formData = { 
                id: data.id, 
                judul: data.judul, 
                isi: data.isi, 
                status: parseInt(data.status) 
            };
        },
        hapus(index, id) {
            if (confirm('Apakah Anda yakin ingin menghapus data artikel ini?')) {
                // Konfigurasi HTTP Method Spoofing POST rasa DELETE untuk melewati batasan CORS backend
                const params = new URLSearchParams();
                params.append('_method', 'DELETE');

                axios.post(apiUrl + '/post/' + id, params, {
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                })
                .then(response => {
                    alert('Data artikel berhasil dihapus!');
                    this.loadData();
                })
                .catch(error => {
                    console.error("Gagal menghapus data:", error);
                    alert('Gagal menghapus data dari server.');
                });
            }
        },
        saveData() {
            const params = new URLSearchParams();
            params.append('judul', this.formData.judul);
            params.append('isi', this.formData.isi);
            params.append('status', this.formData.status);

            if (this.formData.id) {
                // Operasi Update Data via Spoofing PUT Method
                params.append('_method', 'PUT');
                axios.post(apiUrl + '/post/' + this.formData.id, params, {
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                })
                .then(response => { 
                    alert('Data artikel berhasil diperbarui!');
                    this.loadData(); 
                })
                .catch(error => console.error("Gagal memperbarui data:", error));
            } else {
                // Operasi Create Data Baru (POST Method murni)
                axios.post(apiUrl + '/post', params, {
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                })
                .then(response => { 
                    alert('Data artikel baru berhasil disimpan!');
                    this.loadData(); 
                })
                .catch(error => console.error("Gagal menyimpan data baru:", error));
            }
            
            // Reset state form setelah request selesai
            this.formData = { id: null, judul: '', isi: '', status: 0 };
            this.showForm = false;
        },
        statusText(status) {
            return parseInt(status) === 1 ? 'Publish' : 'Draft';
        }
    }
};

// Pasang komponen ke objek global window agar dapat dipetakan di app.js
window.Artikel = Artikel;
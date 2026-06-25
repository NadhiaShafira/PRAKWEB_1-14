const { createApp } = Vue;
const { createRouter, createWebHashHistory } = VueRouter;

// =========================================================================
// CONFIG: SINKRONISASI ALAMAT API REST END POINT BACKEND CI4
// =========================================================================
// Pastikan ini sama dengan port php spark serve lu (8080)
const apiUrl = 'http://localhost:8080'; 

// =========================================================================
// 1. MAPPING RUTE URL KE KOMPONEN
// =========================================================================
const routes = [
    { path: '/', component: Home }, 
    { path: '/login', component: Login }, 
    { 
        path: '/artikel', 
        component: Artikel,
        meta: { requiresAuth: true } 
    },
    { 
        path: '/about', 
        component: About,
        meta: { requiresAuth: true } 
    }
];

// =========================================================================
// 2. INSTANSIASI VUE ROUTER
// =========================================================================
const router = createRouter({
    history: createWebHashHistory(), 
    routes: routes 
});

// =========================================================================
// 3. IMPLEMENTASI NAVIGATION GUARDS
// =========================================================================
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('isLoggedIn') === 'true'; 
    
    // Jika rute butuh login tapi belum login, tendang ke login
    if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) { 
        alert('Akses Ditolak! Anda harus login terlebih dahulu.'); 
        next('/login'); 
    } 
    // Jika user sudah login tapi coba akses /login, lempar ke /artikel
    else if (to.path === '/login' && isAuthenticated) {
        next('/artikel');
    }
    else {
        next(); 
    }
});

// =========================================================================
// 4. INISIALISASI APLIKASI VUE
// =========================================================================
const app = createApp({
    data() {
        return {
            // Kita gunakan fungsi untuk mengambil nilai terbaru dari localStorage
            isLoggedIn: localStorage.getItem('isLoggedIn') === 'true'
        }
    },
    // Watcher ini akan memastikan navbar (isLoggedIn) langsung update 
    // kalau ada perubahan di localStorage secara global
    watch: {
        '$route'() {
            this.isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
        }
    },
    methods: {
        logout() {
            if (confirm('Apakah Anda yakin ingin keluar aplikasi?')) { 
                localStorage.removeItem('isLoggedIn'); 
                localStorage.removeItem('userToken'); 
                localStorage.removeItem('username'); 
                
                this.isLoggedIn = false;
                
                // Tendang ke Home
                this.$router.push('/');
                // Delay sebentar biar state sempat terupdate sebelum reload
                setTimeout(() => { window.location.reload(); }, 100);
            }
        }
    }
});

app.use(router); 
app.mount('#app');
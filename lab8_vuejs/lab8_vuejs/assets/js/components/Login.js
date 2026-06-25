const Login = {
    template: `
        <div class="login-container">
            <h2>Form Login Admin</h2>
            <form @submit.prevent="handleLogin">
                <input v-model="username" type="text" placeholder="Username" required>
                <input v-model="password" type="password" placeholder="Password" required>
                <button type="submit">Masuk Aplikasi</button>
            </form>
            <p v-if="errorMessage" style="color:red;">{{ errorMessage }}</p>
        </div>
    `,
    data() {
        return { 
            username: '', 
            password: '', 
            errorMessage: '' 
        }
    },
    methods: {
        handleLogin() {
            // Kita tembak langsung ke URL server CI4 lu
            const targetUrl = 'http://localhost:8080/api/auth/login';
            
            axios.post(targetUrl, {
                username: this.username,
                password: this.password
            })
            .then(response => {
                if(response.data.status === 200) {
                    localStorage.setItem('isLoggedIn', 'true');
                    window.location.reload(); // Paksa reload biar navbar bener
                } else {
                    this.errorMessage = response.data.messages;
                }
            })
            .catch(error => {
                console.log(error);
                this.errorMessage = "Gagal konek ke server (Cek port 8080/CORS)";
            });
        }
    }
};
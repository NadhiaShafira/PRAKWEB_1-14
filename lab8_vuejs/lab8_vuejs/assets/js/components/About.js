const About = {
    template: `
    <div class="home-container" style="text-align: center; padding: 30px;">
        <h2>Profil Pengembang</h2>
        
        <div style="margin: 20px auto; width: 150px; height: 150px; background: #3152d6; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 40px; font-weight: bold; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            FF
        </div>
        
        <table style="max-width: 400px; margin: 20px auto; text-align: left; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); width: 100%;">
            <tr>
                <th style="padding: 12px 20px; border-bottom: 1px solid #f0f0f0; width: 30%;">Nama</th>
                <td style="padding: 12px 20px; border-bottom: 1px solid #f0f0f0; color: #333;">Fajar Fawwaz Atallah</td>
            </tr>
            <tr>
                <th style="padding: 12px 20px; border-bottom: 1px solid #f0f0f0;">NIM</th>
                <td style="padding: 12px 20px; border-bottom: 1px solid #f0f0f0; font-family: monospace; font-size: 14px; color: #333;">312410357</td>
            </tr>
            <tr>
                <th style="padding: 12px 20px;">Kelas</th>
                <td style="padding: 12px 20px; color: #333;">TI.24.A4 (i241d)</td>
            </tr>
        </table>
    </div>
    `
};

// Daftarkan ke scope global agar bisa dibaca oleh Vue Router di app.js
window.About = About;
# Serenity - Aplikasi Kesehatan Mental & Kesejahteraan 🌿

**Serenity** adalah platform kesehatan mental komprehensif yang dirancang dengan penuh empati untuk membantu pengguna menemukan ketenangan, melacak suasana hati, dan membangun kebiasaan positif setiap hari. Dibangun dengan framework Laravel yang kuat dan desain antarmuka yang menenangkan.

![Serenity Banner](public/images/hero-serenity.png)

## ✨ Fitur Utama

Aplikasi ini dilengkapi dengan berbagai fitur untuk mendukung kesejahteraan mental Anda:

### 1. 📊 Pelacak Mood (Mood Tracker)
Pantau kondisi emosional Anda setiap hari.
- **Check-in Harian**: Rekam bagaimana perasaan Anda hari ini.
- **Analisis Tidur**: Log jam tidur untuk melihat korelasinya dengan mood.
- **Tag Aktivitas**: Catat apa yang mempengaruhi perasaan Anda.
- **Grafik Visual**: Lihat tren perubahan mood Anda selama 7 hari terakhir.
- **Streak Harian**: Bangun konsistensi dalam merawat diri.

### 2. 📓 Jurnal Pintar
Ruang aman untuk mencurahkan isi hati dan refleksi diri.
- Tulis pengalaman, ide, atau perasaan Anda dalam jurnal pribadi yang aman.
- Review kembali catatan masa lalu untuk melihat perkembangan diri.

### 3. 💬 Teman AI ("Curhat")
Dukungan instan kapan saja Anda butuhkan.
- Ngobrol dengan AI yang dirancang untuk menjadi pendengar yang baik dan suportif.
- Dapatkan respon yang empatik dan saran praktis.

### 4. 🎯 Misi Harian
Tugas-tugas kecil yang bermakna untuk meningkatkan kesejahteraan.
- Terima misi harian yang dipersonalisasi dari "AI Coach".
- Selesaikan tantangan sederhana untuk meningkatkan suasana hati.

### 5. 🧘 Fitur Kesejahteraan (Wellness Tools)
Alat bantu untuk menenangkan pikiran dan tubuh.
- **Latihan Pernapasan**: Panduan visual untuk teknik pernapasan yang menenangkan.
- **Musik Relaksasi**: Koleksi suara alam dan musik ambient.
- **Tombol SOS**: Akses cepat ke bantuan darurat jika Anda sedang dalam krisis.
- **Pojok Baca (Library)**: Artikel dan tips seputar kesehatan mental.

### 6. 📈 Laporan Bulanan
- Unduh laporan kesehatan mental Anda dalam format PDF setiap bulan untuk evaluasi diri atau dibagikan kepada profesional.

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: [Laravel 10](https://laravel.com)
- **Frontend**: [Blade Templates](https://laravel.com/docs/blade), [Tailwind CSS](https://tailwindcss.com), [Alpine.js](https://alpinejs.dev)
- **Database**: MySQL
- **AI Integration**: Google Gemini (via API)
- **Charts**: Chart.js

## 🚀 Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda:

### Prasyarat
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

### Langkah-langkah

1.  **Clone Repository**
    ```bash
    git clone https://github.com/AnasHarun1/Serenity.git
    cd Serenity
    ```

2.  **Install Dependensi PHP**
    ```bash
    composer install
    ```

3.  **Install Dependensi Frontend**
    ```bash
    npm install
    ```

4.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan sesuaikan konfigurasi database Anda (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Migrasi Database**
    Jalankan migrasi untuk membuat tabel-tabel database:
    ```bash
    php artisan migrate
    ```
    *(Opsional) Jika ingin mengisi data dummy:*
    ```bash
    php artisan db:seed
    ```

7.  **Jalankan Aplikasi**
    Jalankan server pengembangan Laravel:
    ```bash
    php artisan serve
    ```
    Dan jalankan build aset (di terminal terpisah):
    ```bash
    npm run dev
    ```

8.  **Selesai!**
    Buka browser dan akses `http://localhost:8000`.

---

## 📄 Lisensi

Proyek ini adalah perangkat lunak open-source di bawah lisensi [MIT](https://opensource.org/licenses/MIT).

---

<p align="center">
  Dibuat dengan ❤️ untuk kedamaian pikiran Anda.
</p>

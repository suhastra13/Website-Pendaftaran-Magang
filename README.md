# 🎓 Sistem Pendaftaran Magang DP3A Sumsel

> Aplikasi web modern berbasis Laravel untuk mengelola pendaftaran magang di **Dinas Pemberdayaan Perempuan dan Perlindungan Anak (DP3A) Provinsi Sumatera Selatan**

---

## 📋 Deskripsi

Sistem ini memudahkan proses pendaftaran magang secara **online dan paperless**. Peserta dapat mendaftar, mengunggah dokumen, dan memantau status pengajuan secara real-time. Admin dapat mengelola data pendaftar, mengubah status, mengirim notifikasi email, dan mengekspor data ke CSV.

---

## ✨ Fitur Unggulan

### 👨‍🎓 **Panel Peserta**

-   ✅ Registrasi dan login yang aman
-   📝 Form pendaftaran lengkap dengan:
    -   Data pribadi (nama, email, no HP, NIM, universitas, prodi, semester, alamat)
    -   Informasi magang (judul, fokus, motivasi)
    -   Upload dokumen (CV, surat pengantar, KTM, KTP)
-   📊 Dashboard interaktif untuk monitoring status
-   🔔 Notifikasi email otomatis untuk update status
-   📄 Download surat penerimaan magang (PDF) untuk pendaftar yang diterima

### 👔 **Panel Admin**

-   📈 Dashboard dengan statistik lengkap (total pendaftar, status pending/diterima/ditolak)
-   🔍 Pencarian dan filter data pendaftar
-   📋 Manajemen pendaftar:
    -   Lihat detail lengkap peserta dan dokumen
    -   Update status pengajuan dengan catatan
    -   Atur tanggal mulai dan selesai magang
-   📧 Pengiriman email notifikasi otomatis
-   📤 Export data pendaftar ke format CSV
-   🖼️ Preview dokumen dalam format kartu yang rapi

---

## 📸 Screenshot / Demo

### Dashboard Admin

![Landing Page](public/screenshots/dashboard-admin.png)

### Dashboard Peserta

![Dashboard Peserta](public/screenshots/dashboard-peserta.png)

### Data Peserta Yang di Akses Admin

![Status Pendaftaran](public/screenshots/data-peserta-admin.png)

### Status Pendaftaran Peserta

![Detail Pendaftar](public/screenshots/pendaftaran-magang.png)

## 💻 Requirements

=======

## 🛠️ Teknologi

| Teknologi     | Versi    | Fungsi               |
| ------------- | -------- | -------------------- |
| Laravel       | 10/11/12 | Backend Framework    |
| PHP           | ≥ 8.1    | Server-side Language |
| MySQL/MariaDB | -        | Database             |
| Tailwind CSS  | -        | UI Framework         |
| Vite          | -        | Asset Bundler        |
| Mailtrap      | -        | Email Testing        |
| DomPDF        | -        | PDF Generator        |

---

<<<<<<< HEAD
Sip, kita rapikan jadi enak dibaca dan gampang di-copy ke README.
Silakan ganti bagian “Cara Menjalankan” di README dengan ini:

````markdown
## 🚀 Cara Menjalankan Aplikasi

Langkah berikut diasumsikan dijalankan di **Windows + XAMPP**, tapi di OS lain konsepnya sama.

---

### 1. Clone Repository

=======

## 📸 Screenshot

### Dashboard Admin

![Dashboard Admin](public/screenshots/dashboard-admin.png)

### Dashboard Peserta

![Dashboard Peserta](public/screenshots/dashboard-peserta.png)

### Data Peserta Yang Diakses Admin

![Data Peserta Admin](public/screenshots/data-peserta-admin.png)

### Status Pendaftaran Peserta

![Pendaftaran Magang](public/screenshots/pendaftaran-magang.png)

---

## 📦 Prasyarat

Pastikan sistem Anda sudah terinstall:

-   ✔️ PHP 8.1 atau lebih baru
-   ✔️ Composer
-   ✔️ MySQL atau MariaDB
-   ✔️ Node.js & NPM
-   ✔️ Git (opsional)

---

## 🚀 Cara Menjalankan Aplikasi

Langkah berikut diasumsikan dijalankan di **Windows + XAMPP**, tapi di OS lain konsepnya sama.

---

### 1️⃣ Clone Repository

> > > > > > > 2433952 (Update README)

```bash
git clone https://github.com/suhastral3/Website-Pendaftaran-Magang.git
cd Website-Pendaftaran-Magang
<<<<<<< HEAD
```
````

---

### 2. Install Dependency PHP & JS

=======

````

---

### 2️⃣ Install Dependency PHP & JS
>>>>>>> 2433952 (Update README)

```bash
composer install
npm install
````

Jika pakai npm versi baru dan ada masalah dependency, bisa pakai:

```bash
npm install --legacy-peer-deps
```

---

<<<<<<< HEAD

### 3. Buat & Konfigurasi File `.env`

=======

### 3️⃣ Buat & Konfigurasi File `.env`

> > > > > > > 2433952 (Update README)

Buat file `.env` dari contoh:

```bash
cp .env.example .env
```

Lalu buka file `.env` dan minimal sesuaikan:

```env
APP_NAME="Sistem Pendaftaran Magang"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
```

<<<<<<< HEAD

#### Koneksi database (sesuaikan dengan XAMPP/MySQL)

=======

#### Koneksi Database (sesuaikan dengan XAMPP/MySQL)

> > > > > > > 2433952 (Update README)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=magang_dpppa   # buat dulu database ini di phpMyAdmin
DB_USERNAME=root           # default XAMPP
DB_PASSWORD=               # biasanya kosong di XAMPP
```

---

<<<<<<< HEAD

### 4. Konfigurasi Mailtrap (Opsional tapi Disarankan)

Aplikasi ini menggunakan **Mailtrap** untuk testing email
(jadi tidak mengirim ke email sungguhan).

Di Mailtrap:

1. # Buat Inbox baru.

### 4️⃣ Konfigurasi Mailtrap (Opsional tapi Disarankan)

Aplikasi ini menggunakan **Mailtrap** untuk testing email (jadi tidak mengirim ke email sungguhan).

**Di Mailtrap:**

1. Buat Inbox baru
    > > > > > > > 2433952 (Update README)
2. Ambil konfigurasi SMTP lalu masukkan ke `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=xxxxxxxxxxxxxx
MAIL_PASSWORD=xxxxxxxxxxxxxx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="no-reply@magang.test"
MAIL_FROM_NAME="Sistem Pendaftaran Magang"
```

<<<<<<< HEAD

-   Jika dibiarkan seperti ini, email **tidak masuk ke Gmail peserta**,
    tapi muncul di dashboard Mailtrap.
-   Untuk produksi, ganti dengan konfigurasi SMTP yang sungguhan
    (Gmail SMTP, email kampus/perusahaan, dsb).

---

### 5. Generate APP_KEY

=======

> 📧 **Catatan Email:**
>
> -   Jika dibiarkan seperti ini, email **tidak masuk ke Gmail peserta**, tapi muncul di dashboard Mailtrap
> -   Untuk produksi, ganti dengan konfigurasi SMTP yang sungguhan (Gmail SMTP, email kampus/perusahaan, dsb)

---

### 5️⃣ Generate APP_KEY

> > > > > > > 2433952 (Update README)

```bash
php artisan key:generate
```

---

<<<<<<< HEAD

### 6. Migrasi Database & Seeder Admin

=======

### 6️⃣ Migrasi Database & Seeder Admin

> > > > > > > 2433952 (Update README)

```bash
php artisan migrate --seed
```

Perintah ini akan:

<<<<<<< HEAD

-   Membuat semua tabel yang dibutuhkan.
-   Menjalankan `AdminUserSeeder` untuk membuat akun admin default.

**Akun admin default:**

-   Email : `admin@magang.test`
-   Password: `password123`

Silakan ubah password ini setelah login di halaman admin.

---

### 7. Buat Storage Link (untuk File Upload)

=======

-   Membuat semua tabel yang dibutuhkan
-   Menjalankan `AdminUserSeeder` untuk membuat akun admin default

**Akun admin default:**

```
📧 Email: admin@magang.test
🔑 Password: password123
```

> ⚠️ **Penting:** Segera ubah password setelah login di halaman admin!

---

### 7️⃣ Buat Storage Link (untuk File Upload)

> > > > > > > 2433952 (Update README)

```bash
php artisan storage:link
```

<<<<<<< HEAD

Supaya file yang di-upload (CV, surat pengantar, KTP, KTM) dapat diakses lewat `public/storage`.

---

### 8. Jalankan Server & Build Asset

# Jalankan backend Laravel:

Supaya file yang di-upload (CV, surat pengantar, KTP, KTM) dapat diakses lewat `public/storage`.

---

### 8️⃣ Jalankan Server & Build Asset

**Jalankan backend Laravel:**

> > > > > > > 2433952 (Update README)

```bash
php artisan serve
```

<<<<<<< HEAD
Jalankan frontend (Tailwind + JS), pilih salah satu:
=======
**Jalankan frontend (Tailwind + JS), pilih salah satu:**

> > > > > > > 2433952 (Update README)

-   Untuk development (live reload):

<<<<<<< HEAD

```bash
npm run dev
```

-   # Untuk build produksi:

```bash
npm run dev
```

> > > > > > > 2433952 (Update README)

```bash
npm run build
```

<<<<<<< HEAD
Setelah itu, buka aplikasi di browser:

```text
http://127.0.0.1:8000
```

=======

```bash
npm run build
```

Setelah itu, buka aplikasi di browser:

```
http://127.0.0.1:8000
```

---

## 📂 Struktur Project

```
Website-Pendaftaran-Magang/
├── app/
│   ├── Http/Controllers/      # Controllers
│   ├── Models/                # Eloquent Models
│   └── Mail/                  # Email Templates
├── database/
│   ├── migrations/            # Database Migrations
│   └── seeders/               # Database Seeders
├── resources/
│   ├── views/                 # Blade Templates
│   └── js/                    # JavaScript Files
├── public/
│   ├── screenshots/           # Screenshot Aplikasi
│   └── storage/               # Public Storage (symlink)
├── routes/
│   └── web.php                # Web Routes
└── storage/
    └── app/public/            # File Uploads
```

---

## 🔐 Kredensial Default

### Admin

-   **Email:** `admin@magang.test`
-   **Password:** `admin12345`

> ⚠️ Ubah kredensial ini setelah instalasi pertama untuk keamanan!

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan:

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m 'Menambah fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

---

## 📝 Lisensi

Project ini bersifat open source untuk keperluan edukasi dan pengembangan.

---

## 👨‍💻 Developer

Dikembangkan dengan ❤️ untuk DP3A Provinsi Sumatera Selatan

---

## 📞 Kontak & Support

Jika mengalami kendala atau ingin bertanya:

-   📧 Email: [indrajayabta414@gmail.com]

---

⭐ **Jika project ini bermanfaat, jangan lupa beri bintang!** ⭐

> > > > > > > 2433952 (Update README)

# TOUGAR — Struktur MVC

## 📁 Struktur Folder

```
tougar_mvc/
├── app/
│   ├── controllers/          ← CONTROLLER (logika request/response)
│   │   ├── BaseController.php     Kelas induk semua controller
│   │   ├── AuthController.php     Login, logout
│   │   ├── BerandaController.php  Halaman beranda
│   │   ├── DestinasiController.php
│   │   ├── PaketWisataController.php
│   │   ├── LaporanController.php
│   │   ├── KontakController.php
│   │   ├── PetaWisataController.php
│   │   └── AdminController.php   Dashboard admin + CRUD semua menu
│   │
│   ├── models/               ← MODEL (akses database)
│   │   ├── BaseModel.php          CRUD dasar (getAll, getById, insert, update, delete)
│   │   │                          mendukung primary key kustom lewat $primaryKey
│   │   ├── UserModel.php          Pengguna: login, register, cari by username
│   │   ├── WisataModel.php        Destinasi wisata          (PK: id_wisata)
│   │   ├── PaketWisataModel.php   Paket tour                (PK: id_paket)
│   │   ├── PetaWisataModel.php    Titik lokasi peta          (PK: id_peta)
│   │   ├── KontakModel.php        Pesan kontak               (PK: id_kontak)
│   │   ├── SliderModel.php        Gambar slider beranda      (PK: id_slider)
│   │   └── LaporanModel.php       Laporan kunjungan & statistik (PK: id_laporan)
│   │
│   └── views/                ← VIEW (tampilan HTML)
│       ├── layouts/
│       │   ├── main.php       Layout utama (navbar + footer)
│       │   ├── auth.php       Layout halaman login
│       │   └── admin.php      Layout admin baru (sidebar + emoji icon)
│       ├── beranda/index.php
│       ├── destinasi/index.php
│       ├── paket_wisata/index.php
│       ├── laporan/index.php
│       ├── kontak/index.php
│       ├── peta_wisata/index.php
│       ├── login/index.php
│       └── admin/
│           ├── dashboard.php
│           ├── wisata.php / tambah_wisata.php / edit_wisata.php
│           ├── paket.php / tambah_paket.php / edit_paket.php
│           ├── peta.php / tambah_peta.php / edit_peta.php
│           ├── laporan.php
│           ├── kontak.php
│           ├── slider.php / tambah_slider.php / edit_slider.php
│           └── users.php / tambah_user.php / edit_user.php
│
├── config/
│   ├── database.php          Koneksi MySQL
│   └── router.php            Router utama (Front Controller)
│
├── database/
│   ├── tougar.sql                       Skema database awal
│   └── migrasi_dashboard_admin.sql      Migrasi tambahan untuk dashboard admin baru
│
└── public/                   ← Web root (yang dipointing Apache/Nginx)
    ├── index.php             Entry point — semua request masuk sini
    ├── .htaccess             URL rewriting
    └── assets/
        ├── css/admin.css     CSS dashboard admin baru (sidebar + emoji)
        ├── css/              CSS halaman publik lain
        ├── js/               Semua file JS
        └── images/           Gambar wisata
```

---

## 🔄 Alur MVC

```
Browser → public/index.php → Router → Controller → Model → View
                                                         ↑
                                                    (ambil data)
```

**Contoh alur halaman Destinasi:**
1. User buka `/destinasi`
2. `public/index.php` (Front Controller) menerima request
3. `Router` mencocokkan route → memanggil `DestinasiController::index()`
4. Controller memanggil `WisataModel::getAll()` → query ke database
5. Data dikembalikan ke controller
6. Controller memanggil `render('destinasi/index', ['destinasi' => $data])`
7. View `app/views/destinasi/index.php` di-render di dalam layout `main.php`
8. HTML dikirim ke browser

---

## ⚙️ Cara Setup

### 1. Database
```sql
-- 1) Jalankan dulu skema awal
mysql -u root -p < database/tougar.sql

-- 2) WAJIB: jalankan migrasi tambahan untuk dashboard admin baru
--    (menambah kolom status di users & paket_wisata, plus tabel
--    peta_wisata, kontak, slider)
mysql -u root -p < database/migrasi_dashboard_admin.sql
```
Atau lewat phpMyAdmin: Import kedua file di atas secara berurutan pada database `tougar`.

> ⚠️ Tanpa menjalankan `migrasi_dashboard_admin.sql`, menu **Kelola Paket Wisata**,
> **Kelola Peta**, **Pesan Kontak**, **Kelola Slider**, dan **Kelola User** (kolom status)
> di dashboard admin baru tidak akan berfungsi karena tabel/kolomnya belum ada.

### 2. Konfigurasi Database
Edit `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');     // ganti sesuai password MySQL kamu
define('DB_NAME', 'tougar');
```

### 3. Web Server
**Apache:** Arahkan DocumentRoot ke folder `public/`

**XAMPP/Laragon:** Letakkan folder `tougar_mvc/` di `htdocs/` dan akses lewat:
```
http://localhost/tougar_mvc/public/
```

Atau buat Virtual Host agar bisa akses dengan `http://tougar.local/`

---

## 🔐 Login Default Admin
| Username | Password | Role  |
|----------|----------|-------|
| admin    | admin123 | admin |

---

## 🆕 Dashboard Admin Baru (8 Menu)

Dashboard admin dirombak total dengan tampilan sidebar baru (ikon emoji, kartu
statistik gradient teal) dan kini punya CRUD penuh untuk 8 menu, semua
terhubung ke database asli (bukan data dummy):

| Menu | Tabel DB | Aksi yang tersedia |
|------|----------|---------------------|
| 📊 Dashboard | (gabungan semua) | Ringkasan jumlah data tiap menu |
| 🏞️ Kelola Destinasi | `wisata` | Tambah, edit, hapus |
| 📦 Kelola Paket Wisata | `paket_wisata` | Tambah, edit, hapus, status aktif/nonaktif |
| 🗺️ Kelola Peta | `peta_wisata` *(baru)* | Tambah, edit, hapus titik koordinat |
| 📋 Kelola Laporan | `laporan_kunjungan` | Lihat & hapus |
| 📞 Pesan Kontak | `kontak` *(baru)* | Lihat & hapus pesan dari form kontak publik |
| 🖼️ Kelola Slider | `slider` *(baru)* | Tambah, edit, hapus gambar slider beranda |
| 👥 Kelola User | `users` | Tambah, edit, hapus, atur role & status |

Rute admin lengkap ada di `public/index.php` (prefix `/admin/...`), semua
diproses oleh `AdminController`.

### Catatan perbaikan teknis
Saat merombak, ditemukan bug lama di `BaseModel`: method `getById()`,
`update()`, dan `delete()` selalu memakai `WHERE id = ?`, padahal tabel
`wisata` memakai kolom `id_wisata` dan `paket_wisata` memakai `id_paket`.
Ini sudah diperbaiki dengan menambahkan properti `$primaryKey` yang bisa
di-override tiap model anak.

---

## 🚀 Perbedaan Versi Lama vs MVC

| Aspek            | Versi Lama                     | Versi MVC                       |
|------------------|--------------------------------|---------------------------------|
| Logika & tampilan| Campur dalam 1 file PHP        | Dipisah ke Controller + View    |
| Akses database   | Langsung di halaman HTML       | Melalui Model terpisah          |
| Routing          | Link antar file `.php`         | Router terpusat di `index.php`  |
| Reusability      | Copy-paste tiap halaman        | Layout & komponen bisa dipakai  |
| Maintainability  | Sulit diubah                   | Mudah dikelola                  |
| Session/Auth     | Tidak ada                      | Ada: login, logout, requireLogin|


<?php
// public/index.php
// Entry point utama — semua request masuk ke sini
// Web server (Apache/Nginx) harus dikonfigurasi untuk redirect ke file ini

session_start();

// Autoload: muat file konfigurasi dasar
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/router.php';
require_once __DIR__ . '/../app/controllers/BaseController.php';

// ================================================================
// DEFINISI ROUTE
// ================================================================
$router = new Router();

// --- Landing Page (publik, tanpa login) ---
$router->get( '/',             'LandingController', 'index');
$router->get( '/landing',      'LandingController', 'index');

// --- Auth ---
$router->get( '/login',        'AuthController', 'showLogin');
$router->post('/login',        'AuthController', 'login');
$router->get( '/logout',       'AuthController', 'logout');
$router->get( '/register',     'AuthController', 'showRegister');
$router->post('/register',     'AuthController', 'register');
$router->get( '/forgot-password', 'AuthController', 'showForgot');
$router->post('/forgot-password', 'AuthController', 'forgot');
$router->get( '/reset-password',  'AuthController', 'showReset');
$router->post('/reset-password',  'AuthController', 'resetPassword');

// --- Pemesanan Paket (publik) ---
$router->post('/pesan-paket',  'PesanController', 'store');

// --- Beranda ---
$router->get( '/beranda',      'BerandaController', 'index');

// --- Destinasi ---
$router->get( '/destinasi',    'DestinasiController', 'index');

// --- Paket Wisata ---
$router->get( '/paket-wisata', 'PaketWisataController', 'index');

// --- Laporan ---
$router->get( '/laporan',      'LaporanController', 'index');

// --- Kontak ---
$router->get( '/kontak',       'KontakController', 'index');
$router->post('/kontak/send',  'KontakController', 'send');

// --- Peta Wisata ---
$router->get( '/peta-wisata',  'PetaWisataController', 'index');

// --- Admin: Dashboard ---
$router->get( '/admin',              'AdminController', 'index');

// --- Admin: Kelola Destinasi (wisata) ---
$router->get( '/admin/wisata',         'AdminController', 'wisata');
$router->get( '/admin/wisata/tambah',  'AdminController', 'tambahWisata');
$router->post('/admin/wisata/tambah',  'AdminController', 'tambahWisata');
$router->get( '/admin/wisata/edit',    'AdminController', 'editWisata');
$router->post('/admin/wisata/edit',    'AdminController', 'editWisata');
$router->get( '/admin/wisata/hapus',   'AdminController', 'hapusWisata');

// --- Admin: Kelola Paket Wisata ---
$router->get( '/admin/paket',          'AdminController', 'paket');
$router->get( '/admin/paket/tambah',   'AdminController', 'tambahPaket');
$router->post('/admin/paket/tambah',   'AdminController', 'tambahPaket');
$router->get( '/admin/paket/edit',     'AdminController', 'editPaket');
$router->post('/admin/paket/edit',     'AdminController', 'editPaket');
$router->get( '/admin/paket/hapus',    'AdminController', 'hapusPaket');

// --- Admin: Kelola Peta ---
$router->get( '/admin/peta',           'AdminController', 'peta');
$router->get( '/admin/peta/tambah',    'AdminController', 'tambahPeta');
$router->post('/admin/peta/tambah',    'AdminController', 'tambahPeta');
$router->get( '/admin/peta/edit',      'AdminController', 'editPeta');
$router->post('/admin/peta/edit',      'AdminController', 'editPeta');
$router->get( '/admin/peta/hapus',     'AdminController', 'hapusPeta');

// --- Admin: Kelola Laporan ---
$router->get( '/admin/laporan',        'AdminController', 'laporan');
$router->get( '/admin/laporan/hapus',  'AdminController', 'hapusLaporan');

// --- Admin: Pesan Kontak ---
$router->get( '/admin/kontak',         'AdminController', 'kontak');
$router->get( '/admin/kontak/hapus',   'AdminController', 'hapusKontak');

// --- Admin: Kelola Slider ---
$router->get( '/admin/slider',         'AdminController', 'slider');
$router->get( '/admin/slider/tambah',  'AdminController', 'tambahSlider');
$router->post('/admin/slider/tambah',  'AdminController', 'tambahSlider');
$router->get( '/admin/slider/edit',    'AdminController', 'editSlider');
$router->post('/admin/slider/edit',    'AdminController', 'editSlider');
$router->get( '/admin/slider/hapus',   'AdminController', 'hapusSlider');

// --- Admin: Kelola User ---
$router->get( '/admin/users',          'AdminController', 'users');
$router->get( '/admin/users/tambah',   'AdminController', 'tambahUser');
$router->post('/admin/users/tambah',   'AdminController', 'tambahUser');
$router->get( '/admin/users/edit',     'AdminController', 'editUser');
$router->post('/admin/users/edit',     'AdminController', 'editUser');
$router->get( '/admin/users/hapus',    'AdminController', 'hapusUser');

// --- Admin: Kelola Pesanan ---
$router->get( '/admin/pesanan',        'AdminController', 'pesanan');
$router->get( '/admin/pesanan/status', 'AdminController', 'updateStatusPesanan');
$router->get( '/admin/pesanan/hapus',  'AdminController', 'hapusPesanan');

// ================================================================
// JALANKAN ROUTER
// ================================================================
$router->dispatch();

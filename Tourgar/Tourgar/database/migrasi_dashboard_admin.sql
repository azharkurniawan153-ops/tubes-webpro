-- ============================================================
-- migrasi_dashboard_admin.sql
-- Migrasi tambahan untuk Dashboard Admin baru TOUGAR.
-- Jalankan file ini SETELAH tougar.sql (lewat phpMyAdmin > Import,
-- atau psql/mysql client), pada database yang sama ("tougar").
--
-- Berisi:
--   1. Kolom tambahan tabel users   -> status (aktif/nonaktif)
--   2. Kolom tambahan tabel paket_wisata -> destinasi & status
--   3. Tabel baru: peta_wisata
--   4. Tabel baru: kontak
--   5. Tabel baru: slider
-- ============================================================

USE tougar;

-- 1) USERS: tambah kolom status untuk fitur aktif/nonaktif di Kelola User
ALTER TABLE users
  ADD COLUMN IF NOT EXISTS status ENUM('active','inactive') DEFAULT 'active' AFTER role;

-- 2) PAKET_WISATA: lengkapi kolom agar sesuai form Kelola Paket Wisata
ALTER TABLE paket_wisata
  ADD COLUMN IF NOT EXISTS destinasi VARCHAR(255) AFTER harga,
  ADD COLUMN IF NOT EXISTS status ENUM('active','inactive') DEFAULT 'active' AFTER fasilitas;

-- 3) PETA_WISATA: lokasi titik peta (terpisah dari tabel wisata,
--    supaya peta bisa punya titik sendiri tanpa harus selalu terkait
--    1:1 dengan data destinasi di tabel wisata)
CREATE TABLE IF NOT EXISTS peta_wisata (
    id_peta INT AUTO_INCREMENT PRIMARY KEY,
    nama_lokasi VARCHAR(150) NOT NULL,
    latitude DECIMAL(10,6) NOT NULL,
    longitude DECIMAL(10,6) NOT NULL,
    kategori VARCHAR(50),
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4) KONTAK: pesan masuk dari form kontak pengunjung
CREATE TABLE IF NOT EXISTS kontak (
    id_kontak INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telepon VARCHAR(30),
    pesan TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5) SLIDER: gambar slider untuk beranda
CREATE TABLE IF NOT EXISTS slider (
    id_slider INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    urutan INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ------------------------------------------------------------
-- Seed contoh data peta (opsional, boleh dihapus / disesuaikan)
-- ------------------------------------------------------------
INSERT INTO peta_wisata (nama_lokasi, latitude, longitude, kategori, deskripsi) VALUES
('Gunung Papandayan', -7.3197, 107.7367, 'Gunung', 'Gunung dengan hamparan edelweiss'),
('Pantai Santolo',    -7.7234, 107.7089, 'Pantai', 'Pantai pasir putih eksotis'),
('Situ Bagendit',     -7.2081, 107.8722, 'Danau',  'Wisata danau terkenal dengan legenda rakyat'),
('Kawah Kamojang',    -7.1266, 107.7929, 'Wisata Air', 'Kawasan geothermal'),
('Cipanas Garut',     -7.2167, 107.9000, 'Wisata Air', 'Pemandian air panas'),
('Darajat Pass',      -7.1683, 107.8047, 'Wisata Air', 'Kolam air panas dataran tinggi'),
('Talaga Bodas',      -7.2433, 107.8567, 'Danau',  'Danau kawah vulkanis'),
('Gunung Cikuray',    -7.2969, 107.8309, 'Gunung', 'Gunung tertinggi di Garut');

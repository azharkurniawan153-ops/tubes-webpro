CREATE DATABASE tougar;
USE tougar;

-- USER
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','wisatawan') DEFAULT 'wisatawan',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- DATA WISATA
CREATE TABLE wisata (
    id_wisata INT AUTO_INCREMENT PRIMARY KEY,
    nama_wisata VARCHAR(100) NOT NULL,
    lokasi VARCHAR(200) NOT NULL,
    kategori VARCHAR(50),
    deskripsi TEXT,
    harga_tiket INT,
    gambar VARCHAR(255)
);

-- PAKET WISATA
CREATE TABLE paket_wisata (
    id_paket INT AUTO_INCREMENT PRIMARY KEY,
    nama_paket VARCHAR(100) NOT NULL,
    durasi VARCHAR(50),
    harga INT,
    fasilitas TEXT
);

-- EVENT
CREATE TABLE event_wisata (
    id_event INT AUTO_INCREMENT PRIMARY KEY,
    nama_event VARCHAR(100),
    lokasi VARCHAR(150),
    tanggal DATE,
    deskripsi TEXT,
    gambar VARCHAR(255)
);

-- UMKM
CREATE TABLE umkm (
    id_umkm INT AUTO_INCREMENT PRIMARY KEY,
    nama_umkm VARCHAR(100),
    pemilik VARCHAR(100),
    lokasi VARCHAR(150),
    produk VARCHAR(255),
    gambar VARCHAR(255)
);

-- LAPORAN KUNJUNGAN
CREATE TABLE laporan_kunjungan (
    id_laporan INT AUTO_INCREMENT PRIMARY KEY,
    nama_pengunjung VARCHAR(100),
    wisata VARCHAR(100),
    tanggal DATE,
    jumlah_orang INT
);

-- ADMIN DEFAULT
INSERT INTO users
(nama,email,username,password,role)
VALUES
(
'Administrator',
'admin@tougar.com',
'admin',
MD5('admin123'),
'admin'
);
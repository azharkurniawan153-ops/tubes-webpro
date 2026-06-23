-- ============================================================
-- migrasi_pesanan.sql
-- Tabel pesanan paket wisata dari pengunjung
-- Jalankan setelah tougar.sql dan migrasi_dashboard_admin.sql
-- ============================================================

USE tougar;

CREATE TABLE IF NOT EXISTS pesanan (
    id_pesanan    INT AUTO_INCREMENT PRIMARY KEY,
    nama_pemesan  VARCHAR(100) NOT NULL,
    no_hp         VARCHAR(30)  NOT NULL,
    id_paket      INT          DEFAULT NULL,
    nama_paket    VARCHAR(150) NOT NULL,
    harga_paket   INT          DEFAULT 0,
    tanggal_pesan DATE         NOT NULL,
    jumlah_orang  INT          DEFAULT 1,
    catatan       TEXT,
    status        ENUM('pending','konfirmasi','selesai','batal') DEFAULT 'pending',
    user_id       INT          DEFAULT NULL,
    created_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_paket) REFERENCES paket_wisata(id_paket) ON DELETE SET NULL,
    FOREIGN KEY (user_id)  REFERENCES users(id) ON DELETE SET NULL
);

-- Contoh data pesanan (opsional)
INSERT INTO pesanan (nama_pemesan, no_hp, nama_paket, harga_paket, tanggal_pesan, jumlah_orang, catatan, status) VALUES
('Budi Santoso', '08123456789', 'Paket Darajat Pass', 350000, DATE_ADD(CURDATE(), INTERVAL 7 DAY), 4, 'Mohon siapkan guide berbahasa Indonesia', 'pending'),
('Siti Rahayu',  '08234567890', 'Paket Situ Bagendit', 200000, DATE_ADD(CURDATE(), INTERVAL 3 DAY), 2, '', 'konfirmasi');

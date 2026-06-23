<?php
// app/models/KontakModel.php

require_once __DIR__ . '/BaseModel.php';

class KontakModel extends BaseModel {
    protected $table = 'kontak';
    protected $primaryKey = 'id_kontak';

    /**
     * Simpan pesan kontak baru dari form publik
     */
    public function simpan($nama, $email, $telepon, $pesan) {
        $stmt = $this->db->prepare(
            "INSERT INTO kontak (nama, email, telepon, pesan) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param('ssss', $nama, $email, $telepon, $pesan);
        return $stmt->execute();
    }

    /**
     * Ambil semua pesan kontak, terbaru lebih dulu
     */
    public function getAllTerbaru() {
        $result = $this->db->query("SELECT * FROM kontak ORDER BY created_at DESC");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
}

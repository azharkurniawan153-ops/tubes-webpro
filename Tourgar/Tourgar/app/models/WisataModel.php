<?php
// app/models/WisataModel.php

require_once __DIR__ . '/BaseModel.php';

class WisataModel extends BaseModel {
    protected $table = 'wisata';
    protected $primaryKey = 'id_wisata';

    /**
     * Ambil destinasi berdasarkan kategori
     */
    public function getByKategori($kategori) {
        $stmt = $this->db->prepare("SELECT * FROM wisata WHERE kategori = ?");
        $stmt->bind_param('s', $kategori);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Cari wisata berdasarkan nama
     */
    public function search($keyword) {
        $like = "%$keyword%";
        $stmt = $this->db->prepare("SELECT * FROM wisata WHERE nama_wisata LIKE ? OR deskripsi LIKE ?");
        $stmt->bind_param('ss', $like, $like);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Ambil destinasi populer (3 teratas berdasarkan ID)
     */
    public function getPopuler($limit = 3) {
        $limit  = (int)$limit;
        $result = $this->db->query("SELECT * FROM wisata LIMIT $limit");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
}

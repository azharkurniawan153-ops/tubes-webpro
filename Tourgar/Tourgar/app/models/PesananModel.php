<?php
// app/models/PesananModel.php

require_once __DIR__ . '/BaseModel.php';

class PesananModel extends BaseModel {
    protected $table      = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    /**
     * Ambil semua pesanan, terbaru dulu
     */
    public function getAll() {
        $result = $this->db->query("SELECT * FROM pesanan ORDER BY created_at DESC");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /**
     * Insert pesanan baru
     */
    public function insert($data) {
        $stmt = $this->db->prepare(
            "INSERT INTO pesanan
             (nama_pemesan, no_hp, id_paket, nama_paket, harga_paket,
              tanggal_pesan, jumlah_orang, catatan, status, user_id)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            'ssisssisis',
            $data['nama_pemesan'],
            $data['no_hp'],
            $data['id_paket'],
            $data['nama_paket'],
            $data['harga_paket'],
            $data['tanggal_pesan'],
            $data['jumlah_orang'],
            $data['catatan'],
            $data['status'],
            $data['user_id']
        );
        return $stmt->execute();
    }

    /**
     * Update status pesanan
     */
    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE pesanan SET status = ? WHERE id_pesanan = ?");
        $stmt->bind_param('si', $status, $id);
        return $stmt->execute();
    }

    /**
     * Hapus pesanan
     */
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM pesanan WHERE id_pesanan = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    /**
     * Ambil pesanan berdasarkan status
     */
    public function getByStatus($status) {
        $stmt = $this->db->prepare("SELECT * FROM pesanan WHERE status = ? ORDER BY created_at DESC");
        $stmt->bind_param('s', $status);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Hitung total pesanan
     */
    public function countAll() {
        $result = $this->db->query("SELECT COUNT(*) as total FROM pesanan");
        $row = $result->fetch_assoc();
        return (int)$row['total'];
    }

    /**
     * Hitung pesanan pending
     */
    public function countPending() {
        $result = $this->db->query("SELECT COUNT(*) as total FROM pesanan WHERE status = 'pending'");
        $row = $result->fetch_assoc();
        return (int)$row['total'];
    }
}

<?php
// app/models/PaketWisataModel.php

require_once __DIR__ . '/BaseModel.php';

class PaketWisataModel extends BaseModel {
    protected $table = 'paket_wisata';
    protected $primaryKey = 'id_paket';

    /**
     * Ambil paket berdasarkan rentang harga
     */
    public function getByHarga($min, $max) {
        $min  = (int)$min;
        $max  = (int)$max;
        $stmt = $this->db->prepare("SELECT * FROM paket_wisata WHERE harga BETWEEN ? AND ?");
        $stmt->bind_param('ii', $min, $max);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

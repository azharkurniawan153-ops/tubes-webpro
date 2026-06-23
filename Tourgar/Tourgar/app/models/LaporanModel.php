<?php
// app/models/LaporanModel.php

require_once __DIR__ . '/BaseModel.php';

class LaporanModel extends BaseModel {
    protected $table = 'laporan_kunjungan';
    protected $primaryKey = 'id_laporan';

    /**
     * Statistik kunjungan per lokasi wisata
     */
    public function getStatistikPerLokasi() {
        $result = $this->db->query(
            "SELECT wisata, SUM(jumlah_orang) as total_pengunjung
             FROM laporan_kunjungan
             GROUP BY wisata
             ORDER BY total_pengunjung DESC"
        );
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /**
     * Tren kunjungan per bulan
     */
    public function getTrenBulanan() {
        $result = $this->db->query(
            "SELECT DATE_FORMAT(tanggal, '%Y-%m') as bulan,
                    SUM(jumlah_orang) as total_pengunjung
             FROM laporan_kunjungan
             GROUP BY bulan
             ORDER BY bulan ASC"
        );
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /**
     * Tambah laporan kunjungan baru
     */
    public function tambahLaporan($nama_pengunjung, $wisata, $tanggal, $jumlah_orang) {
        $stmt = $this->db->prepare(
            "INSERT INTO laporan_kunjungan (nama_pengunjung, wisata, tanggal, jumlah_orang)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param('sssi', $nama_pengunjung, $wisata, $tanggal, $jumlah_orang);
        return $stmt->execute();
    }
}

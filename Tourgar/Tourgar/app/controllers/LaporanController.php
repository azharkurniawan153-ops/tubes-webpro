<?php
// app/controllers/LaporanController.php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/LaporanModel.php';

class LaporanController extends BaseController {

    private $laporanModel;

    public function __construct() {
        $this->laporanModel = new LaporanModel();
    }

    /**
     * Tampilkan halaman laporan dengan statistik
     */
    public function index() {
        $this->requireLogin();

        $statistikLokasi = $this->laporanModel->getStatistikPerLokasi();
        $trenBulanan     = $this->laporanModel->getTrenBulanan();

        // Fallback data statis jika DB kosong
        if (empty($statistikLokasi)) {
            $statistikLokasi = [
                ['wisata' => 'Gunung Papandayan',   'total_pengunjung' => 12500],
                ['wisata' => 'Pantai Santolo',       'total_pengunjung' => 9800],
                ['wisata' => 'Situ Bagendit',        'total_pengunjung' => 8700],
                ['wisata' => 'Cipanas',              'total_pengunjung' => 7600],
                ['wisata' => 'Kawah Kamojang',       'total_pengunjung' => 6500],
            ];
        }

        if (empty($trenBulanan)) {
            $trenBulanan = [
                ['bulan' => 'Jan', 'total_pengunjung' => 3200],
                ['bulan' => 'Feb', 'total_pengunjung' => 4100],
                ['bulan' => 'Mar', 'total_pengunjung' => 5300],
                ['bulan' => 'Apr', 'total_pengunjung' => 4800],
                ['bulan' => 'Mei', 'total_pengunjung' => 6700],
                ['bulan' => 'Jun', 'total_pengunjung' => 7200],
            ];
        }

        $this->render('laporan/index', [
            'pageTitle'       => 'Laporan Statistik | TOUGAR',
            'statistikLokasi' => $statistikLokasi,
            'trenBulanan'     => $trenBulanan
        ]);
    }
}

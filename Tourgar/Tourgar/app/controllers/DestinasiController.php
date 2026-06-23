<?php
// app/controllers/DestinasiController.php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/WisataModel.php';

class DestinasiController extends BaseController {

    private $wisataModel;

    public function __construct() {
        $this->wisataModel = new WisataModel();
    }

    /**
     * Daftar semua destinasi wisata
     */
    public function index() {
        $this->requireLogin();

        $destinasi = $this->wisataModel->getAll();

        // Fallback: jika DB kosong, pakai data statis
        if (empty($destinasi)) {
            $destinasi = $this->getDestinasiStatis();
        }

        $this->render('destinasi/index', [
            'pageTitle' => 'Destinasi Wisata | TOUGAR',
            'destinasi' => $destinasi
        ]);
    }

    /**
     * Data statis sebagai fallback
     */
    private function getDestinasiStatis() {
        return [
            ['nama_wisata' => 'Kolam Renang Cipanas',    'deskripsi' => 'Pemandian air panas lengkap dengan kolam, hotel, dan wahana.',              'gambar' => BASE_URL . '/assets/images/cipanas.webp'],
            ['nama_wisata' => 'Situ Bagendit',           'deskripsi' => 'Danau legenda dengan keindahan alam dan cerita rakyat yang memukau.',         'gambar' => BASE_URL . '/assets/images/situ-bagendit.jpg'],
            ['nama_wisata' => 'Pantai Santolo',          'deskripsi' => 'Pantai pasir putih yang indah, cocok untuk menikmati sunset.',                'gambar' => BASE_URL . '/assets/images/santolo.webp'],
            ['nama_wisata' => 'Gunung Cikuray',          'deskripsi' => 'Gunung tertinggi di Garut, favorit para pendaki.',                            'gambar' => BASE_URL . '/assets/images/Gunung-Cikuray.jpeg'],
            ['nama_wisata' => 'Kawah Kamojang',          'deskripsi' => 'Kawasan geothermal dengan asap panas alami dan pemandangan pegunungan.',       'gambar' => BASE_URL . '/assets/images/Kamojang_Hill_Bridge.jpg'],
            ['nama_wisata' => 'Gunung Papandayan',       'deskripsi' => 'Gunung favorit pendaki dengan view indah dan bunga edelweiss.',                'gambar' => BASE_URL . '/assets/images/papandayan.jpeg'],
            ['nama_wisata' => 'Kolam Renang Darajat Pass', 'deskripsi' => 'Kolam air panas alami di dataran tinggi Garut dengan view perbukitan.',     'gambar' => BASE_URL . '/assets/images/Darajat.jpeg'],
            ['nama_wisata' => 'Talaga Bodas',            'deskripsi' => 'Danau kawah vulkanis dengan air berwarna putih kehijauan karena belerang.',    'gambar' => BASE_URL . '/assets/images/Talaga-Bodas.jpeg'],
        ];
    }
}

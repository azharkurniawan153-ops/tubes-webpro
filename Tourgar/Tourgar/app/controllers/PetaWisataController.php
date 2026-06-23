<?php
// app/controllers/PetaWisataController.php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/WisataModel.php';

class PetaWisataController extends BaseController {

    private $wisataModel;

    public function __construct() {
        $this->wisataModel = new WisataModel();
    }

    /**
     * Tampilkan peta wisata interaktif
     */
    public function index() {
        $this->requireLogin();

        // Data koordinat destinasi wisata Garut
        $koordinatWisata = [
            ['nama' => 'Gunung Papandayan',       'lat' => -7.3197, 'lng' => 107.7367, 'deskripsi' => 'Gunung dengan hamparan edelweiss'],
            ['nama' => 'Pantai Santolo',           'lat' => -7.7234, 'lng' => 107.7089, 'deskripsi' => 'Pantai pasir putih eksotis'],
            ['nama' => 'Situ Bagendit',            'lat' => -7.2081, 'lng' => 107.8722, 'deskripsi' => 'Wisata danau terkenal'],
            ['nama' => 'Kawah Kamojang',           'lat' => -7.1266, 'lng' => 107.7929, 'deskripsi' => 'Kawasan geothermal'],
            ['nama' => 'Cipanas Garut',            'lat' => -7.2167, 'lng' => 107.9000, 'deskripsi' => 'Pemandian air panas'],
            ['nama' => 'Darajat Pass',             'lat' => -7.1683, 'lng' => 107.8047, 'deskripsi' => 'Kolam air panas dataran tinggi'],
            ['nama' => 'Talaga Bodas',             'lat' => -7.2433, 'lng' => 107.8567, 'deskripsi' => 'Danau kawah vulkanis'],
            ['nama' => 'Gunung Cikuray',           'lat' => -7.2969, 'lng' => 107.8309, 'deskripsi' => 'Gunung tertinggi di Garut'],
        ];

        $this->render('peta_wisata/index', [
            'pageTitle'       => 'Peta Wisata | TOUGAR',
            'koordinatWisata' => $koordinatWisata
        ]);
    }
}

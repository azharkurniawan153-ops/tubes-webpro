<?php
// app/controllers/BerandaController.php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/WisataModel.php';

class BerandaController extends BaseController {

    private $wisataModel;

    public function __construct() {
        $this->wisataModel = new WisataModel();
    }

    /**
     * Halaman Beranda utama
     */
    public function index() {
        $this->requireLogin();

        // Ambil 3 destinasi populer dari database
        $destinasiPopuler = $this->wisataModel->getPopuler(3);

        $this->render('beranda/index', [
            'pageTitle'        => 'Beranda | TOUGAR',
            'destinasiPopuler' => $destinasiPopuler,
            'namaUser'         => $_SESSION['nama'] ?? 'Wisatawan'
        ]);
    }
}

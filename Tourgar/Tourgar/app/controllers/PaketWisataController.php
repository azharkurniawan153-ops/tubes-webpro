<?php
// app/controllers/PaketWisataController.php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/PaketWisataModel.php';

class PaketWisataController extends BaseController {

    private $paketModel;

    public function __construct() {
        $this->paketModel = new PaketWisataModel();
    }

    /**
     * Daftar semua paket wisata
     */
    public function index() {
        $this->requireLogin();

        $paket = $this->paketModel->getAll();

        $this->render('paket_wisata/index', [
            'pageTitle' => 'Paket Wisata | TOUGAR',
            'paket'     => $paket
        ]);
    }
}

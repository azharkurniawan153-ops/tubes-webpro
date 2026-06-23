<?php
// app/controllers/LandingController.php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/PaketWisataModel.php';

class LandingController extends BaseController {

    private $paketModel;

    public function __construct() {
        $this->paketModel = new PaketWisataModel();
    }

    public function index() {
        // Redirect jika sudah login
        if (isset($_SESSION['user_id'])) {
            if (($_SESSION['role'] ?? '') === 'admin') {
                $this->redirect('/admin');
            } else {
                $this->redirect('/beranda');
            }
        }

        $paketWisata = [];
        try {
            $paketWisata = $this->paketModel->getAll();
        } catch (Exception $e) {
            // DB belum siap, view akan tampilkan data statis
        }

        $pesanSuccess = $_SESSION['pesan_success'] ?? null;
        $pesanError   = $_SESSION['pesan_error']   ?? null;
        $error        = $_SESSION['landing_error'] ?? null;
        unset($_SESSION['pesan_success'], $_SESSION['pesan_error'], $_SESSION['landing_error']);

        $data = [
            'paketWisata'  => $paketWisata,
            'error'        => $error,
            'pesanSuccess' => $pesanSuccess,
            'pesanError'   => $pesanError,
        ];
        extract($data);

        $viewFile = __DIR__ . '/../views/landing/index.php';
        require $viewFile;
    }
}

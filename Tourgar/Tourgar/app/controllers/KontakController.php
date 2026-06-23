<?php
// app/controllers/KontakController.php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/KontakModel.php';

class KontakController extends BaseController {

    private $kontakModel;

    public function __construct() {
        $this->kontakModel = new KontakModel();
    }

    /**
     * Tampilkan halaman kontak
     */
    public function index() {
        $this->requireLogin();
        $this->render('kontak/index', [
            'pageTitle' => 'Kontak | TOUGAR',
            'success'   => null,
            'error'     => null
        ]);
    }

    /**
     * Proses form kontak (kirim pesan)
     */
    public function send() {
        $this->requireLogin();

        $nama    = trim($_POST['nama']    ?? '');
        $email   = trim($_POST['email']   ?? '');
        $telepon = trim($_POST['telepon'] ?? '');
        $pesan   = trim($_POST['pesan']   ?? '');

        if (empty($nama) || empty($email) || empty($pesan)) {
            $this->render('kontak/index', [
                'pageTitle' => 'Kontak | TOUGAR',
                'error'     => 'Semua field harus diisi.',
                'success'   => null
            ]);
            return;
        }

        $this->kontakModel->simpan($nama, $email, $telepon, $pesan);

        $this->render('kontak/index', [
            'pageTitle' => 'Kontak | TOUGAR',
            'success'   => 'Pesan berhasil dikirim! Kami akan segera menghubungi Anda.',
            'error'     => null
        ]);
    }
}

<?php
// app/controllers/PesanController.php
// Menangani pemesanan paket wisata oleh pengunjung (publik, tidak perlu login)

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/PesananModel.php';

class PesanController extends BaseController {

    private $pesananModel;

    public function __construct() {
        $this->pesananModel = new PesananModel();
    }

    /**
     * Proses POST form pemesanan dari landing page / paket wisata
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/');
            return;
        }

        $namaPemesan  = trim($_POST['nama_pemesan'] ?? '');
        $noHp         = trim($_POST['no_hp'] ?? '');
        $idPaket      = (int)($_POST['id_paket'] ?? 0);
        $namaPaket    = trim($_POST['nama_paket'] ?? '');
        $hargaPaket   = (int)($_POST['harga_paket'] ?? 0);
        $tanggalPesan = trim($_POST['tanggal_pesan'] ?? '');
        $jumlahOrang  = (int)($_POST['jumlah_orang'] ?? 1);
        $catatan      = trim($_POST['catatan'] ?? '');

        if (empty($namaPemesan) || empty($noHp) || empty($namaPaket) || empty($tanggalPesan)) {
            $_SESSION['pesan_error'] = 'Data pemesanan tidak lengkap. Silakan coba lagi.';
            $this->redirect('/');
            return;
        }

        $this->pesananModel->insert([
            'nama_pemesan'  => $namaPemesan,
            'no_hp'         => $noHp,
            'id_paket'      => $idPaket ?: null,
            'nama_paket'    => $namaPaket,
            'harga_paket'   => $hargaPaket,
            'tanggal_pesan' => $tanggalPesan,
            'jumlah_orang'  => $jumlahOrang,
            'catatan'       => $catatan,
            'status'        => 'pending',
            'user_id'       => $_SESSION['user_id'] ?? null,
        ]);

        $_SESSION['pesan_success'] = "Pesanan Anda untuk paket \"$namaPaket\" berhasil dikirim! Tim kami akan menghubungi Anda segera.";
        $this->redirect('/');
    }
}

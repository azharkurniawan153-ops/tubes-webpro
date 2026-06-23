<?php
// app/controllers/AdminController.php
// Controller utama panel admin TOUGAR.
// Menangani: Dashboard, Kelola Destinasi (wisata), Kelola Paket Wisata,
// Kelola Peta, Kelola Laporan, Pesan Kontak, Kelola Slider, Kelola User.

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/WisataModel.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/LaporanModel.php';
require_once __DIR__ . '/../models/PaketWisataModel.php';
require_once __DIR__ . '/../models/PetaWisataModel.php';
require_once __DIR__ . '/../models/KontakModel.php';
require_once __DIR__ . '/../models/SliderModel.php';
require_once __DIR__ . '/../models/PesananModel.php';

class AdminController extends BaseController {

    private $wisataModel;
    private $userModel;
    private $laporanModel;
    private $paketModel;
    private $petaModel;
    private $kontakModel;
    private $sliderModel;
    private $pesananModel;

    public function __construct() {
        $this->wisataModel  = new WisataModel();
        $this->userModel    = new UserModel();
        $this->laporanModel = new LaporanModel();
        $this->paketModel   = new PaketWisataModel();
        $this->petaModel    = new PetaWisataModel();
        $this->kontakModel  = new KontakModel();
        $this->sliderModel  = new SliderModel();
        $this->pesananModel = new PesananModel();
    }

    // ============================================================
    // DASHBOARD
    // ============================================================
    public function index() {
        $this->requireAdmin();

        $totalWisata   = count($this->wisataModel->getAll());
        $totalPaket    = count($this->paketModel->getAll());
        $totalLaporan  = count($this->laporanModel->getAll());
        $totalKontak   = count($this->kontakModel->getAll());
        $totalPeta     = count($this->petaModel->getAll());
        $totalSlider   = count($this->sliderModel->getAll());
        $totalUser     = count($this->userModel->getAll());
        $totalPesanan  = $this->pesananModel->countAll();
        $pesananPending = $this->pesananModel->countPending();
        $pesananTerbaru = array_slice($this->pesananModel->getAll(), 0, 5);

        $this->render('admin/dashboard', [
            'pageTitle'      => 'Dashboard | Admin TOUGAR',
            'activeMenu'     => 'dashboard',
            'totalWisata'    => $totalWisata,
            'totalPaket'     => $totalPaket,
            'totalLaporan'   => $totalLaporan,
            'totalKontak'    => $totalKontak,
            'totalPeta'      => $totalPeta,
            'totalSlider'    => $totalSlider,
            'totalUser'      => $totalUser,
            'totalPesanan'   => $totalPesanan,
            'pesananPending' => $pesananPending,
            'pesananTerbaru' => $pesananTerbaru,
        ], 'admin');
    }

    // ============================================================
    // KELOLA DESTINASI (tabel: wisata)
    // ============================================================
    public function wisata() {
        $this->requireAdmin();
        $daftarWisata = $this->wisataModel->getAll();
        $this->render('admin/wisata', [
            'pageTitle'    => 'Kelola Destinasi | Admin TOUGAR',
            'activeMenu'   => 'wisata',
            'daftarWisata' => $daftarWisata
        ], 'admin');
    }

    public function tambahWisata() {
        $this->requireAdmin();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $namaWisata = trim($_POST['nama_wisata'] ?? '');
            $lokasi     = trim($_POST['lokasi'] ?? '');

            if (empty($namaWisata) || empty($lokasi)) {
                $error = 'Nama wisata dan lokasi wajib diisi.';
            } else {
                $this->wisataModel->insert([
                    'nama_wisata'  => $namaWisata,
                    'lokasi'       => $lokasi,
                    'kategori'     => trim($_POST['kategori'] ?? ''),
                    'deskripsi'    => trim($_POST['deskripsi'] ?? ''),
                    'harga_tiket'  => (int)($_POST['harga_tiket'] ?? 0),
                    'gambar'       => trim($_POST['gambar'] ?? '')
                ]);
                $this->redirect('/admin/wisata');
                return;
            }
        }

        $this->render('admin/tambah_wisata', [
            'pageTitle'  => 'Tambah Destinasi | Admin TOUGAR',
            'activeMenu' => 'wisata',
            'error'      => $error
        ], 'admin');
    }

    public function editWisata() {
        $this->requireAdmin();
        $id    = (int)($_GET['id'] ?? 0);
        $error = null;
        $data  = $this->wisataModel->getById($id);

        if (!$data) {
            $this->redirect('/admin/wisata');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $namaWisata = trim($_POST['nama_wisata'] ?? '');
            $lokasi     = trim($_POST['lokasi'] ?? '');

            if (empty($namaWisata) || empty($lokasi)) {
                $error = 'Nama wisata dan lokasi wajib diisi.';
                $data  = array_merge($data, $_POST);
            } else {
                $this->wisataModel->update($id, [
                    'nama_wisata'  => $namaWisata,
                    'lokasi'       => $lokasi,
                    'kategori'     => trim($_POST['kategori'] ?? ''),
                    'deskripsi'    => trim($_POST['deskripsi'] ?? ''),
                    'harga_tiket'  => (int)($_POST['harga_tiket'] ?? 0),
                    'gambar'       => trim($_POST['gambar'] ?? '')
                ]);
                $this->redirect('/admin/wisata');
                return;
            }
        }

        $this->render('admin/edit_wisata', [
            'pageTitle'  => 'Edit Destinasi | Admin TOUGAR',
            'activeMenu' => 'wisata',
            'error'      => $error,
            'data'       => $data
        ], 'admin');
    }

    public function hapusWisata() {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->wisataModel->delete($id);
        }
        $this->redirect('/admin/wisata');
    }

    // ============================================================
    // KELOLA PAKET WISATA (tabel: paket_wisata)
    // ============================================================
    public function paket() {
        $this->requireAdmin();
        $daftarPaket = $this->paketModel->getAll();
        $this->render('admin/paket', [
            'pageTitle'    => 'Kelola Paket Wisata | Admin TOUGAR',
            'activeMenu'   => 'paket',
            'daftarPaket'  => $daftarPaket
        ], 'admin');
    }

    public function tambahPaket() {
        $this->requireAdmin();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $namaPaket = trim($_POST['nama_paket'] ?? '');

            if (empty($namaPaket)) {
                $error = 'Nama paket wajib diisi.';
            } else {
                $this->paketModel->insert([
                    'nama_paket' => $namaPaket,
                    'durasi'     => trim($_POST['durasi'] ?? ''),
                    'harga'      => (int)($_POST['harga'] ?? 0),
                    'destinasi'  => trim($_POST['destinasi'] ?? ''),
                    'fasilitas'  => trim($_POST['fasilitas'] ?? ''),
                    'status'     => ($_POST['status'] ?? 'active') === 'inactive' ? 'inactive' : 'active'
                ]);
                $this->redirect('/admin/paket');
                return;
            }
        }

        $this->render('admin/tambah_paket', [
            'pageTitle'  => 'Tambah Paket Wisata | Admin TOUGAR',
            'activeMenu' => 'paket',
            'error'      => $error
        ], 'admin');
    }

    public function editPaket() {
        $this->requireAdmin();
        $id    = (int)($_GET['id'] ?? 0);
        $error = null;
        $data  = $this->paketModel->getById($id);

        if (!$data) {
            $this->redirect('/admin/paket');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $namaPaket = trim($_POST['nama_paket'] ?? '');

            if (empty($namaPaket)) {
                $error = 'Nama paket wajib diisi.';
                $data  = array_merge($data, $_POST);
            } else {
                $this->paketModel->update($id, [
                    'nama_paket' => $namaPaket,
                    'durasi'     => trim($_POST['durasi'] ?? ''),
                    'harga'      => (int)($_POST['harga'] ?? 0),
                    'destinasi'  => trim($_POST['destinasi'] ?? ''),
                    'fasilitas'  => trim($_POST['fasilitas'] ?? ''),
                    'status'     => ($_POST['status'] ?? 'active') === 'inactive' ? 'inactive' : 'active'
                ]);
                $this->redirect('/admin/paket');
                return;
            }
        }

        $this->render('admin/edit_paket', [
            'pageTitle'  => 'Edit Paket Wisata | Admin TOUGAR',
            'activeMenu' => 'paket',
            'error'      => $error,
            'data'       => $data
        ], 'admin');
    }

    public function hapusPaket() {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->paketModel->delete($id);
        }
        $this->redirect('/admin/paket');
    }

    // ============================================================
    // KELOLA PETA (tabel: peta_wisata)
    // ============================================================
    public function peta() {
        $this->requireAdmin();
        $daftarPeta = $this->petaModel->getAll();
        $this->render('admin/peta', [
            'pageTitle'   => 'Kelola Peta | Admin TOUGAR',
            'activeMenu'  => 'peta',
            'daftarPeta'  => $daftarPeta
        ], 'admin');
    }

    public function tambahPeta() {
        $this->requireAdmin();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = trim($_POST['nama_lokasi'] ?? '');
            $lat  = trim($_POST['latitude'] ?? '');
            $lng  = trim($_POST['longitude'] ?? '');

            if (empty($nama) || $lat === '' || $lng === '') {
                $error = 'Nama lokasi, latitude, dan longitude wajib diisi.';
            } else {
                $this->petaModel->insert([
                    'nama_lokasi' => $nama,
                    'latitude'    => $lat,
                    'longitude'   => $lng,
                    'kategori'    => trim($_POST['kategori'] ?? ''),
                    'deskripsi'   => trim($_POST['deskripsi'] ?? '')
                ]);
                $this->redirect('/admin/peta');
                return;
            }
        }

        $this->render('admin/tambah_peta', [
            'pageTitle'  => 'Tambah Lokasi Peta | Admin TOUGAR',
            'activeMenu' => 'peta',
            'error'      => $error
        ], 'admin');
    }

    public function editPeta() {
        $this->requireAdmin();
        $id    = (int)($_GET['id'] ?? 0);
        $error = null;
        $data  = $this->petaModel->getById($id);

        if (!$data) {
            $this->redirect('/admin/peta');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = trim($_POST['nama_lokasi'] ?? '');
            $lat  = trim($_POST['latitude'] ?? '');
            $lng  = trim($_POST['longitude'] ?? '');

            if (empty($nama) || $lat === '' || $lng === '') {
                $error = 'Nama lokasi, latitude, dan longitude wajib diisi.';
                $data  = array_merge($data, $_POST);
            } else {
                $this->petaModel->update($id, [
                    'nama_lokasi' => $nama,
                    'latitude'    => $lat,
                    'longitude'   => $lng,
                    'kategori'    => trim($_POST['kategori'] ?? ''),
                    'deskripsi'   => trim($_POST['deskripsi'] ?? '')
                ]);
                $this->redirect('/admin/peta');
                return;
            }
        }

        $this->render('admin/edit_peta', [
            'pageTitle'  => 'Edit Lokasi Peta | Admin TOUGAR',
            'activeMenu' => 'peta',
            'error'      => $error,
            'data'       => $data
        ], 'admin');
    }

    public function hapusPeta() {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->petaModel->delete($id);
        }
        $this->redirect('/admin/peta');
    }

    // ============================================================
    // KELOLA LAPORAN (tabel: laporan_kunjungan)
    // ============================================================
    public function laporan() {
        $this->requireAdmin();
        $daftarLaporan = $this->laporanModel->getAll();
        $this->render('admin/laporan', [
            'pageTitle'      => 'Kelola Laporan | Admin TOUGAR',
            'activeMenu'     => 'laporan',
            'daftarLaporan'  => $daftarLaporan
        ], 'admin');
    }

    public function hapusLaporan() {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->laporanModel->delete($id);
        }
        $this->redirect('/admin/laporan');
    }

    // ============================================================
    // PESAN KONTAK (tabel: kontak) — hanya lihat & hapus
    // ============================================================
    public function kontak() {
        $this->requireAdmin();
        $daftarKontak = $this->kontakModel->getAllTerbaru();
        $this->render('admin/kontak', [
            'pageTitle'     => 'Pesan Kontak | Admin TOUGAR',
            'activeMenu'    => 'kontak',
            'daftarKontak'  => $daftarKontak
        ], 'admin');
    }

    public function hapusKontak() {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->kontakModel->delete($id);
        }
        $this->redirect('/admin/kontak');
    }

    // ============================================================
    // KELOLA SLIDER (tabel: slider)
    // ============================================================
    public function slider() {
        $this->requireAdmin();
        $daftarSlider = $this->sliderModel->getAllUrut();
        $this->render('admin/slider', [
            'pageTitle'     => 'Kelola Slider | Admin TOUGAR',
            'activeMenu'    => 'slider',
            'daftarSlider'  => $daftarSlider
        ], 'admin');
    }

    public function tambahSlider() {
        $this->requireAdmin();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul  = trim($_POST['judul'] ?? '');
            $gambar = trim($_POST['gambar'] ?? '');

            if (empty($judul) || empty($gambar)) {
                $error = 'Judul dan gambar wajib diisi.';
            } else {
                $this->sliderModel->insert([
                    'judul'  => $judul,
                    'gambar' => $gambar,
                    'urutan' => (int)($_POST['urutan'] ?? 0)
                ]);
                $this->redirect('/admin/slider');
                return;
            }
        }

        $this->render('admin/tambah_slider', [
            'pageTitle'  => 'Tambah Slide | Admin TOUGAR',
            'activeMenu' => 'slider',
            'error'      => $error
        ], 'admin');
    }

    public function editSlider() {
        $this->requireAdmin();
        $id    = (int)($_GET['id'] ?? 0);
        $error = null;
        $data  = $this->sliderModel->getById($id);

        if (!$data) {
            $this->redirect('/admin/slider');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul  = trim($_POST['judul'] ?? '');
            $gambar = trim($_POST['gambar'] ?? '');

            if (empty($judul) || empty($gambar)) {
                $error = 'Judul dan gambar wajib diisi.';
                $data  = array_merge($data, $_POST);
            } else {
                $this->sliderModel->update($id, [
                    'judul'  => $judul,
                    'gambar' => $gambar,
                    'urutan' => (int)($_POST['urutan'] ?? 0)
                ]);
                $this->redirect('/admin/slider');
                return;
            }
        }

        $this->render('admin/edit_slider', [
            'pageTitle'  => 'Edit Slide | Admin TOUGAR',
            'activeMenu' => 'slider',
            'error'      => $error,
            'data'       => $data
        ], 'admin');
    }

    public function hapusSlider() {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->sliderModel->delete($id);
        }
        $this->redirect('/admin/slider');
    }

    // ============================================================
    // KELOLA USER (tabel: users)
    // ============================================================
    public function users() {
        $this->requireAdmin();
        $daftarUser = $this->userModel->getAll();
        $this->render('admin/users', [
            'pageTitle'    => 'Kelola User | Admin TOUGAR',
            'activeMenu'   => 'users',
            'daftarUser'   => $daftarUser
        ], 'admin');
    }

    public function tambahUser() {
        $this->requireAdmin();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama     = trim($_POST['nama'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $role     = ($_POST['role'] ?? 'wisatawan') === 'admin' ? 'admin' : 'wisatawan';
            $status   = ($_POST['status'] ?? 'active') === 'inactive' ? 'inactive' : 'active';

            if (empty($nama) || empty($email) || empty($username) || empty($password)) {
                $error = 'Semua field wajib diisi.';
            } elseif ($this->userModel->findByUsername($username)) {
                $error = 'Username sudah digunakan.';
            } else {
                $this->userModel->insert([
                    'nama'     => $nama,
                    'email'    => $email,
                    'username' => $username,
                    'password' => md5($password),
                    'role'     => $role,
                    'status'   => $status
                ]);
                $this->redirect('/admin/users');
                return;
            }
        }

        $this->render('admin/tambah_user', [
            'pageTitle'  => 'Tambah User | Admin TOUGAR',
            'activeMenu' => 'users',
            'error'      => $error
        ], 'admin');
    }

    public function editUser() {
        $this->requireAdmin();
        $id    = (int)($_GET['id'] ?? 0);
        $error = null;
        $data  = $this->userModel->getById($id);

        if (!$data) {
            $this->redirect('/admin/users');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama     = trim($_POST['nama'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $role     = ($_POST['role'] ?? 'wisatawan') === 'admin' ? 'admin' : 'wisatawan';
            $status   = ($_POST['status'] ?? 'active') === 'inactive' ? 'inactive' : 'active';

            if (empty($nama) || empty($email) || empty($username)) {
                $error = 'Nama, email, dan username wajib diisi.';
                $data  = array_merge($data, $_POST);
            } else {
                $updateData = [
                    'nama'     => $nama,
                    'email'    => $email,
                    'username' => $username,
                    'role'     => $role,
                    'status'   => $status
                ];

                // Hanya update password jika diisi (boleh dikosongkan saat edit)
                $passwordBaru = trim($_POST['password'] ?? '');
                if (!empty($passwordBaru)) {
                    $updateData['password'] = md5($passwordBaru);
                }

                $this->userModel->update($id, $updateData);
                $this->redirect('/admin/users');
                return;
            }
        }

        $this->render('admin/edit_user', [
            'pageTitle'  => 'Edit User | Admin TOUGAR',
            'activeMenu' => 'users',
            'error'      => $error,
            'data'       => $data
        ], 'admin');
    }

    public function hapusUser() {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);

        // Mencegah admin menghapus akunnya sendiri yang sedang login
        if ($id > 0 && $id !== (int)($_SESSION['user_id'] ?? 0)) {
            $this->userModel->delete($id);
        }
        $this->redirect('/admin/users');
    }

    // ============================================================
    // KELOLA PESANAN PAKET WISATA
    // ============================================================
    public function pesanan() {
        $this->requireAdmin();
        $daftarPesanan = $this->pesananModel->getAll();
        $this->render('admin/pesanan', [
            'pageTitle'     => 'Kelola Pesanan | Admin TOUGAR',
            'activeMenu'    => 'pesanan',
            'daftarPesanan' => $daftarPesanan,
        ], 'admin');
    }

    public function updateStatusPesanan() {
        $this->requireAdmin();
        $id     = (int)($_GET['id'] ?? 0);
        $status = trim($_GET['status'] ?? '');
        $allowed = ['pending', 'konfirmasi', 'selesai', 'batal'];
        if ($id > 0 && in_array($status, $allowed)) {
            $this->pesananModel->updateStatus($id, $status);
            $_SESSION['admin_success'] = 'Status pesanan berhasil diperbarui.';
        }
        $this->redirect('/admin/pesanan');
    }

    public function hapusPesanan() {
        $this->requireAdmin();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->pesananModel->delete($id);
            $_SESSION['admin_success'] = 'Pesanan berhasil dihapus.';
        }
        $this->redirect('/admin/pesanan');
    }
}

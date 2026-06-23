<?php
// app/controllers/AuthController.php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController extends BaseController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    /**
     * Tampilkan halaman login
     * Karena login ada di landing page, redirect ke sana
     */
    public function showLogin() {
        // Jika sudah login, redirect ke beranda
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/beranda');
        }
        // Login terintegrasi di landing page
        $this->redirect('/');
    }

    /**
     * Proses login dari form
     */
    public function login() {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($username) || empty($password)) {
            $_SESSION['landing_error'] = 'Username dan password harus diisi.';
            $this->redirect('/');
            return;
        }

        $user = $this->userModel->login($username, $password);

        if ($user) {
            // Simpan data user ke session
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama']     = $user['nama'];
            $_SESSION['role']     = $user['role'];

            // Arahkan berdasarkan role
            if ($user['role'] === 'admin') {
                $this->redirect('/admin');
            } else {
                $this->redirect('/beranda');
            }
        } else {
            $_SESSION['landing_error'] = 'Username atau password salah.';
            $this->redirect('/');
        }
    }

    /**
     * Logout
     */
    public function logout() {
        session_destroy();
        $this->redirect('/');
    }

    /**
     * Tampilkan halaman daftar/register
     * Karena register ada di landing page, redirect ke sana
     */
    public function showRegister() {
        // Jika sudah login, redirect ke beranda
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/beranda');
        }
        // Register terintegrasi di landing page
        $this->redirect('/');
    }

    /**
     * Proses daftar akun baru dari form register
     */
    public function register() {
        $nama     = trim($_POST['nama'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $konfirmasi = trim($_POST['konfirmasi_password'] ?? '');

        // Validasi dasar
        if (empty($nama) || empty($email) || empty($username) || empty($password)) {
            $_SESSION['landing_error'] = 'Semua field wajib diisi.';
            $this->redirect('/');
            return;
        }

        if ($password !== $konfirmasi) {
            $_SESSION['landing_error'] = 'Konfirmasi password tidak cocok.';
            $this->redirect('/');
            return;
        }

        $result = $this->userModel->register($nama, $email, $username, $password);

        if ($result['success']) {
            // Daftar berhasil → kembali ke landing page (login ada di sana)
            $_SESSION['register_success'] = 'Pendaftaran berhasil! Silakan login.';
            $this->redirect('/');
        } else {
            $_SESSION['landing_error'] = $result['message'];
            $this->redirect('/');
        }
    }

    /**
     * Tampilkan form lupa password (langkah 1: verifikasi username + email)
     */
    public function showForgot() {
        $this->render('login/forgot', ['error' => null], 'auth');
    }

    /**
     * Proses verifikasi username + email.
     * Project ini belum punya mail server, jadi sebagai gantinya:
     * jika username dan email cocok, user langsung diizinkan
     * mengatur password baru tanpa perlu link/token dari email.
     */
    public function forgot() {
        $username = trim($_POST['username'] ?? '');
        $email    = trim($_POST['email'] ?? '');

        if (empty($username) || empty($email)) {
            $this->render('login/forgot', ['error' => 'Username dan email harus diisi.'], 'auth');
            return;
        }

        $user = $this->userModel->verifyUsernameEmail($username, $email);

        if (!$user) {
            $this->render('login/forgot', ['error' => 'Username dan email tidak cocok dengan data kami.'], 'auth');
            return;
        }

        // Simpan id user yang sudah terverifikasi di session sementara,
        // hanya supaya halaman reset tahu siapa yang sedang reset password.
        $_SESSION['reset_user_id'] = $user['id'];
        $this->redirect('/reset-password');
    }

    /**
     * Tampilkan form set password baru.
     * Hanya bisa diakses setelah verifikasi username+email berhasil.
     */
    public function showReset() {
        if (empty($_SESSION['reset_user_id'])) {
            $this->redirect('/forgot-password');
        }
        $this->render('login/reset', ['error' => null], 'auth');
    }

    /**
     * Proses simpan password baru.
     */
    public function resetPassword() {
        if (empty($_SESSION['reset_user_id'])) {
            $this->redirect('/forgot-password');
        }

        $password   = trim($_POST['password'] ?? '');
        $konfirmasi = trim($_POST['konfirmasi_password'] ?? '');

        if (empty($password) || empty($konfirmasi)) {
            $this->render('login/reset', ['error' => 'Password baru harus diisi.'], 'auth');
            return;
        }

        if ($password !== $konfirmasi) {
            $this->render('login/reset', ['error' => 'Konfirmasi password tidak cocok.'], 'auth');
            return;
        }

        $this->userModel->updatePassword($_SESSION['reset_user_id'], $password);

        // Hapus session sementara setelah selesai dipakai
        unset($_SESSION['reset_user_id']);

        $_SESSION['register_success'] = 'Password berhasil diubah! Silakan login dengan password baru.';
        $this->redirect('/');
    }
}

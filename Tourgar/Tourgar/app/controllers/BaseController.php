<?php
// app/controllers/BaseController.php
// Controller dasar yang diwarisi semua controller

class BaseController {

    /**
     * Render view dengan layout
     * @param string $view   Path view relatif ke app/views/ (contoh: 'beranda/index')
     * @param array  $data   Data yang dikirim ke view
     * @param string $layout Layout yang digunakan (default: 'main')
     */
    protected function render($view, $data = [], $layout = 'main') {
        // Ekstrak data agar bisa dipakai langsung di view
        extract($data);

        // Tentukan path view dan layout
        $viewFile   = __DIR__ . '/../views/' . $view . '.php';
        $layoutFile = __DIR__ . '/../views/layouts/' . $layout . '.php';

        if (!file_exists($viewFile)) {
            die("View tidak ditemukan: $view");
        }

        // Tangkap output view ke dalam buffer
        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        // Render layout dengan konten
        if (file_exists($layoutFile)) {
            require $layoutFile;
        } else {
            echo $content;
        }
    }

    /**
     * Redirect ke URL lain.
     * Jika $url berupa path absolut ("/sesuatu"), otomatis diawali BASE_URL
     * supaya redirect tetap benar walau aplikasi diletakkan di subfolder
     * (contoh: /Tourgar/public).
     */
    protected function redirect($url) {
        if (strpos($url, '/') === 0 && defined('BASE_URL')) {
            $url = BASE_URL . $url;
        }
        header("Location: $url");
        exit;
    }

    /**
     * Cek apakah user sudah login
     */
    protected function requireLogin() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }
    }

    /**
     * Cek apakah user adalah admin
     */
    protected function requireAdmin() {
        $this->requireLogin();
        if ($_SESSION['role'] !== 'admin') {
            $this->redirect('/');
        }
    }
}

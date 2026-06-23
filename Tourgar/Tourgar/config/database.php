<?php
// config/database.php
// Konfigurasi koneksi database

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'tougar');

function getDB() {
    static $conn = null;
    if ($conn === null) {
        // mysqli_report dimatikan dulu supaya exception bawaan PHP 8+
        // tidak langsung tampil sebagai Fatal Error mentah dengan stack trace.
        mysqli_report(MYSQLI_REPORT_OFF);

        $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$conn || $conn->connect_error) {
            http_response_code(500);
            die(
                "<h2>Tidak bisa terhubung ke database</h2>" .
                "<p>Pastikan service <b>MySQL</b> di XAMPP sudah di-Start (cek XAMPP Control Panel), " .
                "dan database <b>" . DB_NAME . "</b> sudah dibuat (import file database/tougar.sql lewat phpMyAdmin).</p>" .
                "<p><i>Detail teknis: " . htmlspecialchars($conn->connect_error ?? 'koneksi ke MySQL ditolak') . "</i></p>"
            );
        }
        $conn->set_charset("utf8");
    }
    return $conn;
}

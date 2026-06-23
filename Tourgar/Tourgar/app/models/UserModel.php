<?php
// app/models/UserModel.php

require_once __DIR__ . '/BaseModel.php';

class UserModel extends BaseModel {
    protected $table = 'users';

    /**
     * Cari user berdasarkan username
     */
    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Validasi login
     * Mengembalikan data user jika berhasil, false jika gagal
     */
    public function login($username, $password) {
        $user = $this->findByUsername($username);
        if ($user && $user['password'] === md5($password)) {
            return $user;
        }
        return false;
    }

    /**
     * Daftar user baru
     */
    public function register($nama, $email, $username, $password, $role = 'wisatawan') {
        // Cek apakah username sudah ada
        if ($this->findByUsername($username)) {
            return ['success' => false, 'message' => 'Username sudah digunakan.'];
        }

        $hashedPassword = md5($password);
        $stmt = $this->db->prepare(
            "INSERT INTO users (nama, email, username, password, role) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('sssss', $nama, $email, $username, $hashedPassword, $role);

        if ($stmt->execute()) {
            return ['success' => true];
        }
        return ['success' => false, 'message' => 'Gagal mendaftar.'];
    }

    /**
     * Verifikasi kecocokan username + email.
     * Dipakai untuk fitur "Lupa Password" sebagai pengganti kirim email reset,
     * karena project ini belum punya konfigurasi SMTP/mail server.
     * Mengembalikan data user jika cocok, false jika tidak.
     */
    public function verifyUsernameEmail($username, $email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? AND email = ? LIMIT 1");
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        return $user ?: false;
    }

    /**
     * Update password user berdasarkan id.
     */
    public function updatePassword($id, $newPassword) {
        $hashedPassword = md5($newPassword);
        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param('si', $hashedPassword, $id);
        return $stmt->execute();
    }
}

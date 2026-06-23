<?php
// app/models/BaseModel.php
// Model dasar dengan fungsi query umum

class BaseModel {
    protected $db;
    protected $table;

    // Nama kolom primary key tabel ini. Default 'id', tapi beberapa tabel
    // (wisata -> id_wisata, paket_wisata -> id_paket, dst) pakai nama lain,
    // jadi setiap model anak bisa override properti ini.
    protected $primaryKey = 'id';

    public function __construct() {
        $this->db = getDB();
    }

    /**
     * Ambil semua data dari tabel
     */
    public function getAll() {
        $result = $this->db->query("SELECT * FROM {$this->table}");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /**
     * Ambil data berdasarkan ID
     */
    public function getById($id) {
        $id   = (int)$id;
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Simpan data baru
     */
    public function insert($data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $stmt = $this->db->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");
        $types = str_repeat('s', count($data));
        $stmt->bind_param($types, ...array_values($data));
        return $stmt->execute();
    }

    /**
     * Update data berdasarkan ID
     */
    public function update($id, $data) {
        $set = implode(' = ?, ', array_keys($data)) . ' = ?';
        $id  = (int)$id;
        $stmt = $this->db->prepare("UPDATE {$this->table} SET $set WHERE {$this->primaryKey} = ?");
        $types = str_repeat('s', count($data)) . 'i';
        $stmt->bind_param($types, ...array_merge(array_values($data), [$id]));
        return $stmt->execute();
    }

    /**
     * Hapus data berdasarkan ID
     */
    public function delete($id) {
        $id   = (int)$id;
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}

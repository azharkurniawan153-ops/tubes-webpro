<?php
// app/models/SliderModel.php

require_once __DIR__ . '/BaseModel.php';

class SliderModel extends BaseModel {
    protected $table = 'slider';
    protected $primaryKey = 'id_slider';

    /**
     * Ambil semua slide diurutkan berdasarkan kolom `urutan`
     */
    public function getAllUrut() {
        $result = $this->db->query("SELECT * FROM slider ORDER BY urutan ASC, id_slider ASC");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
}

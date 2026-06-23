<?php
// app/models/PetaWisataModel.php

require_once __DIR__ . '/BaseModel.php';

class PetaWisataModel extends BaseModel {
    protected $table = 'peta_wisata';
    protected $primaryKey = 'id_peta';
}

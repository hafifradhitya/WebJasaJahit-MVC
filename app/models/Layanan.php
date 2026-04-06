<?php
require_once __DIR__ . '/../core/Database.php';

class Layanan {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getActiveLayananWithKategori(): array {
        $this->db->query("
            SELECT 
                layanan.id_layanan,
                layanan.nama_layanan,  
                layanan.deskripsi,
                layanan.foto,
                layanan.harga_mulai,
                layanan.estimasi_hari,
                layanan.status,
                layanan.id_kategori,
                kategori.nama_kategori
            FROM layanan
            JOIN kategori 
                ON layanan.id_kategori = kategori.id_kategori
            WHERE layanan.status = 'aktif'
            ORDER BY layanan.id_layanan DESC
        ");
        return $this->db->resultSet();
    }
}

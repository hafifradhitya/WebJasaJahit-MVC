<?php
require_once __DIR__ . '/../core/Database.php';

class Kategori {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAllKategori(): array {
        $this->db->query("SELECT id_kategori, nama_kategori FROM kategori");
        return $this->db->resultSet();
    }
}

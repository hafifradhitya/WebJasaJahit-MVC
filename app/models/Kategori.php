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

    public function getKategoriById($id_kategori) {
        $this->db->query("SELECT * FROM kategori WHERE id_kategori = :id_kategori");
        $this->db->bind('id_kategori', $id_kategori);
        return $this->db->single();
    }

    public function insert($data) {
        $this->db->query("INSERT INTO kategori (nama_kategori) VALUES (:nama_kategori)");
        $this->db->bind('nama_kategori', $data['nama_kategori']);
        $this->db->execute();
    }

    public function update($data) {
        $this->db->query("UPDATE kategori SET nama_kategori = :nama_kategori WHERE id_kategori = :id_kategori");
        $this->db->bind('nama_kategori', $data['nama_kategori']);
        $this->db->bind('id_kategori', $data['id_kategori']);
        $this->db->execute();
    }

    public function delete($id_kategori) {
        $this->db->query("DELETE FROM kategori WHERE id_kategori = :id_kategori");
        $this->db->bind('id_kategori', $id_kategori);
        $this->db->execute();
    }
}

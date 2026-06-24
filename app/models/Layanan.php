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

    public function getAllLayanan(): array {
        $this->db->query("SELECT id_layanan, nama_layanan, foto, harga_mulai, estimasi_hari, status, id_kategori FROM layanan");
        return $this->db->resultSet();
    }

    public function getActiveLayanan(): array {
        $this->db->query("SELECT id_layanan, nama_layanan, harga_mulai, estimasi_hari FROM layanan WHERE LOWER(status) = 'aktif' ORDER BY nama_layanan ASC");
        return $this->db->resultSet();
    }

    public function getLayananById($id_layanan) {
        $this->db->query("SELECT * FROM layanan WHERE id_layanan = :id_layanan");
        $this->db->bind('id_layanan', $id_layanan);
        return $this->db->single();
    }

    public function getActiveLayananDetailById($id_layanan) {
        $this->db->query("
            SELECT 
                layanan.*,
                kategori.nama_kategori
            FROM layanan
            JOIN kategori ON layanan.id_kategori = kategori.id_kategori
            WHERE layanan.id_layanan = :id_layanan AND layanan.status = 'aktif'
            LIMIT 1
        ");
        $this->db->bind('id_layanan', $id_layanan);
        return $this->db->single();
    }

    public function insert($data) {
        $this->db->query("INSERT INTO layanan (nama_layanan, deskripsi, harga_mulai, estimasi_hari, status, id_kategori, foto) VALUES (:nama_layanan, :deskripsi, :harga_mulai, :estimasi_hari, :status, :id_kategori, :foto)");
        $this->db->bind('nama_layanan', $data['nama_layanan']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('harga_mulai', $data['harga_mulai']);
        $this->db->bind('estimasi_hari', $data['estimasi_hari']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('id_kategori', $data['id_kategori']);
        $this->db->bind('foto', $data['foto']);
        $this->db->execute();
    }

    public function update($data) {
        $this->db->query("UPDATE layanan SET nama_layanan = :nama_layanan, deskripsi = :deskripsi, harga_mulai = :harga_mulai, estimasi_hari = :estimasi_hari, status = :status, id_kategori = :id_kategori, foto = :foto WHERE id_layanan = :id_layanan");
        $this->db->bind('nama_layanan', $data['nama_layanan']);
        $this->db->bind('deskripsi', $data['deskripsi']);
        $this->db->bind('harga_mulai', $data['harga_mulai']);
        $this->db->bind('estimasi_hari', $data['estimasi_hari']);
        $this->db->bind('status', $data['status']);
        $this->db->bind('id_kategori', $data['id_kategori']);
        $this->db->bind('foto', $data['foto']);
        $this->db->bind('id_layanan', $data['id_layanan']);
        $this->db->execute();
    }

    public function delete($id_layanan) {
        $this->db->query("DELETE FROM layanan WHERE id_layanan = :id_layanan");
        $this->db->bind('id_layanan', $id_layanan);
        $this->db->execute();
    }
}

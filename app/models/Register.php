<?php
require_once __DIR__ . '/../core/Database.php';

class Register {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function checkPhoneExists(string $no_telepon) {
        $this->db->query("SELECT no_telepon FROM users WHERE no_telepon = :no_telepon");
        $this->db->bind(':no_telepon', $no_telepon);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function getLastUserCode(string $prefix) {
        $this->db->query("SELECT kode_user FROM users WHERE kode_user LIKE :prefix ORDER BY kode_user DESC LIMIT 1");
        $this->db->bind(':prefix', $prefix . '%');
        return $this->db->single();
    }

    public function insertUser(array $data) {
        $this->db->query("
            INSERT INTO users 
            (kode_user, nama_lengkap, email, no_telepon, password, kode_aktivasi, role, status, foto)
            VALUES
            (:kode_user, :nama_lengkap, :email, :no_telepon, :password, :kode_aktivasi, :role, :status, :foto)
        ");

        $this->db->bind(':kode_user', $data['kode_user']);
        $this->db->bind(':nama_lengkap', $data['nama_lengkap']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':no_telepon', $data['no_telepon']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':kode_aktivasi', $data['kode_aktivasi']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':foto', $data['foto']);

        return $this->db->execute();
    }
}

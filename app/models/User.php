<?php
require_once __DIR__ . '/../core/Database.php';

class User {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAllUsers() {
        $this->db->query("SELECT id_user, nama_lengkap, password, status, role, foto, email, no_telepon, kode_user FROM users");
        return $this->db->resultSet();
    }

    public function getPelanggan() {
        $this->db->query("SELECT id_user, nama_lengkap, no_telepon, email FROM users WHERE LOWER(role) = 'pelanggan' ORDER BY nama_lengkap ASC");
        return $this->db->resultSet();
    }

    public function getUserByKode(string $kode_user) {
        $this->db->query("SELECT * FROM users WHERE kode_user = :kode_user LIMIT 1");
        $this->db->bind(':kode_user', $kode_user);
        return $this->db->single();
    }

    public function getLastUserCode(string $prefix) {
        $this->db->query("SELECT kode_user FROM users WHERE kode_user LIKE :prefix ORDER BY kode_user DESC LIMIT 1");
        $this->db->bind(':prefix', $prefix . '%');
        return $this->db->single();
    }

    public function insert(array $data) {
        $this->db->query("
            INSERT INTO users(kode_user, nama_lengkap, email, status, no_telepon, password, role, foto) 
            VALUES (:kode_user, :nama_lengkap, :email, :status, :no_telepon, :password, :role, :foto)
        ");
        $this->db->bind(':kode_user', $data['kode_user']);
        $this->db->bind(':nama_lengkap', $data['nama_lengkap']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':no_telepon', $data['no_telepon']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':foto', $data['foto']);

        return $this->db->execute();
    }

    public function update(array $data, string $kode_user) {
        $this->db->query("
            UPDATE users SET
            nama_lengkap = :nama_lengkap,
            email = :email,
            status = :status,
            no_telepon = :no_telepon,
            role = :role,
            password = :password,
            foto = :foto 
            WHERE kode_user = :kode_user
        ");

        $this->db->bind(':nama_lengkap', $data['nama_lengkap']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':no_telepon', $data['no_telepon']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':foto', $data['foto']);
        $this->db->bind(':kode_user', $kode_user);

        return $this->db->execute();
    }

    public function delete(int $id_user) {
        $this->db->query("DELETE FROM users WHERE id_user = :id_user");
        $this->db->bind(':id_user', $id_user);
        return $this->db->execute();
    }
}

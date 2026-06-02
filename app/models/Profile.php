<?php
require_once __DIR__ . '/../core/Database.php';

class Profile {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getUserById($id_user) {
        $this->db->query("SELECT * FROM users WHERE id_user = :id_user");
        $this->db->bind(':id_user', $id_user);
        return $this->db->single();
    }

    public function updateProfile($data) {
        $query = "UPDATE users SET 
                    nama_lengkap = :nama_lengkap, 
                    email = :email, 
                    no_telepon = :no_telepon";
        
        if (isset($data['foto'])) {
            $query .= ", foto = :foto";
        }
        
        $query .= " WHERE id_user = :id_user";

        $this->db->query($query);
        $this->db->bind(':nama_lengkap', $data['nama_lengkap']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':no_telepon', $data['no_telepon']);
        $this->db->bind(':id_user', $data['id_user']);

        if (isset($data['foto'])) {
            $this->db->bind(':foto', $data['foto']);
        }

        return $this->db->execute();
    }

    public function updatePassword($id_user, $password_hash) {
        $this->db->query("UPDATE users SET password = :password WHERE id_user = :id_user");
        $this->db->bind(':password', $password_hash);
        $this->db->bind(':id_user', $id_user);
        return $this->db->execute();
    }
}

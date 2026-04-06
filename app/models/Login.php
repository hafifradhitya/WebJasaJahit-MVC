<?php
require_once __DIR__ . '/../core/Database.php';

class Login {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getUserByEmailOrPhone(string $identitas) {
        $this->db->query("SELECT * FROM users WHERE no_telepon = :identitas OR email = :identitas");
        $this->db->bind(':identitas', $identitas);
        return $this->db->single();
    }
}

<?php
require_once __DIR__ . '/../core/Database.php';

class Dashboard {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getTotalPelanggan() {
        $this->db->query("SELECT COUNT(*) AS total FROM users WHERE role='pelanggan'");
        return $this->db->single()->total ?? 0;
    }

    public function getTotalPesanan() {
        $this->db->query("SELECT COUNT(*) AS total FROM pesanan");
        return $this->db->single()->total ?? 0;
    }

    public function getPesananHariIni() {
        $this->db->query("SELECT COUNT(*) AS total FROM pesanan WHERE tanggal_pesan = CURDATE()");
        return $this->db->single()->total ?? 0;
    }

    public function getPesananProses() {
        $this->db->query("SELECT COUNT(*) AS total FROM pesanan WHERE status_pesanan='proses'");
        return $this->db->single()->total ?? 0;
    }

    public function getPesananSelesai() {
        $this->db->query("SELECT COUNT(*) AS total FROM pesanan WHERE status_pesanan='selesai'");
        return $this->db->single()->total ?? 0;
    }

    public function getPesananDiambil() {
        $this->db->query("SELECT COUNT(*) AS total FROM pesanan WHERE status_pesanan='diambil'");
        return $this->db->single()->total ?? 0;
    }

    public function getTotalPendapatan() {
        $this->db->query("
            SELECT SUM(l.harga_mulai) AS total_pendapatan
            FROM pesanan p
            JOIN layanan l ON p.id_layanan = l.id_layanan
            WHERE p.status_pesanan = 'diambil'
        ");
        return $this->db->single()->total_pendapatan ?? 0;
    }

    public function getBulanTotal() {
        $this->db->query("
            SELECT MONTH(tanggal_pesan) AS bulan, COUNT(*) AS total
            FROM pesanan
            WHERE YEAR(tanggal_pesan) = YEAR(CURDATE())
            GROUP BY MONTH(tanggal_pesan)
        ");
        $results = $this->db->resultSet();
        
        $bulan_total = array_fill(0, 12, 0);
        foreach ($results as $r) {
            $bulan_total[$r->bulan - 1] = (int)$r->total;
        }
        return $bulan_total;
    }

    public function getBulanSelesai() {
        $this->db->query("
            SELECT MONTH(tanggal_pesan) AS bulan, COUNT(*) AS total
            FROM pesanan
            WHERE status_pesanan = 'selesai'
            AND YEAR(tanggal_pesan) = YEAR(CURDATE())
            GROUP BY MONTH(tanggal_pesan)
        ");
        $results = $this->db->resultSet();
        
        $bulan_selesai = array_fill(0, 12, 0);
        foreach ($results as $r) {
            $bulan_selesai[$r->bulan - 1] = (int)$r->total;
        }
        return $bulan_selesai;
    }

    public function getPesananBulanIni() {
        $this->db->query("
            SELECT COUNT(*) AS total 
            FROM pesanan 
            WHERE MONTH(tanggal_pesan) = MONTH(CURDATE())
              AND YEAR(tanggal_pesan) = YEAR(CURDATE())
        ");
        return $this->db->single()->total ?? 0;
    }

    public function getPesananMenunggu() {
        $this->db->query("
            SELECT COUNT(*) AS total 
            FROM pesanan 
            WHERE status_pesanan = 'menunggu'
        ");
        return $this->db->single()->total ?? 0;
    }
}

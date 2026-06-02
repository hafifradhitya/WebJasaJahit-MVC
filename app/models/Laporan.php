<?php
require_once __DIR__ . '/../core/Database.php';

class Laporan {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getRekapPesanan($tanggal_pesan, $tanggal_selesai, $status_pesanan = '') {
        $query = "
            SELECT 
                pesanan.ukuran_pakaian,
                pesanan.catatan,
                pesanan.status_pesanan,
                pesanan.tanggal_pesan,
                pesanan.tanggal_selesai,
                users.nama_lengkap,
                users.no_telepon,
                layanan.nama_layanan,
                layanan.harga_mulai,
                layanan.estimasi_hari
            FROM pesanan
            JOIN users ON users.id_user = pesanan.id_user
            JOIN layanan ON layanan.id_layanan = pesanan.id_layanan
            WHERE pesanan.tanggal_pesan >= :tanggal_pesan
            AND pesanan.tanggal_selesai <= :tanggal_selesai
        ";

        if (!empty($status_pesanan)) {
            $query .= " AND pesanan.status_pesanan = :status_pesanan";
        }

        $this->db->query($query);
        $this->db->bind(':tanggal_pesan', $tanggal_pesan);
        $this->db->bind(':tanggal_selesai', $tanggal_selesai);
        
        if (!empty($status_pesanan)) {
            $this->db->bind(':status_pesanan', $status_pesanan);
        }

        return $this->db->resultSet();
    }
}

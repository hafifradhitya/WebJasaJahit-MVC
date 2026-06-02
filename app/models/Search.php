<?php
require_once __DIR__ . '/../core/Database.php';

class Search {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function globalSearch($q, $tanggal_dari = '', $tanggal_sampai = '', $status = '') {
        $keyword = '%' . $q . '%';
        $results = [
            'pelanggan' => [],
            'pesanan'   => [],
            'layanan'   => [],
        ];

        /* =====================
           CARI PELANGGAN
        ===================== */
        $this->db->query("
            SELECT id_user, nama_lengkap, email, no_telepon, foto, status
            FROM users
            WHERE LOWER(role) = 'pelanggan'
            AND (nama_lengkap LIKE :q OR email LIKE :q2 OR no_telepon LIKE :q3)
            ORDER BY nama_lengkap ASC
            LIMIT 10
        ");
        $this->db->bind(':q', $keyword);
        $this->db->bind(':q2', $keyword);
        $this->db->bind(':q3', $keyword);
        $results['pelanggan'] = $this->db->resultSet();

        /* =====================
           CARI PESANAN
        ===================== */
        $whereExtra = '';
        if (!empty($tanggal_dari) && !empty($tanggal_sampai)) {
            $whereExtra .= " AND pesanan.tanggal_pesan >= :tanggal_dari AND pesanan.tanggal_selesai <= :tanggal_sampai";
        }
        if (!empty($status)) {
            $whereExtra .= " AND pesanan.status_pesanan = :status";
        }

        $this->db->query("
            SELECT 
                pesanan.id_pesanan,
                pesanan.ukuran_pakaian,
                pesanan.catatan,
                pesanan.tanggal_pesan,
                pesanan.tanggal_selesai,
                pesanan.status_pesanan,
                users.nama_lengkap,
                layanan.nama_layanan,
                layanan.harga_mulai
            FROM pesanan
            JOIN users ON users.id_user = pesanan.id_user
            JOIN layanan ON layanan.id_layanan = pesanan.id_layanan
            WHERE (
                users.nama_lengkap LIKE :q 
                OR layanan.nama_layanan LIKE :q2 
                OR pesanan.ukuran_pakaian LIKE :q3
                OR pesanan.status_pesanan LIKE :q4
            )
            {$whereExtra}
            ORDER BY pesanan.id_pesanan DESC
            LIMIT 15
        ");
        $this->db->bind(':q',  $keyword);
        $this->db->bind(':q2', $keyword);
        $this->db->bind(':q3', $keyword);
        $this->db->bind(':q4', $keyword);
        if (!empty($tanggal_dari) && !empty($tanggal_sampai)) {
            $this->db->bind(':tanggal_dari',   $tanggal_dari);
            $this->db->bind(':tanggal_sampai', $tanggal_sampai);
        }
        if (!empty($status)) {
            $this->db->bind(':status', $status);
        }
        $results['pesanan'] = $this->db->resultSet();

        /* =====================
           CARI LAYANAN
        ===================== */
        $this->db->query("
            SELECT layanan.id_layanan, layanan.nama_layanan, layanan.harga_mulai, 
                   layanan.estimasi_hari, layanan.status, kategori.nama_kategori
            FROM layanan
            LEFT JOIN kategori ON kategori.id_kategori = layanan.id_kategori
            WHERE layanan.nama_layanan LIKE :q OR layanan.deskripsi LIKE :q2
            ORDER BY layanan.nama_layanan ASC
            LIMIT 10
        ");
        $this->db->bind(':q',  $keyword);
        $this->db->bind(':q2', $keyword);
        $results['layanan'] = $this->db->resultSet();

        return $results;
    }
}

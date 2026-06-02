<?php
require_once __DIR__ . '/../core/Database.php';

class Pesanan {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getDb(): Database {
        return $this->db;
    }

    public function getAllPesananWithRelasi(): array {
        $this->db->query("
            SELECT 
                pesanan.id_pesanan, 
                pesanan.ukuran_pakaian, 
                pesanan.catatan,
                pesanan.tanggal_pesan,
                pesanan.tanggal_selesai,
                pesanan.status_pesanan,

                users.nama_lengkap,
                users.no_telepon,

                layanan.nama_layanan,
                layanan.harga_mulai,
                layanan.estimasi_hari
            FROM pesanan 
            JOIN users 
                ON users.id_user = pesanan.id_user
                AND LOWER(users.role) = 'pelanggan'
            JOIN layanan 
                ON layanan.id_layanan = pesanan.id_layanan
            ORDER BY pesanan.id_pesanan DESC
        ");
        return $this->db->resultSet();
    }

    public function getPesananByStatus(string $status): array {
        $this->db->query("
            SELECT 
                pesanan.id_pesanan, 
                pesanan.ukuran_pakaian, 
                pesanan.catatan,
                pesanan.tanggal_pesan,
                pesanan.tanggal_selesai,
                pesanan.status_pesanan,

                users.nama_lengkap,
                users.no_telepon,

                layanan.nama_layanan,
                layanan.harga_mulai,
                layanan.estimasi_hari
            FROM pesanan 
            JOIN users 
                ON users.id_user = pesanan.id_user
                AND LOWER(users.role) = 'pelanggan'
            JOIN layanan 
                ON layanan.id_layanan = pesanan.id_layanan
            WHERE pesanan.status_pesanan = :status
            ORDER BY pesanan.id_pesanan DESC
        ");
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    public function getPesananById($id_pesanan) {
        $this->db->query("
            SELECT 
                pesanan.*,
                users.nama_lengkap,
                users.no_telepon,
                layanan.nama_layanan,
                layanan.harga_mulai,
                layanan.estimasi_hari
            FROM pesanan 
            JOIN users ON users.id_user = pesanan.id_user
            JOIN layanan ON layanan.id_layanan = pesanan.id_layanan
            WHERE pesanan.id_pesanan = :id_pesanan
        ");
        $this->db->bind('id_pesanan', $id_pesanan);
        return $this->db->single();
    }

    public function insert($data) {
        $this->db->query("
            INSERT INTO pesanan 
                (id_user, id_layanan, ukuran_pakaian, catatan, tanggal_pesan, tanggal_selesai, status_pesanan) 
            VALUES 
                (:id_user, :id_layanan, :ukuran_pakaian, :catatan, :tanggal_pesan, :tanggal_selesai, :status_pesanan)
        ");
        $this->db->bind('id_user', $data['id_user']);
        $this->db->bind('id_layanan', $data['id_layanan']);
        $this->db->bind('ukuran_pakaian', $data['ukuran_pakaian']);
        $this->db->bind('catatan', $data['catatan']);
        $this->db->bind('tanggal_pesan', $data['tanggal_pesan']);
        $this->db->bind('tanggal_selesai', $data['tanggal_selesai']);
        $this->db->bind('status_pesanan', $data['status_pesanan']);
        $this->db->execute();
    }

    public function update($data) {
        $this->db->query("
            UPDATE pesanan SET 
                id_user = :id_user, 
                id_layanan = :id_layanan, 
                ukuran_pakaian = :ukuran_pakaian, 
                catatan = :catatan, 
                tanggal_pesan = :tanggal_pesan, 
                tanggal_selesai = :tanggal_selesai, 
                status_pesanan = :status_pesanan 
            WHERE id_pesanan = :id_pesanan
        ");
        $this->db->bind('id_user', $data['id_user']);
        $this->db->bind('id_layanan', $data['id_layanan']);
        $this->db->bind('ukuran_pakaian', $data['ukuran_pakaian']);
        $this->db->bind('catatan', $data['catatan']);
        $this->db->bind('tanggal_pesan', $data['tanggal_pesan']);
        $this->db->bind('tanggal_selesai', $data['tanggal_selesai']);
        $this->db->bind('status_pesanan', $data['status_pesanan']);
        $this->db->bind('id_pesanan', $data['id_pesanan']);
        $this->db->execute();
    }

    public function delete($id_pesanan) {
        $this->db->query("DELETE FROM pesanan WHERE id_pesanan = :id_pesanan");
        $this->db->bind('id_pesanan', $id_pesanan);
        $this->db->execute();
    }

    public function lastInsertId() {
        return $this->db->lastInsertId();
    }

    public function insertUkuranAtasan($data) {
        $this->db->query("
            INSERT INTO ukuran_atasan 
                (id_pesanan, lingkar_dada, lingkar_pinggang, lingkar_pinggul, 
                 lebar_bahu, panjang_lengan, lingkar_lengan, panjang_baju, 
                 lingkar_leher, model_fit, kegunaan) 
            VALUES 
                (:id_pesanan, :lingkar_dada, :lingkar_pinggang, :lingkar_pinggul, 
                 :lebar_bahu, :panjang_lengan, :lingkar_lengan, :panjang_baju, 
                 :lingkar_leher, :model_fit, :kegunaan)
        ");
        $this->db->bind('id_pesanan', $data['id_pesanan']);
        $this->db->bind('lingkar_dada', $data['lingkar_dada']);
        $this->db->bind('lingkar_pinggang', $data['lingkar_pinggang']);
        $this->db->bind('lingkar_pinggul', $data['lingkar_pinggul']);
        $this->db->bind('lebar_bahu', $data['lebar_bahu']);
        $this->db->bind('panjang_lengan', $data['panjang_lengan']);
        $this->db->bind('lingkar_lengan', $data['lingkar_lengan']);
        $this->db->bind('panjang_baju', $data['panjang_baju']);
        $this->db->bind('lingkar_leher', $data['lingkar_leher']);
        $this->db->bind('model_fit', $data['model_fit']);
        $this->db->bind('kegunaan', $data['kegunaan']);
        $this->db->execute();
    }

    public function getUkuranAtasanByPesanan($id_pesanan) {
        $this->db->query("SELECT * FROM ukuran_atasan WHERE id_pesanan = :id_pesanan LIMIT 1");
        $this->db->bind('id_pesanan', $id_pesanan);
        return $this->db->single();
    }

    public function getUkuranBawahanByPesanan($id_pesanan) {
        $this->db->query("SELECT * FROM ukuran_bawahan WHERE id_pesanan = :id_pesanan LIMIT 1");
        $this->db->bind('id_pesanan', $id_pesanan);
        return $this->db->single();
    }

    public function updateUkuranAtasan($data) {
        // Cek apakah sudah ada data, jika ada UPDATE, jika tidak INSERT
        $this->db->query("SELECT id_ukuran_atasan FROM ukuran_atasan WHERE id_pesanan = :id_pesanan LIMIT 1");
        $this->db->bind('id_pesanan', $data['id_pesanan']);
        $existing = $this->db->single();

        if ($existing) {
            $this->db->query("
                UPDATE ukuran_atasan SET
                    lingkar_dada     = :lingkar_dada,
                    lingkar_pinggang = :lingkar_pinggang,
                    lingkar_pinggul  = :lingkar_pinggul,
                    lebar_bahu       = :lebar_bahu,
                    panjang_lengan   = :panjang_lengan,
                    lingkar_lengan   = :lingkar_lengan,
                    panjang_baju     = :panjang_baju,
                    lingkar_leher    = :lingkar_leher,
                    model_fit        = :model_fit,
                    kegunaan         = :kegunaan
                WHERE id_pesanan = :id_pesanan
            ");
        } else {
            $this->db->query("
                INSERT INTO ukuran_atasan 
                    (id_pesanan, lingkar_dada, lingkar_pinggang, lingkar_pinggul, 
                     lebar_bahu, panjang_lengan, lingkar_lengan, panjang_baju, 
                     lingkar_leher, model_fit, kegunaan) 
                VALUES 
                    (:id_pesanan, :lingkar_dada, :lingkar_pinggang, :lingkar_pinggul, 
                     :lebar_bahu, :panjang_lengan, :lingkar_lengan, :panjang_baju, 
                     :lingkar_leher, :model_fit, :kegunaan)
            ");
        }
        $this->db->bind('id_pesanan', $data['id_pesanan']);
        $this->db->bind('lingkar_dada', $data['lingkar_dada']);
        $this->db->bind('lingkar_pinggang', $data['lingkar_pinggang']);
        $this->db->bind('lingkar_pinggul', $data['lingkar_pinggul']);
        $this->db->bind('lebar_bahu', $data['lebar_bahu']);
        $this->db->bind('panjang_lengan', $data['panjang_lengan']);
        $this->db->bind('lingkar_lengan', $data['lingkar_lengan']);
        $this->db->bind('panjang_baju', $data['panjang_baju']);
        $this->db->bind('lingkar_leher', $data['lingkar_leher']);
        $this->db->bind('model_fit', $data['model_fit']);
        $this->db->bind('kegunaan', $data['kegunaan']);
        $this->db->execute();
    }

    public function updateUkuranBawahan($data) {
        // Cek apakah sudah ada data, jika ada UPDATE, jika tidak INSERT
        $this->db->query("SELECT id_ukuran_bawahan FROM ukuran_bawahan WHERE id_pesanan = :id_pesanan LIMIT 1");
        $this->db->bind('id_pesanan', $data['id_pesanan']);
        $existing = $this->db->single();

        if ($existing) {
            $this->db->query("
                UPDATE ukuran_bawahan SET
                    lingkar_pinggang = :lingkar_pinggang,
                    lingkar_pinggul  = :lingkar_pinggul,
                    panjang_celana   = :panjang_celana,
                    lingkar_paha     = :lingkar_paha,
                    lingkar_lutut    = :lingkar_lutut,
                    lingkar_kaki     = :lingkar_kaki,
                    tinggi_duduk     = :tinggi_duduk
                WHERE id_pesanan = :id_pesanan
            ");
        } else {
            $this->db->query("
                INSERT INTO ukuran_bawahan 
                    (id_pesanan, lingkar_pinggang, lingkar_pinggul, panjang_celana, 
                     lingkar_paha, lingkar_lutut, lingkar_kaki, tinggi_duduk) 
                VALUES 
                    (:id_pesanan, :lingkar_pinggang, :lingkar_pinggul, :panjang_celana, 
                     :lingkar_paha, :lingkar_lutut, :lingkar_kaki, :tinggi_duduk)
            ");
        }
        $this->db->bind('id_pesanan', $data['id_pesanan']);
        $this->db->bind('lingkar_pinggang', $data['lingkar_pinggang']);
        $this->db->bind('lingkar_pinggul', $data['lingkar_pinggul']);
        $this->db->bind('panjang_celana', $data['panjang_celana']);
        $this->db->bind('lingkar_paha', $data['lingkar_paha']);
        $this->db->bind('lingkar_lutut', $data['lingkar_lutut']);
        $this->db->bind('lingkar_kaki', $data['lingkar_kaki']);
        $this->db->bind('tinggi_duduk', $data['tinggi_duduk']);
        $this->db->execute();
    }

    public function deleteUkuranByPesanan($id_pesanan) {
        $this->db->query("DELETE FROM ukuran_atasan WHERE id_pesanan = :id_pesanan");
        $this->db->bind('id_pesanan', $id_pesanan);
        $this->db->execute();

        $this->db->query("DELETE FROM ukuran_bawahan WHERE id_pesanan = :id_pesanan");
        $this->db->bind('id_pesanan', $id_pesanan);
        $this->db->execute();
    }

    public function insertUkuranBawahan($data) {
        $this->db->query("
            INSERT INTO ukuran_bawahan 
                (id_pesanan, lingkar_pinggang, lingkar_pinggul, panjang_celana, 
                 lingkar_paha, lingkar_lutut, lingkar_kaki, tinggi_duduk) 
            VALUES 
                (:id_pesanan, :lingkar_pinggang, :lingkar_pinggul, :panjang_celana, 
                 :lingkar_paha, :lingkar_lutut, :lingkar_kaki, :tinggi_duduk)
        ");
        $this->db->bind('id_pesanan', $data['id_pesanan']);
        $this->db->bind('lingkar_pinggang', $data['lingkar_pinggang']);
        $this->db->bind('lingkar_pinggul', $data['lingkar_pinggul']);
        $this->db->bind('panjang_celana', $data['panjang_celana']);
        $this->db->bind('lingkar_paha', $data['lingkar_paha']);
        $this->db->bind('lingkar_lutut', $data['lingkar_lutut']);
        $this->db->bind('lingkar_kaki', $data['lingkar_kaki']);
        $this->db->bind('tinggi_duduk', $data['tinggi_duduk']);
        $this->db->execute();
    }

    public function getLaporanData($tanggal_pesan = '', $tanggal_selesai = '') {
        $query = "
            SELECT 
                pesanan.id_pesanan,
                pesanan.ukuran_pakaian,
                pesanan.catatan,
                pesanan.tanggal_pesan,
                pesanan.tanggal_selesai,
                pesanan.status_pesanan,
                users.nama_lengkap,
                users.no_telepon,
                layanan.nama_layanan,
                layanan.harga_mulai,
                layanan.estimasi_hari
            FROM pesanan
            JOIN users 
                ON users.id_user = pesanan.id_user
                AND LOWER(users.role) = 'pelanggan'
            JOIN layanan 
                ON layanan.id_layanan = pesanan.id_layanan
        ";

        if (!empty($tanggal_pesan) && !empty($tanggal_selesai)) {
            $query .= " WHERE pesanan.tanggal_pesan >= :tanggal_pesan AND pesanan.tanggal_selesai <= :tanggal_selesai";
        }

        $this->db->query($query);

        if (!empty($tanggal_pesan) && !empty($tanggal_selesai)) {
            $this->db->bind('tanggal_pesan', $tanggal_pesan);
            $this->db->bind('tanggal_selesai', $tanggal_selesai);
        }

        return $this->db->resultSet();
    }
}

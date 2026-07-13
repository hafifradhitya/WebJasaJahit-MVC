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

    public function getTotalPendapatanKotor() {
        $this->db->query("
            SELECT SUM(COALESCE(NULLIF(p.harga_final, 0), p.estimasi_harga, l.harga_mulai)) AS total_pendapatan
            FROM pesanan p
            JOIN layanan l ON p.id_layanan = l.id_layanan
        ");
        return $this->db->single()->total_pendapatan ?? 0;
    }

    public function getTotalPendapatanLunas() {
        $this->db->query("
            SELECT SUM(p.harga_final) AS total_pendapatan
            FROM pesanan p
            WHERE p.status_pembayaran = 'lunas'
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

    public function getChartData($filter) {
        $categories = [];
        $total_orders = [];
        $completed_orders = [];

        if ($filter == '7 Hari Terakhir') {
            $this->db->query("
                SELECT DATE(tanggal_pesan) as tgl, 
                       COUNT(*) as total,
                       SUM(CASE WHEN status_pesanan = 'selesai' THEN 1 ELSE 0 END) as selesai
                FROM pesanan
                WHERE tanggal_pesan >= CURDATE() - INTERVAL 6 DAY
                GROUP BY DATE(tanggal_pesan)
                ORDER BY DATE(tanggal_pesan) ASC
            ");
            $results = $this->db->resultSet();
            
            $data_map = [];
            foreach ($results as $r) {
                $data_map[$r->tgl] = $r;
            }

            for ($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $categories[] = date('d M', strtotime($date));
                if (isset($data_map[$date])) {
                    $total_orders[] = (int)$data_map[$date]->total;
                    $completed_orders[] = (int)$data_map[$date]->selesai;
                } else {
                    $total_orders[] = 0;
                    $completed_orders[] = 0;
                }
            }
        } elseif ($filter == 'Bulan Ini') {
            $this->db->query("
                SELECT DATE(tanggal_pesan) as tgl, 
                       COUNT(*) as total,
                       SUM(CASE WHEN status_pesanan = 'selesai' THEN 1 ELSE 0 END) as selesai
                FROM pesanan
                WHERE MONTH(tanggal_pesan) = MONTH(CURDATE()) AND YEAR(tanggal_pesan) = YEAR(CURDATE())
                GROUP BY DATE(tanggal_pesan)
                ORDER BY DATE(tanggal_pesan) ASC
            ");
            $results = $this->db->resultSet();
            
            $data_map = [];
            foreach ($results as $r) {
                $data_map[$r->tgl] = $r;
            }

            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $date = date('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT);
                $categories[] = (string)$i;
                if (isset($data_map[$date])) {
                    $total_orders[] = (int)$data_map[$date]->total;
                    $completed_orders[] = (int)$data_map[$date]->selesai;
                } else {
                    $total_orders[] = 0;
                    $completed_orders[] = 0;
                }
            }
        } elseif ($filter == '6 Bulan Terakhir') {
            $this->db->query("
                SELECT MONTH(tanggal_pesan) as bln, YEAR(tanggal_pesan) as thn, 
                       COUNT(*) as total,
                       SUM(CASE WHEN status_pesanan = 'selesai' THEN 1 ELSE 0 END) as selesai
                FROM pesanan
                WHERE tanggal_pesan >= DATE_SUB(CURDATE(), INTERVAL 5 MONTH)
                GROUP BY YEAR(tanggal_pesan), MONTH(tanggal_pesan)
                ORDER BY YEAR(tanggal_pesan) ASC, MONTH(tanggal_pesan) ASC
            ");
            $results = $this->db->resultSet();
            
            $data_map = [];
            foreach ($results as $r) {
                $key = $r->thn . '-' . str_pad($r->bln, 2, '0', STR_PAD_LEFT);
                $data_map[$key] = $r;
            }

            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            for ($i = 5; $i >= 0; $i--) {
                $time = strtotime("-$i months");
                $key = date('Y-m', $time);
                $categories[] = $months[(int)date('m', $time) - 1];
                if (isset($data_map[$key])) {
                    $total_orders[] = (int)$data_map[$key]->total;
                    $completed_orders[] = (int)$data_map[$key]->selesai;
                } else {
                    $total_orders[] = 0;
                    $completed_orders[] = 0;
                }
            }
        } else {
            $this->db->query("
                SELECT MONTH(tanggal_pesan) as bln, 
                       COUNT(*) as total,
                       SUM(CASE WHEN status_pesanan = 'selesai' THEN 1 ELSE 0 END) as selesai
                FROM pesanan
                WHERE YEAR(tanggal_pesan) = YEAR(CURDATE())
                GROUP BY MONTH(tanggal_pesan)
                ORDER BY MONTH(tanggal_pesan) ASC
            ");
            $results = $this->db->resultSet();
            
            $data_map = [];
            foreach ($results as $r) {
                $data_map[$r->bln] = $r;
            }

            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            for ($i = 1; $i <= 12; $i++) {
                $categories[] = $months[$i - 1];
                if (isset($data_map[$i])) {
                    $total_orders[] = (int)$data_map[$i]->total;
                    $completed_orders[] = (int)$data_map[$i]->selesai;
                } else {
                    $total_orders[] = 0;
                    $completed_orders[] = 0;
                }
            }
        }

        return [
            'categories' => $categories,
            'total' => $total_orders,
            'selesai' => $completed_orders
        ];
    }
}

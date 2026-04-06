<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class DashboardController extends Controller {
    public function index() {
        if (!isset($_SESSION['login'])) {
            header("Location: " . base_url('auth/login?pesan=belum_login'));
            exit();
        } else if ($_SESSION["role"] != 'admin') {
            header("Location: " . base_url('auth/login?pesan=tolak_akses'));
            exit();
        }

        $dashboardModel = $this->model('Dashboard');

        // Mengambil semua data dari model
        $data = [
            'judul' => 'Jahit Overview',
            'no_preloader' => true,
            'pelanggan' => $dashboardModel->getTotalPelanggan(),
            'total_pesanan' => $dashboardModel->getTotalPesanan(),
            'pesanan_today' => $dashboardModel->getPesananHariIni(),
            'pesanan_proses' => $dashboardModel->getPesananProses(),
            'pesanan_selesai' => $dashboardModel->getPesananSelesai(),
            'pesanan_diambil' => $dashboardModel->getPesananDiambil(),
            'total_pendapatan' => $dashboardModel->getTotalPendapatan(),
            'bulan_total' => $dashboardModel->getBulanTotal(),
            'bulan_selesai' => $dashboardModel->getBulanSelesai(),
            'pesanan_bulan_ini' => $dashboardModel->getPesananBulanIni(),
            'pesanan_menunggu' => $dashboardModel->getPesananMenunggu()
        ];

        // Menyimpan global variable agar diakses di header dengan benar
        $GLOBALS['judul'] = $data['judul'];

        $this->view('admin/dashboard/dashboard', $data);
    }
}

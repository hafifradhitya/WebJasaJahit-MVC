<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class DashboardController extends Controller {
    public function index() {
        if (!isset($_SESSION['login'])) {
            http_response_code(404);
            $this->view('errors/404');
            exit();
        } else if ($_SESSION["role"] != 'admin') {
            http_response_code(404);
            $this->view('errors/404');
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
            'total_pendapatan_kotor' => $dashboardModel->getTotalPendapatanKotor(),
            'total_pendapatan_lunas' => $dashboardModel->getTotalPendapatanLunas(),
            'bulan_total' => $dashboardModel->getBulanTotal(),
            'bulan_selesai' => $dashboardModel->getBulanSelesai(),
            'pesanan_bulan_ini' => $dashboardModel->getPesananBulanIni(),
            'pesanan_menunggu' => $dashboardModel->getPesananMenunggu()
        ];

        // Menyimpan global variable agar diakses di header dengan benar
        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/dashboard/dashboard', $data);
    }

    public function chartData() {
        if (!isset($_SESSION['login']) || $_SESSION["role"] != 'admin') {
            echo json_encode(['error' => 'Unauthorized']);
            exit();
        }

        $filter = $_POST['filter'] ?? 'Tahun Ini';
        $dashboardModel = $this->model('Dashboard');
        $data = $dashboardModel->getChartData($filter);
        
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}

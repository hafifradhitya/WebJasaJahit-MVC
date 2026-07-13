<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class SearchController extends Controller {

    private function checkAuth() {
        if (!isset($_SESSION['login'])) {
            http_response_code(404);
            $this->view('errors/404');
            exit();
        } elseif ($_SESSION["role"] != 'admin') {
            http_response_code(404);
            $this->view('errors/404');
            exit();
        }
    }

    public function index() {
        $this->checkAuth();

        $q             = trim($_GET['q'] ?? '');
        $tanggal_dari  = $_GET['tanggal_dari'] ?? '';
        $tanggal_sampai = $_GET['tanggal_sampai'] ?? '';
        $status        = $_GET['status'] ?? '';

        $results = ['pelanggan' => [], 'pesanan' => [], 'layanan' => []];
        $total   = 0;

        if (!empty($q) || (!empty($tanggal_dari) && !empty($tanggal_sampai)) || !empty($status)) {
            $searchModel = $this->model('Search');
            $results = $searchModel->globalSearch($q, $tanggal_dari, $tanggal_sampai, $status);
            $total   = count($results['pelanggan']) + count($results['pesanan']) + count($results['layanan']);
        }

        $data = [
            'judul'          => 'Hasil Pencarian',
            'no_preloader'   => true,
            'q'              => $q,
            'tanggal_dari'   => $tanggal_dari,
            'tanggal_sampai' => $tanggal_sampai,
            'status'         => $status,
            'results'        => $results,
            'total'          => $total,
        ];

        $GLOBALS['judul']       = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/search/index', $data);
    }
}

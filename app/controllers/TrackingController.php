<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class TrackingController extends Controller
{

    public function index()
    {
        $data = [
            'judul' => 'Lacak Pesanan | Jasa Jahit Premium',
        ];

        $this->view('front/tracking', $data);
    }

    public function search()
    {
        header('Content-Type: application/json');

        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        if (!isset($input['keyword']) || empty(trim($input['keyword']))) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Silakan masukkan ID Pesanan atau Nomor WhatsApp.'
            ]);
            exit;
        }

        $keyword = htmlspecialchars(trim($input['keyword']));
        
        $clean_keyword = $keyword;
        // Jika formatnya INV-XXXX, ambil angkanya saja tanpa menghilangkan angka 0 di depan (penting untuk no telepon)
        if (preg_match('/^INV\s*-\s*(\d+)$/i', $keyword, $matches)) {
            $clean_keyword = $matches[1];
        }

        $pesananModel = $this->model('Pesanan');
        $hasil = $pesananModel->getPesananByPhoneOrId($clean_keyword);

        if (empty($hasil)) {
            echo json_encode([
                'status' => 'not_found',
                'message' => 'Maaf, data pesanan tidak ditemukan. Mohon periksa kembali ID Pesanan atau Nomor WhatsApp Anda.'
            ]);
            exit;
        }

        echo json_encode([
            'status' => 'success',
            'data' => $hasil
        ]);
        exit;
    }
}

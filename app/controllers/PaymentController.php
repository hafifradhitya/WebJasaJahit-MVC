<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class PaymentController extends Controller {

    private $isProduction = false;

    private function getServerKey() {
        return $_ENV['MIDTRANS_SERVER_KEY'] ?? '';
    }

    public function token() {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
            exit;
        }

        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        if (!isset($input['id_pesanan'])) {
            echo json_encode(['status' => 'error', 'message' => 'ID Pesanan tidak valid']);
            exit;
        }

        $id_pesanan = (int)$input['id_pesanan'];
        $pesananModel = $this->model('Pesanan');
        $pesanan = $pesananModel->getPesananById($id_pesanan);

        if (!$pesanan) {
            echo json_encode(['status' => 'error', 'message' => 'Pesanan tidak ditemukan']);
            exit;
        }

        $harga_bayar = (isset($pesanan->harga_final) && $pesanan->harga_final > 0) ? $pesanan->harga_final : ((isset($pesanan->estimasi_harga) && $pesanan->estimasi_harga > 0) ? $pesanan->estimasi_harga : $pesanan->harga_mulai);

        if ($harga_bayar <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Harga belum ditentukan oleh Admin']);
            exit;
        }

        // Generate unique order ID
        $orderId = 'INV-' . str_pad($id_pesanan, 4, '0', STR_PAD_LEFT) . '-' . time();

        // Update DB with this midtrans_order_id so we can track it
        $pesananModel->updatePaymentStatus($id_pesanan, $pesanan->status_pembayaran, $orderId);

        // Call Midtrans API
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int)$harga_bayar,
            ],
            'customer_details' => [
                'first_name' => $pesanan->nama_lengkap,
                'phone' => $pesanan->no_telepon,
            ]
        ];

        $snapToken = $this->getSnapToken($params);

        if ($snapToken) {
            echo json_encode(['status' => 'success', 'token' => $snapToken]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mendapatkan token pembayaran dari Midtrans']);
        }
        exit;
    }

    private function getSnapToken($params) {
        $url = $this->isProduction ? 'https://app.midtrans.com/snap/v1/transactions' : 'https://app.sandbox.midtrans.com/snap/v1/transactions';
        
        $ch = curl_init($url);
        $payload = json_encode($params);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode($this->getServerKey() . ':')
        ));
        
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        
        if ($err) {
            return false;
        } else {
            $result = json_decode($response, true);
            return isset($result['token']) ? $result['token'] : false;
        }
    }

    public function webhook() {
        // Handle Midtrans HTTP notification
        $json_result = file_get_contents('php://input');
        $notif = json_decode($json_result, true);

        if (!$notif) {
            http_response_code(400);
            exit;
        }

        $order_id = $notif['order_id'] ?? '';
        $transaction_status = $notif['transaction_status'] ?? '';
        $fraud_status = $notif['fraud_status'] ?? '';

        // Extract ID Pesanan from INV-XXXX-TIMESTAMP
        $parts = explode('-', $order_id);
        if (count($parts) >= 2) {
            $id_pesanan = (int)$parts[1];
        } else {
            http_response_code(400);
            exit;
        }

        $pesananModel = $this->model('Pesanan');
        $pesanan = $pesananModel->getPesananById($id_pesanan);

        if (!$pesanan) {
            http_response_code(404);
            exit;
        }

        // Only update if it's the latest midtrans_order_id to prevent old webhook collision
        if ($pesanan->midtrans_order_id !== $order_id) {
            http_response_code(200);
            echo "Ignored: obsolete order_id";
            exit;
        }

        $status = 'belum_bayar';

        if ($transaction_status == 'capture') {
            if ($fraud_status == 'challenge') {
                $status = 'belum_bayar';
            } else if ($fraud_status == 'accept') {
                $status = 'lunas';
            }
        } else if ($transaction_status == 'settlement') {
            $status = 'lunas';
        } else if ($transaction_status == 'cancel' || $transaction_status == 'deny' || $transaction_status == 'expire') {
            $status = 'belum_bayar';
        } else if ($transaction_status == 'pending') {
            $status = 'belum_bayar';
        }

        // Update Payment Status
        if ($status === 'lunas') {
            $pesananModel->updatePaymentStatus($id_pesanan, 'lunas', $order_id);
            // Auto-update the status_pesanan from 'menunggu' to 'proses' when fully paid
            if ($pesanan->status_pesanan === 'menunggu') {
                $pesananModel->update([
                    'id_pesanan'      => $pesanan->id_pesanan,
                    'id_user'         => $pesanan->id_user,
                    'id_layanan'      => $pesanan->id_layanan,
                    'ukuran_pakaian'  => $pesanan->ukuran_pakaian,
                    'catatan'         => $pesanan->catatan,
                    'tanggal_pesan'   => $pesanan->tanggal_pesan,
                    'tanggal_selesai' => $pesanan->tanggal_selesai,
                    'status_pesanan'  => 'proses',
                    'waktu_selesai'   => $pesanan->waktu_selesai,
                    'waktu_diambil'   => $pesanan->waktu_diambil,
                    'estimasi_harga'  => $pesanan->estimasi_harga,
                    'opsi_bahan'      => $pesanan->opsi_bahan,
                    'opsi_kerumitan'  => $pesanan->opsi_kerumitan,
                    'harga_final'     => $pesanan->harga_final,
                    'status_pembayaran' => 'lunas',
                ]);
            }
        }

        http_response_code(200);
        echo "OK";
    }

    public function success() {
        $id_pesanan = isset($_GET['id_pesanan']) ? (int)$_GET['id_pesanan'] : 0;
        
        $pesananModel = $this->model('Pesanan');
        $pesanan = $pesananModel->getPesananById($id_pesanan);

        if (!$pesanan) {
            header("Location: " . base_url('lacak'));
            exit;
        }

        // --- LOCALHOST FALLBACK CHECK ---
        // Karena webhook Midtrans tidak bisa mencapai localhost, kita cek status secara manual
        // ke API Midtrans saat pelanggan dialihkan ke halaman sukses ini.
        if ($pesanan->status_pembayaran !== 'lunas' && !empty($pesanan->midtrans_order_id)) {
            $url = $this->isProduction 
                ? "https://api.midtrans.com/v2/{$pesanan->midtrans_order_id}/status" 
                : "https://api.sandbox.midtrans.com/v2/{$pesanan->midtrans_order_id}/status";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Accept: application/json',
                'Authorization: Basic ' . base64_encode($this->getServerKey() . ':')
            ));
            
            $response = curl_exec($ch);
            curl_close($ch);

            if ($response) {
                $result = json_decode($response, true);
                $transaction_status = $result['transaction_status'] ?? '';
                $fraud_status = $result['fraud_status'] ?? '';

                $status = 'belum_bayar';
                if ($transaction_status == 'capture') {
                    if ($fraud_status == 'accept') {
                        $status = 'lunas';
                    }
                } else if ($transaction_status == 'settlement') {
                    $status = 'lunas';
                }

                if ($status === 'lunas') {
                    $pesananModel->updatePaymentStatus($id_pesanan, 'lunas', $pesanan->midtrans_order_id);
                    // Update status pesanan ke proses
                    if ($pesanan->status_pesanan === 'menunggu') {
                        $pesananModel->update([
                            'id_pesanan'      => $pesanan->id_pesanan,
                            'id_user'         => $pesanan->id_user,
                            'id_layanan'      => $pesanan->id_layanan,
                            'ukuran_pakaian'  => $pesanan->ukuran_pakaian,
                            'catatan'         => $pesanan->catatan,
                            'tanggal_pesan'   => $pesanan->tanggal_pesan,
                            'tanggal_selesai' => $pesanan->tanggal_selesai,
                            'status_pesanan'  => 'proses',
                            'waktu_selesai'   => $pesanan->waktu_selesai,
                            'waktu_diambil'   => $pesanan->waktu_diambil,
                            'estimasi_harga'  => $pesanan->estimasi_harga,
                            'opsi_bahan'      => $pesanan->opsi_bahan,
                            'opsi_kerumitan'  => $pesanan->opsi_kerumitan,
                            'harga_final'     => $pesanan->harga_final,
                            'status_pembayaran' => 'lunas',
                        ]);
                    }
                    // Refresh data
                    $pesanan = $pesananModel->getPesananById($id_pesanan);
                }
            }
        }
        // --------------------------------

        $data = [
            'judul' => 'Pembayaran Berhasil | Jasa Jahit Premium',
            'pesanan' => $pesanan
        ];

        $this->view('front/payment_success', $data);
    }
}

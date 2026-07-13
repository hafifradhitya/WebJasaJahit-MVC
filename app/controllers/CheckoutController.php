<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Pesanan.php';

class CheckoutController extends Controller {
    
    public function process() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
            return;
        }

        // Get JSON Input
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!$data) {
            $data = $_POST; // Fallback for standard form post
        }

        $nama_lengkap = htmlspecialchars(trim($data['nama_lengkap'] ?? ''));
        $no_telepon = htmlspecialchars(trim($data['no_telepon'] ?? ''));
        $email = htmlspecialchars(trim($data['email'] ?? ''));
        $catatan_tambahan = htmlspecialchars(trim($data['catatan'] ?? ''));
        $id_layanan = intval($data['id_layanan'] ?? 0);
        $ukuran_pakaian = htmlspecialchars(trim($data['ukuran_pakaian'] ?? 'Standar'));
        $ukuran_custom = $data['ukuran_custom'] ?? null;
        $opsi_bahan = htmlspecialchars(trim($data['opsi_bahan'] ?? ''));
        $opsi_kerumitan = htmlspecialchars(trim($data['opsi_kerumitan'] ?? ''));
        $estimasi_harga = intval($data['estimasi_harga'] ?? 0);

        if (empty($nama_lengkap) || empty($no_telepon) || $id_layanan === 0) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
            return;
        }

        $db = new Database();
        $userModel = new User($db);
        $pesananModel = new Pesanan($db);

        // Check if user exists by phone
        $user = $userModel->getUserByPhone($no_telepon);
        $id_user = null;

        if ($user) {
            $id_user = $user->id_user;
        } else {
            // Auto create guest user
            $prefix = 'USR';
            $lastUser = $userModel->getLastUserCode($prefix);
            $nextNumber = 1;
            
            if ($lastUser) {
                $lastNumber = (int) substr($lastUser->kode_user, 3);
                $nextNumber = $lastNumber + 1;
            }
            $kode_user = $prefix . str_pad((string)$nextNumber, 4, '0', STR_PAD_LEFT);

            $userData = [
                'kode_user' => $kode_user,
                'nama_lengkap' => $nama_lengkap,
                'email' => $email,
                'no_telepon' => $no_telepon,
                'password' => password_hash($no_telepon, PASSWORD_DEFAULT), // default password is phone number
                'status' => 'Aktif',
                'role' => 'Pelanggan',
                'foto' => 'default.png'
            ];

            if ($userModel->insert($userData)) {
                $newUser = $userModel->getUserByKode($kode_user);
                $id_user = $newUser->id_user;
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal membuat data pelanggan']);
                return;
            }
        }

        // Just use catatan_tambahan directly for catatan column
        $final_catatan = $catatan_tambahan;

        $pesananData = [
            'id_user' => $id_user,
            'id_layanan' => $id_layanan,
            'ukuran_pakaian' => $ukuran_pakaian,
            'catatan' => $final_catatan,
            'tanggal_pesan' => date('Y-m-d'),
            'tanggal_selesai' => date('Y-m-d'), // Provide a default date
            'status_pesanan' => 'menunggu',
            'estimasi_harga' => $estimasi_harga,
            'opsi_bahan' => $opsi_bahan,
            'opsi_kerumitan' => $opsi_kerumitan
        ];

        try {
            $pesananModel->insert($pesananData);
            $id_pesanan = $pesananModel->lastInsertId();
            
            // Insert Ukuran Atasan & Bawahan jika Custom
            if ($ukuran_pakaian === 'Custom' && $ukuran_custom) {
                if (isset($ukuran_custom['atasan'])) {
                    $atasanData = $ukuran_custom['atasan'];
                    $atasanData['id_pesanan'] = $id_pesanan;
                    $pesananModel->insertUkuranAtasan($atasanData);
                }
                if (isset($ukuran_custom['bawahan'])) {
                    $bawahanData = $ukuran_custom['bawahan'];
                    $bawahanData['id_pesanan'] = $id_pesanan;
                    $pesananModel->insertUkuranBawahan($bawahanData);
                }
            }

            echo json_encode([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat',
                'id_pesanan' => 'INV-' . str_pad($id_pesanan, 4, '0', STR_PAD_LEFT)
            ]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }
}

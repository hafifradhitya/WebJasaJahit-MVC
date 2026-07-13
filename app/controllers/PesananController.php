<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class PesananController extends Controller {
    private function checkAuth() {
        if (!isset($_SESSION['login'])) {
            header("Location: " . base_url('auth/login?pesan=belum_login'));
            exit;
        } elseif ($_SESSION["role"] != 'admin') {
            header("Location: " . base_url('auth/login?pesan=tolak_akses'));
            exit;
        }
    }

    public function index() {
        $this->checkAuth();

        $pesananModel = $this->model('Pesanan');
        $pesanans = $pesananModel->getAllPesananWithRelasi();

        $data = [
            'judul'        => 'Halaman Semua Pesanan',
            'no_preloader' => true,
            'pesanans'     => $pesanans,
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_pesanan/semuapesanan', $data);
    }

    public function tambah() {
        $this->checkAuth();

        $pesananModel = $this->model('Pesanan');
        $layananModel = $this->model('Layanan');
        $userModel = $this->model('User');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $id_user         = htmlspecialchars(trim($_POST['id_user'] ?? ''));
            $id_layanan      = htmlspecialchars(trim($_POST['id_layanan'] ?? ''));
            $ukuran_pakaian  = htmlspecialchars(trim($_POST['ukuran_pakaian'] ?? ''));
            $catatan         = htmlspecialchars(trim($_POST['catatan'] ?? ''));
            $estimasi_harga  = htmlspecialchars(trim($_POST['estimasi_harga'] ?? ''));
            $opsi_bahan      = htmlspecialchars(trim($_POST['opsi_bahan'] ?? ''));
            $opsi_kerumitan  = htmlspecialchars(trim($_POST['opsi_kerumitan'] ?? ''));
            $harga_final     = htmlspecialchars(trim($_POST['harga_final'] ?? ''));
            $status_pembayaran = htmlspecialchars(trim($_POST['status_pembayaran'] ?? 'belum_bayar'));

            // Parse tanggal
            $tgl_pesan_raw   = $_POST['tanggal_pesan'] ?? '';
            $tgl_selesai_raw = $_POST['tanggal_selesai'] ?? '';
            $tanggal_pesan   = !empty($tgl_pesan_raw) ? date('Y-m-d', strtotime($tgl_pesan_raw)) : '';
            $tanggal_selesai = !empty($tgl_selesai_raw) ? date('Y-m-d', strtotime($tgl_selesai_raw)) : '';

            $pesan_kesalahan = [];

            if (empty($id_user)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Pelanggan wajib dipilih";
            }
            if (empty($id_layanan)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Layanan wajib dipilih";
            }
            if (empty($ukuran_pakaian)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Ukuran Pakaian wajib dipilih";
            }
            if (empty($tanggal_pesan)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Tanggal Pesan wajib diisi";
            }
            if (empty($tanggal_selesai)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Tanggal Selesai wajib diisi";
            }

            if (!empty($pesan_kesalahan)) {
                $_SESSION['validasi'] = implode("<br>", $pesan_kesalahan);
            } else {
                // Insert pesanan
                $pesananModel->insert([
                    'id_user'         => $id_user,
                    'id_layanan'      => $id_layanan,
                    'ukuran_pakaian'  => $ukuran_pakaian,
                    'catatan'         => $catatan,
                    'tanggal_pesan'   => $tanggal_pesan,
                    'tanggal_selesai' => $tanggal_selesai,
                    'status_pesanan'  => 'menunggu',
                    'estimasi_harga'  => empty($estimasi_harga) ? null : $estimasi_harga,
                    'opsi_bahan'      => empty($opsi_bahan) ? null : $opsi_bahan,
                    'opsi_kerumitan'  => empty($opsi_kerumitan) ? null : $opsi_kerumitan,
                    'harga_final'     => empty($harga_final) ? null : $harga_final,
                    'status_pembayaran' => $status_pembayaran,
                ]);

                // Jika ukuran custom, simpan data ukuran atasan & bawahan
                if ($ukuran_pakaian === 'Custom') {
                    $id_pesanan = $pesananModel->lastInsertId();

                    // Simpan ukuran atasan
                    $pesananModel->insertUkuranAtasan([
                        'id_pesanan'       => $id_pesanan,
                        'lingkar_dada'     => $_POST['lingkar_dada'] ?? 0,
                        'lingkar_pinggang' => $_POST['lingkar_pinggang_atasan'] ?? 0,
                        'lingkar_pinggul'  => $_POST['lingkar_pinggul_atasan'] ?? 0,
                        'lebar_bahu'       => $_POST['lebar_bahu'] ?? 0,
                        'panjang_lengan'   => $_POST['panjang_lengan'] ?? 0,
                        'lingkar_lengan'   => $_POST['lingkar_lengan'] ?? 0,
                        'panjang_baju'     => $_POST['panjang_baju'] ?? 0,
                        'lingkar_leher'    => $_POST['lingkar_leher'] ?? 0,
                        'model_fit'        => !empty($_POST['model_fit']) ? $_POST['model_fit'] : 'fit_badan',
                        'kegunaan'         => !empty($_POST['kegunaan']) ? $_POST['kegunaan'] : 'formal',
                    ]);

                    // Simpan ukuran bawahan
                    $pesananModel->insertUkuranBawahan([
                        'id_pesanan'       => $id_pesanan,
                        'lingkar_pinggang' => $_POST['lingkar_pinggang_bawahan'] ?? 0,
                        'lingkar_pinggul'  => $_POST['lingkar_pinggul_bawahan'] ?? 0,
                        'panjang_celana'   => $_POST['panjang_celana'] ?? 0,
                        'lingkar_paha'     => $_POST['lingkar_paha'] ?? 0,
                        'lingkar_lutut'    => $_POST['lingkar_lutut'] ?? 0,
                        'lingkar_kaki'     => $_POST['lingkar_kaki'] ?? 0,
                        'tinggi_duduk'     => $_POST['tinggi_duduk'] ?? 0,
                    ]);
                }

                $_SESSION['berhasil'] = "Data Berhasil Ditambah";
                header("Location: " . base_url('admin/data_pesanan/semuapesanan'));
                exit;
            }
        }

        $data = [
            'judul'        => 'Halaman Tambah Data Pesanan',
            'no_preloader' => true,
            'users'        => $userModel->getPelanggan(),
            'layanans'     => $layananModel->getActiveLayanan(),
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_pesanan/tambah', $data);
    }

    public function edit() {
        $this->checkAuth();

        $pesananModel = $this->model('Pesanan');
        $layananModel = $this->model('Layanan');
        $userModel = $this->model('User');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
            $id_pesanan      = htmlspecialchars(trim($_POST['id_pesanan'] ?? ''));
            $id_user         = htmlspecialchars(trim($_POST['id_user'] ?? ''));
            $id_layanan      = htmlspecialchars(trim($_POST['id_layanan'] ?? ''));
            $ukuran_pakaian  = htmlspecialchars(trim($_POST['ukuran_pakaian'] ?? ''));
            $catatan         = htmlspecialchars(trim($_POST['catatan'] ?? ''));
            $status_pesanan  = htmlspecialchars(trim($_POST['status_pesanan'] ?? ''));
            $estimasi_harga  = htmlspecialchars(trim($_POST['estimasi_harga'] ?? ''));
            $opsi_bahan      = htmlspecialchars(trim($_POST['opsi_bahan'] ?? ''));
            $opsi_kerumitan  = htmlspecialchars(trim($_POST['opsi_kerumitan'] ?? ''));
            $harga_final     = htmlspecialchars(trim($_POST['harga_final'] ?? ''));
            $status_pembayaran = htmlspecialchars(trim($_POST['status_pembayaran'] ?? 'belum_bayar'));

            // Parse tanggal dari date-picker (format m/d/Y -> Y-m-d)
            $tgl_pesan_raw   = $_POST['tanggal_pesan'] ?? '';
            $tgl_selesai_raw = $_POST['tanggal_selesai'] ?? '';
            $tanggal_pesan   = !empty($tgl_pesan_raw) ? date('Y-m-d', strtotime($tgl_pesan_raw)) : '';
            $tanggal_selesai = !empty($tgl_selesai_raw) ? date('Y-m-d', strtotime($tgl_selesai_raw)) : '';

            $pesan_kesalahan = [];

            if (empty($id_user)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Pelanggan wajib dipilih";
            }
            if (empty($id_layanan)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Layanan wajib dipilih";
            }
            if (empty($ukuran_pakaian)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Ukuran Pakaian wajib dipilih";
            }
            if (empty($tanggal_pesan)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Tanggal Pesan wajib diisi";
            }
            if (empty($tanggal_selesai)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Tanggal Selesai wajib diisi";
            }
            if (empty($status_pesanan)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Status Pesanan wajib dipilih";
            }

            if (!empty($pesan_kesalahan)) {
                $_SESSION['validasi'] = implode('<br>', $pesan_kesalahan);
                header("Location: " . base_url('admin/data_pesanan/edit?id_pesanan=' . $id_pesanan));
                exit();
            } else {
                $pesananLama = $pesananModel->getPesananById($id_pesanan);
                $waktu_selesai = $pesananLama->waktu_selesai ?? null;
                $waktu_diambil = $pesananLama->waktu_diambil ?? null;

                if ($pesananLama->status_pesanan !== 'selesai' && $status_pesanan === 'selesai') {
                    $waktu_selesai = date('Y-m-d H:i:s');
                }
                if ($pesananLama->status_pesanan !== 'diambil' && $status_pesanan === 'diambil') {
                    $waktu_diambil = date('Y-m-d H:i:s');
                    // Jika melompat dari proses langsung ke diambil, catat juga waktu selesainya
                    if (empty($waktu_selesai)) {
                        $waktu_selesai = date('Y-m-d H:i:s');
                    }
                }

                $pesananModel->update([
                    'id_pesanan'      => $id_pesanan,
                    'id_user'         => $id_user,
                    'id_layanan'      => $id_layanan,
                    'ukuran_pakaian'  => $ukuran_pakaian,
                    'catatan'         => $catatan,
                    'tanggal_pesan'   => $tanggal_pesan,
                    'tanggal_selesai' => $tanggal_selesai,
                    'status_pesanan'  => $status_pesanan,
                    'waktu_selesai'   => $waktu_selesai,
                    'waktu_diambil'   => $waktu_diambil,
                    'estimasi_harga'  => empty($estimasi_harga) ? null : $estimasi_harga,
                    'opsi_bahan'      => empty($opsi_bahan) ? null : $opsi_bahan,
                    'opsi_kerumitan'  => empty($opsi_kerumitan) ? null : $opsi_kerumitan,
                    'harga_final'     => empty($harga_final) ? null : $harga_final,
                    'status_pembayaran' => $status_pembayaran,
                ]);

                // Jika ukuran Custom, update/insert data ukuran
                if ($ukuran_pakaian === 'Custom') {
                    $pesananModel->updateUkuranAtasan([
                        'id_pesanan'       => $id_pesanan,
                        'lingkar_dada'     => $_POST['lingkar_dada'] ?? 0,
                        'lingkar_pinggang' => $_POST['lingkar_pinggang_atasan'] ?? 0,
                        'lingkar_pinggul'  => $_POST['lingkar_pinggul_atasan'] ?? 0,
                        'lebar_bahu'       => $_POST['lebar_bahu'] ?? 0,
                        'panjang_lengan'   => $_POST['panjang_lengan'] ?? 0,
                        'lingkar_lengan'   => $_POST['lingkar_lengan'] ?? 0,
                        'panjang_baju'     => $_POST['panjang_baju'] ?? 0,
                        'lingkar_leher'    => $_POST['lingkar_leher'] ?? 0,
                        'model_fit'        => !empty($_POST['model_fit']) ? $_POST['model_fit'] : 'regular',
                        'kegunaan'         => !empty($_POST['kegunaan']) ? $_POST['kegunaan'] : 'santai',
                    ]);

                    $pesananModel->updateUkuranBawahan([
                        'id_pesanan'       => $id_pesanan,
                        'lingkar_pinggang' => $_POST['lingkar_pinggang_bawahan'] ?? 0,
                        'lingkar_pinggul'  => $_POST['lingkar_pinggul_bawahan'] ?? 0,
                        'panjang_celana'   => $_POST['panjang_celana'] ?? 0,
                        'lingkar_paha'     => $_POST['lingkar_paha'] ?? 0,
                        'lingkar_lutut'    => $_POST['lingkar_lutut'] ?? 0,
                        'lingkar_kaki'     => $_POST['lingkar_kaki'] ?? 0,
                        'tinggi_duduk'     => $_POST['tinggi_duduk'] ?? 0,
                    ]);
                } else {
                    // Jika bukan Custom, hapus data ukuran lama jika ada
                    $pesananModel->deleteUkuranByPesanan($id_pesanan);
                }

                $_SESSION['berhasil'] = 'Data Berhasil Diperbarui';
                header("Location: " . base_url('admin/data_pesanan/semuapesanan'));
                exit();
            }
        }

        if (!isset($_GET['id_pesanan'])) {
            header("Location: " . base_url('admin/data_pesanan/semuapesanan'));
            exit();
        }

        $pesanan = $pesananModel->getPesananById($_GET['id_pesanan']);

        if (!$pesanan) {
            header("Location: " . base_url('admin/data_pesanan/semuapesanan'));
            exit();
        }

        // Load ukuran custom jika ada
        $ukuran_atasan  = null;
        $ukuran_bawahan = null;
        if ($pesanan->ukuran_pakaian === 'Custom') {
            $ukuran_atasan  = $pesananModel->getUkuranAtasanByPesanan($pesanan->id_pesanan) ?: null;
            $ukuran_bawahan = $pesananModel->getUkuranBawahanByPesanan($pesanan->id_pesanan) ?: null;
        }

        $data = [
            'judul'          => 'Halaman Edit Pesanan',
            'no_preloader'   => true,
            'pesanan'        => $pesanan,
            'users'          => $userModel->getPelanggan(),
            'layanans'       => $layananModel->getActiveLayanan(),
            'ukuran_atasan'  => $ukuran_atasan,
            'ukuran_bawahan' => $ukuran_bawahan,
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_pesanan/edit', $data);
    }

    public function detail() {
        $this->checkAuth();

        if (!isset($_GET['id_pesanan'])) {
            header("Location: " . base_url('admin/data_pesanan/semuapesanan'));
            exit();
        }

        $pesananModel = $this->model('Pesanan');
        $pesanan = $pesananModel->getPesananById($_GET['id_pesanan']);

        if (!$pesanan) {
            header("Location: " . base_url('admin/data_pesanan/semuapesanan'));
            exit();
        }

        $data = [
            'judul'        => 'Halaman Detail Pesanan',
            'no_preloader' => true,
            'pesanan'      => $pesanan,
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_pesanan/detail', $data);
    }

    public function hapus() {
        $this->checkAuth();

        if (isset($_GET['id_pesanan'])) {
            $pesananModel = $this->model('Pesanan');
            $pesananModel->delete((int) $_GET['id_pesanan']);
            $_SESSION['berhasil'] = 'Data Berhasil Dihapus';
        }

        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('admin/data_pesanan/semuapesanan');
        header("Location: " . $redirect);
        exit();
    }

    public function updateStatus() {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pesanan']) && isset($_POST['status_pesanan'])) {
            $id_pesanan = (int)$_POST['id_pesanan'];
            $status_pesanan = htmlspecialchars(trim($_POST['status_pesanan']));
            
            $pesananModel = $this->model('Pesanan');
            $pesananLama = $pesananModel->getPesananById($id_pesanan);
            
            if ($pesananLama) {
                $waktu_selesai = $pesananLama->waktu_selesai;
                $waktu_diambil = $pesananLama->waktu_diambil;

                if ($pesananLama->status_pesanan !== 'selesai' && $status_pesanan === 'selesai') {
                    $waktu_selesai = date('Y-m-d H:i:s');
                }
                if ($pesananLama->status_pesanan !== 'diambil' && $status_pesanan === 'diambil') {
                    $waktu_diambil = date('Y-m-d H:i:s');
                    if (empty($waktu_selesai)) {
                        $waktu_selesai = date('Y-m-d H:i:s');
                    }
                }

                $pesananModel->update([
                    'id_pesanan'      => $pesananLama->id_pesanan,
                    'id_user'         => $pesananLama->id_user,
                    'id_layanan'      => $pesananLama->id_layanan,
                    'ukuran_pakaian'  => $pesananLama->ukuran_pakaian,
                    'catatan'         => $pesananLama->catatan,
                    'tanggal_pesan'   => $pesananLama->tanggal_pesan,
                    'tanggal_selesai' => $pesananLama->tanggal_selesai,
                    'status_pesanan'  => $status_pesanan,
                    'waktu_selesai'   => $waktu_selesai,
                    'waktu_diambil'   => $waktu_diambil,
                    'estimasi_harga'  => $pesananLama->estimasi_harga,
                    'opsi_bahan'      => $pesananLama->opsi_bahan,
                    'opsi_kerumitan'  => $pesananLama->opsi_kerumitan,
                    'harga_final'     => $pesananLama->harga_final ?? null,
                    'status_pembayaran' => $pesananLama->status_pembayaran ?? 'belum_bayar',
                ]);
                
                $_SESSION['berhasil'] = 'Status Pesanan Berhasil Diperbarui';
            }
        }

        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('admin/data_pesanan/semuapesanan');
        header("Location: " . $redirect);
        exit();
    }

    public function pesananmenunggu() {
        $this->checkAuth();

        $pesananModel = $this->model('Pesanan');
        $pesanans = $pesananModel->getPesananByStatus('menunggu');

        $data = [
            'judul'        => 'Halaman Menunggu Pesanan',
            'no_preloader' => true,
            'pesanans'     => $pesanans,
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_pesanan/pesananmenunggu', $data);
    }

    public function pesanandiproses() {
        $this->checkAuth();

        $pesananModel = $this->model('Pesanan');
        $pesanans = $pesananModel->getPesananByStatus('proses');

        $data = [
            'judul'        => 'Halaman Pesanan Diproses',
            'no_preloader' => true,
            'pesanans'     => $pesanans,
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_pesanan/pesanandiproses', $data);
    }

    public function pesananselesaidiambil() {
        $this->checkAuth();

        $pesananModel = $this->model('Pesanan');

        // Gabungkan selesai & diambil
        $pesananModel->getDb()->query("
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
            WHERE pesanan.status_pesanan IN ('selesai', 'diambil')
            ORDER BY pesanan.id_pesanan DESC
        ");
        $pesanans = $pesananModel->getDb()->resultSet();

        $data = [
            'judul'        => 'Halaman Pesanan Selesai / Diambil',
            'no_preloader' => true,
            'pesanans'     => $pesanans,
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_pesanan/pesananselesaidiambil', $data);
    }
}

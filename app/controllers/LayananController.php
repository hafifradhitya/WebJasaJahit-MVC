<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class LayananController extends Controller {
    private function checkAuth() {
        if (!isset($_SESSION['login'])) {
            header("Location: " . base_url('auth/login?pesan=belum_login'));
        } elseif ($_SESSION["role"] != 'admin') {
            header("Location: " . base_url('auth/login?pesan=tolak_akses'));
            exit;
        }
    }

    public function index() {
        $this->checkAuth();

        $layananModel = $this->model('Layanan');
        $layanans = $layananModel->getActiveLayananWithKategori();

        // var_dump($layanans);
        // die();

        $data = [
            'judul'     => 'Halaman Data Layanan',
            'no_preloader' => true,
            'layanans' => $layanans,
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_layanan/layanan', $data);
    }  

    public function tambah() {
        $this->checkAuth();
        $layananModel = $this->model('Layanan');
        $layanans = $layananModel->getAllLayanan();
        $kategoriModel = $this->model('Kategori');

        // var_dump($layanans);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $nama_layanan = htmlspecialchars(trim($_POST['nama_layanan'] ?? ''));
            $deskripsi = htmlspecialchars(trim($_POST['deskripsi'] ?? ''));
            $harga_mulai = htmlspecialchars(trim($_POST['harga_mulai'] ?? ''));
            $estimasi_hari = htmlspecialchars(trim($_POST['estimasi_hari'] ?? ''));
            $status = htmlspecialchars(trim($_POST['status'] ?? ''));
            $id_kategori = htmlspecialchars(trim($_POST['id_kategori'] ?? ''));
            $foto = '';

            $nama_file = "default.png";
            $pesan_kesalahan = [];
 
            // var_dump([
            //     $_FILES['foto'],
            //     $_FILES['foto']['name'],
            //     $_FILES['foto']['tmp_name'],
            //     $_FILES['foto']['size'],
            //     $_FILES['foto']['error'],
            // ]);

            if (isset($_FILES['foto']) && $_FILES['foto']['error'] != 4) {
                $file = $_FILES['foto'];
                $nama_file = $file['name'];  
                $file_tmp = $file['tmp_name'];
                $ukuran_file = $file['size'];
                $file_direktori = UPLOAD_PATH . "layanan/" . $nama_file;

                $foto = $nama_file;
                
                $ambil_ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
                $ekstensi_diizinkan = ["jpg", "png", "jpeg"];
                $max_ukuran_file = 10 * 1024 * 1024;
                
                if (!in_array(strtolower($ambil_ekstensi), $ekstensi_diizinkan)) {
                    $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> Hanya file JPG, JPEG dan PNG yang diperbolehkan";
                }
                
                if ($ukuran_file > $max_ukuran_file) {
                    $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> Ukuran file melebihi 10 MB";
                }

                if (empty($pesan_kesalahan)) {
                    @move_uploaded_file($file_tmp, $file_direktori);
                }
            }

            if (empty($nama_layanan)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Nama Layanan wajib diisi";
            }

            if (empty($deskripsi)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Deskripsi wajib diisi";
            }

            if (empty($harga_mulai)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Harga Mulai wajib diisi";
            }

            if (empty($estimasi_hari)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Estimasi Hari wajib diisi";
            }

            if (empty($status)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Status wajib diisi";
            }

            if (empty($id_kategori)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Kategori wajib diisi";
            }

            if (empty($foto)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Foto wajib diisi";
            }

            if (!empty($pesan_kesalahan)) {
                $_SESSION['validasi'] = implode("<br>", $pesan_kesalahan);
            } else {
                $data = [
                    'nama_layanan' => $nama_layanan,
                    'deskripsi' => $deskripsi,
                    'harga_mulai' => $harga_mulai,
                    'estimasi_hari' => $estimasi_hari,
                    'status' => $status,
                    'id_kategori' => $id_kategori,
                    'foto' => $nama_file,
                ];

                // var_dump($data);
                // die();

                $layananModel->insert($data);
                $_SESSION['berhasil'] = "Data berhasil disimpan";
                header("Location: " . base_url('admin/data_layanan/layanan'));
                exit;
            }
        }

        $data = [
            'judul' => 'Halaman Tambah Data Layanan',
            'no_preloader' => true,
            'kategoris' => $kategoriModel->getAllKategori(),
            'layanans' => $layananModel->getAllLayanan(),
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_layanan/tambah', $data);
    }

    public function edit() {
        $this->checkAuth();
        $layananModel = $this->model('Layanan');
        $kategoriModel = $this->model('Kategori');

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
            $id_layanan = htmlspecialchars(trim($_POST['id_layanan'] ?? ''));
            $nama_layanan = htmlspecialchars(trim($_POST['nama_layanan'] ?? ''));
            $deskripsi = htmlspecialchars(trim($_POST['deskripsi'] ?? ''));
            $harga_mulai = htmlspecialchars(trim($_POST['harga_mulai'] ?? ''));
            $estimasi_hari = htmlspecialchars(trim($_POST['estimasi_hari'] ?? ''));
            $status = htmlspecialchars(trim($_POST['status'] ?? ''));
            $id_kategori = htmlspecialchars(trim($_POST['id_kategori'] ?? ''));
            $foto_lama = htmlspecialchars(trim($_POST['foto_lama'] ?? ''));

            $nama_file = $foto_lama; // default: pakai foto lama
            $pesan_kesalahan = [];

            // Proses upload foto baru jika ada
            if (isset($_FILES['foto_baru']) && $_FILES['foto_baru']['error'] != 4) {
                $file = $_FILES['foto_baru'];
                $nama_file_baru = $file['name'];
                $file_tmp = $file['tmp_name'];
                $ukuran_file = $file['size'];
                $file_direktori = UPLOAD_PATH . "layanan/" . $nama_file_baru;

                $ambil_ekstensi = pathinfo($nama_file_baru, PATHINFO_EXTENSION);
                $ekstensi_diizinkan = ["jpg", "png", "jpeg"];
                $max_ukuran_file = 10 * 1024 * 1024;

                if (!in_array(strtolower($ambil_ekstensi), $ekstensi_diizinkan)) {
                    $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Hanya file JPG, JPEG dan PNG yang diperbolehkan";
                }

                if ($ukuran_file > $max_ukuran_file) {
                    $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Ukuran file melebihi 10 MB";
                }

                if (empty($pesan_kesalahan)) {
                    @move_uploaded_file($file_tmp, $file_direktori);
                    $nama_file = $nama_file_baru;
                }
            }

            if (empty($nama_layanan)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Nama Layanan wajib diisi";
            }

            if (empty($deskripsi)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Deskripsi wajib diisi";
            }

            if (empty($harga_mulai)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Harga Mulai wajib diisi";
            }

            if (empty($estimasi_hari)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Estimasi Hari wajib diisi";
            }

            if (empty($status)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Status wajib diisi";
            }

            if (empty($id_kategori)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Kategori wajib diisi";
            }

            if (!empty($pesan_kesalahan)) {
                $_SESSION['validasi'] = implode('<br>', $pesan_kesalahan);
                header("Location: " . base_url('admin/data_layanan/edit?id_layanan=' . $id_layanan));
                exit();
            } else {
                $data = [
                    'id_layanan' => $id_layanan,
                    'nama_layanan' => $nama_layanan,
                    'deskripsi' => $deskripsi,
                    'harga_mulai' => $harga_mulai,
                    'estimasi_hari' => $estimasi_hari,
                    'status' => $status,
                    'id_kategori' => $id_kategori,
                    'foto' => $nama_file,
                ];

                $layananModel->update($data);
                $_SESSION['berhasil'] = 'Data Berhasil Diperbarui';
                header("Location: " . base_url('admin/data_layanan/layanan'));
                exit();
            }
        }

        if (!isset($_GET['id_layanan'])) {
            header("Location: " . base_url('admin/data_layanan/layanan'));
            exit();
        }

        $layanan = $layananModel->getLayananById($_GET['id_layanan']);

        if (!$layanan) {
            header("Location: " . base_url('admin/data_layanan/layanan'));
            exit();
        }

        $data = [
            'judul' => 'Halaman Edit Data Layanan',
            'no_preloader' => true,
            'layanan' => $layanan,
            'kategoris' => $kategoriModel->getAllKategori(),
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_layanan/edit', $data);
    }

    public function detail() {
        $this->checkAuth();
        if (!isset($_GET['id_layanan'])) {
            header("Location: " . base_url('admin/data_layanan/layanan'));
        }

        $layananModel = $this->model('Layanan');
        $kategoriModel = $this->model('Kategori');

        $layanan = $layananModel->getLayananById($_GET['id_layanan']);
        $kategori = $kategoriModel->getKategoriById($layanan['id_kategori']);

        $data = [
            'judul' => 'Halaman Detail Data Layanan',
            'no_preloader' => true,
            'layanan' => $layanan,
            'kategori' => $kategori,
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_layanan/detail', $data);
    }
  
    public function hapus() {
        $this->checkAuth();
        if (isset($_GET['id_layanan'])) {
            $layananModel = $this->model('Layanan');
            $layananModel->delete((int)$_GET['id_layanan']);
            $_SESSION['berhasil'] = 'Data berhasil dihapus';
        }

        header("Location: " . base_url('admin/data_layanan/layanan'));
    }
}
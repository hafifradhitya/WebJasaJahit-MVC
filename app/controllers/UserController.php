<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class UserController extends Controller {

    private function checkAuth() {
        if (!isset($_SESSION['login'])) {
            http_response_code(404);
            $this->view('errors/404');
            exit();
        } else if ($_SESSION["role"] != 'admin') {
            http_response_code(404);
            $this->view('errors/404');
            exit();
        }
    }

    public function index() {
        $this->checkAuth();

        $pelangganModel = $this->model('User');
        $users = $pelangganModel->getAllUsers();

        $data = [
            'judul' => 'Halaman Data Pelanggan',
            'no_preloader' => true,
            'users' => $users
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_pelanggan/pelanggan', $data);
    }

    public function tambah() {
        $this->checkAuth();
        $pelangganModel = $this->model('User');

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $roleInputValue = isset($_POST['role']) ? htmlspecialchars($_POST['role']) : '';
            $prefix = ($roleInputValue === 'Admin') ? 'ADM-' : 'CUST-';

            $lastCodeRow = $pelangganModel->getLastUserCode($prefix);
            if ($lastCodeRow) {
                $kode_user_db = $lastCodeRow->kode_user;
                $parts = explode("-", $kode_user_db);
                $angka = isset($parts[1]) ? (int)$parts[1] : 0;
                $kode_user_baru = $prefix . str_pad($angka + 1, 4, "0", STR_PAD_LEFT);
            } else {
                $kode_user_baru = $prefix . "0001";
            }

            $kode_user = $kode_user_baru;
            $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
            $email = htmlspecialchars($_POST['email']);
            $status = htmlspecialchars($_POST['status']);
            $no_telepon = htmlspecialchars($_POST['no_telepon']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = htmlspecialchars($_POST['role']);

            $nama_file = "default.png";
            $ukuran_file = 0;
            $pesan_kesalahan = [];

            if (isset($_FILES['foto']) && $_FILES['foto']['error'] != 4) {
                $file = $_FILES['foto'];
                $nama_file = $file['name'];
                $file_tmp = $file['tmp_name'];
                $ukuran_file = $file['size'];
                
                // Assuming public/img/foto_pelanggan for static resource
                $file_direktori = __DIR__ . "/../../../public/img/foto_pelanggan/" . $nama_file;

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

            if (empty($nama_lengkap)) $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> Nama Lengkap wajib diisi";
            if (empty($email)) $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> Email wajib diisi";
            if (empty($status)) $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> Status wajib diisi";
            if (empty($no_telepon)) $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> No. Telepon wajib diisi";
            if (empty($role)) $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> Role wajib diisi";
            if (empty($_POST['password'])) $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> Password wajib diisi";
            if ($_POST['password'] != $_POST['ulangi_password']) $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> Password tidak cocok";

            if (!empty($pesan_kesalahan)) {
                $_SESSION['validasi'] = implode("<br>", $pesan_kesalahan);
            } else {
                $data = [
                    'kode_user' => $kode_user,
                    'nama_lengkap' => $nama_lengkap,
                    'email' => $email,
                    'status' => $status,
                    'no_telepon' => $no_telepon,
                    'password' => $password,
                    'role' => $role,
                    'foto' => $nama_file
                ];
                $pelangganModel->insert($data);
                $_SESSION['berhasil'] = 'Data berhasil disimpan';
                header("Location: " . base_url('admin/data_pelanggan/pelanggan'));
                exit();
            }
        }

        $data = [
            'judul' => 'Halaman Tambah Data Pelanggan',
            'no_preloader' => true
        ];
        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_pelanggan/tambah', $data);
    }

    public function edit() {

        $this->checkAuth();
        $pelangganModel = $this->model('User');

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['method']) == "edit") {
            $kode_user = $_POST['kode_user'];
            $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
            $email = htmlspecialchars($_POST['email']);
            $status = htmlspecialchars($_POST['status']);
            $no_telepon = htmlspecialchars($_POST['no_telepon']);
            $role = htmlspecialchars($_POST['role']);
            $password = $_POST['password_lama'];
            
            if (!empty($_POST['password'])) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
            
            $nama_file = $_POST['foto_lama'];
            $pesan_kesalahan = [];

            if (isset($_FILES['foto_baru']) && $_FILES['foto_baru']['error'] != 4) {
                $file = $_FILES['foto_baru'];
                $nama_file = $file['name'];
                $file_tmp = $file['tmp_name'];
                $ukuran_file = $file['size'];
                $file_direktori = UPLOAD_PATH . "foto_pelanggan/" . $nama_file;
                
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

            if(empty($nama_lengkap)) $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> Nama Lengkap wajib diisi";
            if(empty($email)) $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> Email wajib diisi";
            if(empty($status)) $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> Status wajib diisi";
            if(empty($no_telepon)) $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> No. telepon wajib diisi";
            if(empty($role)) $pesan_kesalahan[] = "<i class='fa-solid fa-check'></i> Role wajib diisi";
            if(!empty($_POST['password']) && $_POST['password'] != $_POST['ulangi_password']) {
                $pesan_kesalahan[] = "<i class='fa-solid fa fa-check'></i> Password tidak cocok";
            }

            if (!empty($pesan_kesalahan)) {
                $_SESSION['validasi'] = implode("<br>", $pesan_kesalahan);
                header("Location: " . base_url('admin/data_pelanggan/edit?kode_user=' . urlencode($kode_user)));
                exit();
            } else {
                $data = [
                    'nama_lengkap' => $nama_lengkap,
                    'email' => $email,
                    'status' => $status,
                    'no_telepon' => $no_telepon,
                    'password' => $password,
                    'role' => $role,
                    'foto' => $nama_file
                ];
                $pelangganModel->update($data, $kode_user);

                $_SESSION['berhasil'] = 'Data berhasil diupdate';
                header("Location: " . base_url('admin/data_pelanggan/pelanggan'));
                exit();
            }
        }

        $kode_user = isset($_GET['kode_user']) ? $_GET['kode_user'] : '';
        if (empty($kode_user)) {
             header("Location: " . base_url('admin/data_pelanggan/pelanggan'));
             exit();
        }

        $user = $pelangganModel->getUserByKode($kode_user);

        if (!$user) {
            header("Location: " . base_url('admin/data_pelanggan/pelanggan'));
            exit();
        }

        $data = [
            'judul' => 'Halaman Edit Data Pelanggan',
            'no_preloader' => true,
            'user' => $user
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_pelanggan/edit', $data);
    }

    public function submitEdit() {
        echo json_encode([]);
    }

    public function detail() {
        $this->checkAuth();
        if (!isset($_GET['kode_user'])) {
            header("Location: " . base_url('admin/data_pelanggan/pelanggan'));
            exit;
        }

        $pelangganModel = $this->model('User');
        $user = $pelangganModel->getUserByKode($_GET['kode_user']);

        if (!$user) {
            header("Location: " . base_url('admin/data_pelanggan/pelanggan'));
            exit;
        }

        $data = [
            'judul' => 'Detail Pelanggan',
            'no_preloader' => false,
            'user' => $user
        ];

        $GLOBALS['judul'] = $data['judul'];
        $this->view('admin/data_pelanggan/detail', $data);
    }

    public function hapus() {
        $this->checkAuth();
        if (isset($_GET['id_user'])) {  
            $pelangganModel = $this->model('User');
            $pelangganModel->delete((int)$_GET['id_user']);
            $_SESSION['berhasil'] = 'Data berhasil dihapus';
        }
        
        header("Location: " . base_url('admin/data_pelanggan/pelanggan'));
        exit();
    }
}

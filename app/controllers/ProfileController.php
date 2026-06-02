<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class ProfileController extends Controller {

    private function checkAuth() {
        if (!isset($_SESSION['login'])) {
            header("Location: " . base_url('auth/login?pesan=belum_login'));
            exit();
        }
    }

    public function index() {
        $this->checkAuth();
        $profileModel = $this->model('Profile');
        $id_user = $_SESSION['id_user'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
            $nama = htmlspecialchars($_POST['nama_lengkap']);
            $email = htmlspecialchars($_POST['email']);
            $telp = htmlspecialchars($_POST['no_telepon']);
            
            $data = [
                'id_user' => $id_user,
                'nama_lengkap' => $nama,
                'email' => $email,
                'no_telepon' => $telp
            ];

            if (!empty($_FILES['foto']['name'])) {
                $foto_name = time() . '_' . basename($_FILES['foto']['name']);
                $tmp = $_FILES['foto']['tmp_name'];
                
                // Pastikan folder img ada, karena file asli user di assets dipindah ke public/img
                $dir = __DIR__ . "/../../../public/img/foto_pelanggan/";

                if (!is_dir($dir)) {
                    @mkdir($dir, 0777, true);
                }

                if (move_uploaded_file($tmp, $dir . $foto_name)) {
                    $data['foto'] = $foto_name;
                    $_SESSION['foto'] = $foto_name;
                }
            }

            if ($profileModel->updateProfile($data)) {
                $_SESSION['berhasil'] = 'Data berhasil diupdate.';
                $_SESSION['nama_lengkap'] = $nama;
                $_SESSION['email'] = $email;
                $_SESSION['no_telepon'] = $telp;
            }

            header("Location: " . base_url('admin/profile'));
            exit();
        }

        $user = $profileModel->getUserById($id_user);

        $data = [
            'judul' => 'Halaman Profile',
            'no_preloader' => true,
            'user' => $user
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/profile/index', $data);
    }

    public function ubahPassword() {
        $this->checkAuth();
        $id_user = $_SESSION['id_user'];
        $profileModel = $this->model('Profile');

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            $password_baru = $_POST['password_baru'];
            $ulangi_password_baru = $_POST['ulangi_password_baru'];

            $pesan_kesalahan = [];

            if (empty($password_baru)) {
                $pesan_kesalahan[] = "<i class='fa fa-times'></i> Password baru wajib diisi";
            }
            if (empty($ulangi_password_baru)) {
                $pesan_kesalahan[] = "<i class='fa fa-times'></i> Ulangi password baru wajib diisi";
            }
            if ($password_baru !== $ulangi_password_baru) {
                $pesan_kesalahan[] = "<i class='fa fa-times'></i> Password tidak cocok";
            }

            if (!empty($pesan_kesalahan)) {
                $_SESSION['validasi'] = implode("<br>", $pesan_kesalahan);
            } else {
                $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
                $profileModel->updatePassword($id_user, $password_hash);
                $_SESSION['berhasil'] = 'Password berhasil diubah';
                header("Location: " . base_url('admin/profile/ubah_password'));
                exit();
            }
        }

        $data = [
            'judul' => 'Ubah Password',
            'no_preloader' => true
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/profile/ubah_password', $data);
    }
}

<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class ProfileController extends Controller {

    private function checkAuth() {
        if (!isset($_SESSION['login'])) {
            http_response_code(404);
            $this->view('errors/404');
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
            
            $password_baru = $_POST['password_baru'] ?? '';
            $ulangi_password_baru = $_POST['ulangi_password_baru'] ?? '';
            
            $data = [
                'id_user' => $id_user,
                'nama_lengkap' => $nama,
                'email' => $email,
                'no_telepon' => $telp
            ];

            if (!empty($password_baru) || !empty($ulangi_password_baru)) {
                if ($password_baru !== $ulangi_password_baru) {
                    $_SESSION['validasi'] = "<i class='fa fa-times'></i> Password tidak cocok!";
                    header("Location: " . base_url('admin/profile'));
                    exit();
                } else {
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
                    $profileModel->updatePassword($id_user, $password_hash);
                }
            }

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
                $_SESSION['berhasil'] = 'Data profile ' . (!empty($password_baru) ? '& password ' : '') . 'berhasil diupdate.';
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

}

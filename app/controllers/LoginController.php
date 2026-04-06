<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class LoginController extends Controller {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
            $identitas = $_POST['identitas'];
            $password = $_POST['password'];

            $loginModel = $this->model('Login');
            $user = $loginModel->getUserByEmailOrPhone($identitas);

            if ($user) {
                if (password_verify($password, $user->password)) {
                    if ($user->status == 'Aktif') {
                        $_SESSION['login'] = true;
                        $_SESSION['id_user'] = $user->id_user;
                        $_SESSION['role'] = $user->role;
                        $_SESSION['nama_lengkap'] = $user->nama_lengkap;
                        $_SESSION['no_telepon'] = $user->no_telepon;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['foto'] = $user->foto;

                        // Redirect based on role
                        if ($user->role === 'admin') {
                            header("Location: " . base_url('admin/dashboard/dashboard'));
                            exit();
                        } else {
                            header("Location: " . base_url('beranda'));
                            exit();
                        }
                    } else {
                        $_SESSION["gagal"] = "Akun Anda belum aktif";
                    }
                } else {
                    $_SESSION["gagal"] = "Password salah, silahkan coba lagi";
                }
            } else {
                $_SESSION["gagal"] = "Username/Email salah, silahkan coba lagi";
            }
        }

        // Render the login view
        $this->view('auth/login');
    }
}

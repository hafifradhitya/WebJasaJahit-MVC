<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class LoginController extends Controller {
    public function generateToken() {
        // Generate a random 16 character string
        $token = bin2hex(random_bytes(8));
        $_SESSION['admin_login_token'] = $token;
        
        // Redirect to the secret URL
        header("Location: " . base_url($token));
        exit();
    }

    public function index() {
        // Prevent access if token is not set
        if (!isset($_SESSION['admin_login_token'])) {
            http_response_code(404);
            $this->view('errors/404');
            exit();
        }
        $this->view('auth/admin_login');
    }

    public function login() {
        if (!isset($_SESSION['admin_login_token'])) {
            http_response_code(404);
            $this->view('errors/404');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
            $identitas = $_POST['identitas'];
            $password = $_POST['password'];

            $loginModel = $this->model('Login');
            $user = $loginModel->getUserByEmailOrPhone($identitas);

            if ($user && $user->role === 'admin') {
                if (password_verify($password, $user->password)) {
                    if ($user->status == 'Aktif') {
                        $_SESSION['login'] = true;
                        $_SESSION['id_user'] = $user->id_user;
                        $_SESSION['role'] = $user->role;
                        $_SESSION['nama_lengkap'] = $user->nama_lengkap;
                        $_SESSION['no_telepon'] = $user->no_telepon;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['foto'] = $user->foto;

                        header("Location: " . base_url('admin/dashboard/dashboard'));
                        exit();
                    } else {
                        $_SESSION["gagal"] = "Akun Admin Anda belum aktif";
                    }
                } else {
                    $_SESSION["gagal"] = "Password salah, silahkan coba lagi";
                }
            } else {
                $_SESSION["gagal"] = "Kredensial Admin salah atau tidak memiliki akses";
            }
        }

        $this->view('auth/admin_login');
    }
}

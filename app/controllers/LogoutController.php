<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class LogoutController extends Controller {
    public function logout() {
        /* Kosongkan semua session */
        $_SESSION = [];

        /* Hapus session */
        session_unset();
        session_destroy();

        /* Redirect */
        header("Location: " . base_url('auth/login'));
        exit();
    }
}
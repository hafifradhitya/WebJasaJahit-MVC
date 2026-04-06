<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

// Menghubungkan autoloader untuk PHPMailer, sesuaikan dengan path instalasi composer di project MVC ini
$autoloadPath = __DIR__ . '/../../vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RegisterController extends Controller {
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
            $registerModel = $this->model('Register');

            // Handling the role safely if it's not present in the form
            $roleInputValue = isset($_POST['role']) ? htmlspecialchars($_POST['role']) : 'Pelanggan';
            $prefix = ($roleInputValue === 'Pelanggan') ? 'ADM-' : 'CUST-';

            $lastCodeRow = $registerModel->getLastUserCode($prefix);
            if ($lastCodeRow) {
                // PDO fetch object syntax
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
            $no_telepon = htmlspecialchars($_POST['no_telepon']);
            $password = $_POST['password'];

            /* CEK NO TELEPON SUDAH ADA ATAU BELUM */
            if ($registerModel->checkPhoneExists($no_telepon)) {
                $_SESSION['gagal'] = "Nomor telepon sudah terdaftar";
                header("Location: " . base_url('auth/register'));
                exit();
            }

            /* HASH PASSWORD */
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            /* DEFAULT VALUE */
            $role_db = 'pelanggan';
            $foto = 'default.png';
            $kode_aktivasi = md5($email);

            $data = [
                'kode_user' => $kode_user,
                'nama_lengkap' => $nama_lengkap,
                'email' => $email,
                'no_telepon' => $no_telepon,
                'password' => $password_hash,
                'kode_aktivasi' => $kode_aktivasi,
                'role' => $role_db,
                'status' => 'Tidak Aktif',
                'foto' => $foto
            ];

            /* INSERT USER */
            if ($registerModel->insertUser($data)) {
                // Konfigurasi dan pengiriman Email PHP Mailer
                if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
                    $mail = new PHPMailer(true);

                    try {
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'radhityahafifofficial@gmail.com';
                        $mail->Password   = 'kayy bbtu vedz mfcd';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port       = 587;

                        $mail->setFrom('radhityahafifofficial@gmail.com', 'Web Jasa Jahit');
                        $mail->addAddress($email, $nama_lengkap);

                        $mail->isHTML(true);
                        $mail->Subject = 'Verifikasi Akun - Web Jasa Jahit';
                        
                        // Buat link dinamis menggunakan base_url
                        $activationLink = base_url('auth/verifikasi?kode=' . $kode_aktivasi);

                        $mail->Body    = "
                        <h3>Halo $nama_lengkap 👋</h3>
                        <p>Akun kau berhasil dibuat.</p>
                        <p>Silakan klik link berikut untuk aktivasi:</p>
                        <a href='$activationLink'>
                            Aktifkan Akun
                        </a>";

                        $mail->send();

                        $_SESSION['berhasil'] = 'Registrasi berhasil, silakan cek email';
                        header("Location: " . base_url('beranda'));
                        exit();
                    } catch (Exception $e) {
                        $_SESSION['gagal'] = 'Registrasi berhasil, tapi email gagal dikirim';
                        header("Location: " . base_url('beranda'));
                        exit();
                    }
                } else {
                    // Fallback jika PHPMailer tidak ditenmukan
                    $_SESSION['berhasil'] = 'Registrasi berhasil, tetapi vendor mailer tidak bisa di-load.';
                    header("Location: " . base_url('beranda'));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = 'Gagal menyimpan data ke database';
                header("Location: " . base_url('auth/register'));
                exit();
            }
        }

        $this->view('auth/register');
    }
}

<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/traits/ApiResponseTrait.php';
require_once __DIR__ . '/../models/Kategori.php';
require_once __DIR__ . '/../models/Layanan.php';

class BerandaController extends Controller
{
    use ApiResponseTrait;
    private Kategori $kategoriModel;
    private Layanan $layananModel;

    public function __construct(Database $db)
    {
        parent::__construct($db); // optional if parent has __construct
        $this->kategoriModel = new Kategori($db);
        $this->layananModel = new Layanan($db);
    }

    public function index(): void
    {
        $kategori_objects = $this->kategoriModel->getAllKategori();
        $layanan_objects = $this->layananModel->getActiveLayananWithKategori();

        // Convert array of objects to array of associative arrays for legacy view compatibility
        $kategori_array = json_decode(json_encode($kategori_objects), true);
        $layanan_raw = json_decode(json_encode($layanan_objects), true);

        // Group layanan by id_kategori
        $layanan_by_kategori = [];
        if (is_array($layanan_raw)) {
            foreach ($layanan_raw as $row) {
                $layanan_by_kategori[$row['id_kategori']][] = $row;
            }
        }

        $data = [
            'kategori_array' => $kategori_array ?? [],
            'layanan_by_kategori' => $layanan_by_kategori
        ];

        $this->view('front/beranda', $data);
    }

    public function detail_layanan(): void
    {
        $slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

        $layanan = $this->layananModel->getActiveLayananDetailBySlug($slug);

        if (!$layanan) {
            header("Location: " . base_url('front/beranda.php#jasa'));
            exit;
        }

        // Convert object to array for view compatibility if needed
        $layanan_array = json_decode(json_encode($layanan), true);

        // Default arah tombol pesan
        $link_pesan = base_url('auth/login.php');
        $is_pelanggan = false;

        if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'pelanggan') {
                $is_pelanggan = true;
                $link_pesan = '#';
            } else {
                $link_pesan = base_url('front/beranda.php?error=akses');
            }
        }

        // Default gambar jika tidak ada
        $foto = !empty($layanan_array['foto'])
            ? base_url('public/img/layanan/' . $layanan_array['foto'])
            : base_url('public/img/layanan/orang-lagi-menjahit-kain.jpg');

        $data = [
            'layanan' => $layanan_array,
            'link_pesan' => $link_pesan,
            'is_pelanggan' => $is_pelanggan,
            'foto' => $foto
        ];

        $this->view('front/detail_layanan', $data);
    }

    public function sendEmail(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $nama = htmlspecialchars($_POST['nama'] ?? '');
            $pesan = htmlspecialchars($_POST['pesan'] ?? '');

            $to = 'radhityahafifofficial@gmail.com';
            $subject = 'Penawaran Kerja Sama Bisnis dari ' . $nama;

            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'radhityahafifofficial@gmail.com'; // Ganti jika email pengirim beda
                $mail->Password = 'ahljjlzrsebveyru'; // WAJIB DIGANTI dengan App Password Google
                $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS; // Gunakan SMTPS (port 465)
                $mail->Port = 465;

                // Recipients
                $mail->setFrom('radhityahafifofficial@gmail.com', 'Web Jasa Jahit');
                $mail->addAddress($to);
                $mail->addReplyTo($email, $nama);

                // Content
                $mail->isHTML(false);
                $mail->Subject = $subject;
                $mail->Body = "Nama/Instansi: " . $nama . "\nEmail: " . $email . "\n\nPesan Penawaran:\n" . $pesan;

                $mail->send();
                $_SESSION['berhasil'] = "Pesan penawaran kerja sama berhasil dikirim!";
            } catch (\Exception $e) {
                $_SESSION['berhasil'] = "Gagal mengirim pesan. Mailer Error: {$mail->ErrorInfo}";
            }

            header("Location: " . base_url('beranda#kontak'));
            exit;
        }
    }
}
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
        $id_layanan = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $layanan = $this->layananModel->getActiveLayananDetailById($id_layanan);

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
}
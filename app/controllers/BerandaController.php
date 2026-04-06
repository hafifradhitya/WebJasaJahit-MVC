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
}
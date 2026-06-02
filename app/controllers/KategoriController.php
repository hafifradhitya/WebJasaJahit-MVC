<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

class KategoriController extends Controller {

    private function checkAuth() {
        if (!isset($_SESSION['login'])) {
            header("Location: " . base_url('auth/login?pesan=belum_login'));
            exit;
        } elseif ($_SESSION["role"] != 'admin') {
            header("Location: " . base_url('auth/login?pesan=tolak_akses'));
            exit;
        }
    }

    public function index() {
        $this->checkAuth();

        $kategoriModel = $this->model('Kategori');
        $kategoris = $kategoriModel->getAllKategori();

        $data = [
            'judul'        => 'Halaman Data Kategori',
            'no_preloader' => true,
            'kategoris'    => $kategoris,
        ];

        $GLOBALS['judul']        = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_kategori/kategori', $data);
    }

    public function tambah() {
        $this->checkAuth();
        $kategoriModel = $this->model('Kategori');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $nama_kategori  = htmlspecialchars(trim($_POST['nama_kategori'] ?? ''));
            $pesan_kesalahan = [];

            if (empty($nama_kategori)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Nama Kategori wajib diisi";
            }

            if (!empty($pesan_kesalahan)) {
                $_SESSION['validasi'] = implode('<br>', $pesan_kesalahan);
            } else {
                $kategoriModel->insert(['nama_kategori' => $nama_kategori]);
                $_SESSION['berhasil'] = 'Data kategori berhasil disimpan';
                header("Location: " . base_url('admin/data_kategori/index'));
                exit();
            }
        }

        $data = [
            'judul'        => 'Halaman Tambah Data Kategori',
            'no_preloader' => true,
        ];

        $GLOBALS['judul']        = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_kategori/tambah', $data);
    }

    public function edit() {
        $this->checkAuth();
        $kategoriModel = $this->model('Kategori');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['method']) && $_POST['method'] === 'edit') {
            $id_kategori   = (int)($_POST['id_kategori'] ?? 0);
            $nama_kategori = htmlspecialchars(trim($_POST['nama_kategori'] ?? ''));
            $pesan_kesalahan = [];

            if (empty($nama_kategori)) {
                $pesan_kesalahan[] = "<i class='fa fa-times-circle'></i> Nama Kategori wajib diisi";
            }

            if (!empty($pesan_kesalahan)) {
                $_SESSION['validasi'] = implode('<br>', $pesan_kesalahan);
                header("Location: " . base_url('admin/data_kategori/edit?id_kategori=' . $id_kategori));
                exit();
            } else {
                $kategoriModel->update([
                    'id_kategori'  => $id_kategori,
                    'nama_kategori' => $nama_kategori,
                ]);
                $_SESSION['berhasil'] = 'Data berhasil diupdate';
                header("Location: " . base_url('admin/data_kategori/kategori'));
                exit();
            }
        }

        $id_kategori = isset($_GET['id_kategori']) ? (int)$_GET['id_kategori'] : 0;
        if ($id_kategori === 0) {
            header("Location: " . base_url('admin/data_kategori/kategori'));
            exit();
        }

        $kategori = $kategoriModel->getKategoriById($id_kategori);
        if (!$kategori) {
            header("Location: " . base_url('admin/data_kategori/kategori'));
            exit();
        }

        $data = [
            'judul'        => 'Halaman Edit Data Kategori',
            'no_preloader' => true,
            'kategori'     => $kategori,
        ];  

        $GLOBALS['judul']        = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_kategori/edit', $data);
    }

    public function hapus() {
        $this->checkAuth();

        if (isset($_GET['id_kategori'])) {
            $kategoriModel = $this->model('Kategori');
            $kategoriModel->delete((int)$_GET['id_kategori']);
            $_SESSION['berhasil'] = 'Data berhasil dihapus';
        }

        header("Location: " . base_url('admin/data_kategori/kategori'));
        exit();
    }
}

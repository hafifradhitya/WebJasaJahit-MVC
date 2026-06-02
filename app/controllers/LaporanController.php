<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';
require_once __DIR__ . '/../core/Controller.php';

// Include autoloader from user's assets/vendor or project root
$possibleAutoloads = [
    __DIR__ . '/../../assets/vendor/autoload.php',
    __DIR__ . '/../../vendor/autoload.php',
    __DIR__ . '/../../../vendor/autoload.php'
];

foreach ($possibleAutoloads as $autoloadPath) {
    if (file_exists($autoloadPath)) {
        require_once $autoloadPath;
        break;
    }
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class LaporanController extends Controller {
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

        $pesananModel = $this->model('Pesanan');
        
        $tanggal_pesan = '';
        $tanggal_selesai = '';

        if (isset($_GET['tanggal_pesan'], $_GET['tanggal_selesai'])) {
            if ($_GET['tanggal_pesan'] === '' && $_GET['tanggal_selesai'] === '') {
                header("Location: " . base_url('admin/data_laporan/laporan'));
                exit;
            }
            $tanggal_pesan = htmlspecialchars(trim($_GET['tanggal_pesan']));
            $tanggal_selesai = htmlspecialchars(trim($_GET['tanggal_selesai']));
        }

        $laporanData = $pesananModel->getLaporanData($tanggal_pesan, $tanggal_selesai);

        $data = [
            'judul' => 'Halaman Laporan',
            'no_preloader' => true,
            'laporan' => $laporanData,
            'tanggal_pesan' => $tanggal_pesan,
            'tanggal_selesai' => $tanggal_selesai
        ];

        $GLOBALS['judul'] = $data['judul'];
        $GLOBALS['no_preloader'] = $data['no_preloader'];

        $this->view('admin/data_laporan/laporan', $data);
    }

    public function rekapExcel() {
        $this->checkAuth();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $laporanModel = $this->model('Laporan');

            $tanggal_pesan = date('Y-m-d', strtotime($_POST['tanggal_pesan']));
            $tanggal_selesai = date('Y-m-d', strtotime($_POST['tanggal_selesai']));
            $status_pesanan = isset($_POST['status_pesanan']) ? $_POST['status_pesanan'] : '';

            $dataPesanan = $laporanModel->getRekapPesanan($tanggal_pesan, $tanggal_selesai, $status_pesanan);

            if (class_exists('PhpOffice\PhpSpreadsheet\Spreadsheet')) {
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                /* =======================
                   JUDUL
                ======================= */
                $sheet->setCellValue('A1', 'LAPORAN DATA PESANAN JASA JAHIT');
                $sheet->mergeCells('A1:K1');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->setCellValue('A2', 'Periode');
                $sheet->mergeCells('A2:B2');
                $sheet->setCellValue(
                    'C2',
                    date('d F Y', strtotime($tanggal_pesan)) .
                    ' s/d ' .
                    date('d F Y', strtotime($tanggal_selesai))
                );

                /* =======================
                   HEADER TABEL (RAPIH)
                ======================= */
                $header = [
                    'NO',
                    'NAMA PELANGGAN',
                    'NO TELEPON',
                    'LAYANAN',
                    'ESTIMASI (HARI)',
                    'UKURAN',
                    'CATATAN',
                    'TANGGAL PESAN',
                    'TANGGAL SELESAI',
                    'STATUS',
                    'HARGA'
                ];

                $sheet->fromArray($header, null, 'A4');

                $sheet->getStyle('A4:K4')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E9ECEF']
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
                    ]
                ]);

                /* =======================
                   ISI DATA
                ======================= */
                $row = 5;
                $no = 1;
                $totalHarga = 0;

                foreach ($dataPesanan as $data) {
                    $sheet->setCellValue('A'.$row, $no++);
                    $sheet->setCellValue('B'.$row, $data->nama_lengkap);
                    $sheet->setCellValue('C'.$row, $data->no_telepon);
                    $sheet->setCellValue('D'.$row, $data->nama_layanan);
                    $sheet->setCellValue('E'.$row, $data->estimasi_hari);
                    $sheet->setCellValue('F'.$row, $data->ukuran_pakaian);
                    $sheet->setCellValue('G'.$row, $data->catatan);
                    $sheet->setCellValue('H'.$row, date('d-m-Y', strtotime($data->tanggal_pesan)));
                    $sheet->setCellValue('I'.$row, date('d-m-Y', strtotime($data->tanggal_selesai)));
                    $sheet->setCellValue('J'.$row, strtoupper($data->status_pesanan));
                    $sheet->setCellValue('K'.$row, $data->harga_mulai);

                    $totalHarga += $data->harga_mulai;
                    $row++;
                }

                /* =======================
                   FORMAT RUPIAH & BORDER
                ======================= */
                if ($row > 5) {
                    $sheet->getStyle('K5:K'.($row-1))
                          ->getNumberFormat()
                          ->setFormatCode('"Rp" #,##0');

                    $sheet->getStyle('A4:K'.($row-1))
                          ->getBorders()->getAllBorders()
                          ->setBorderStyle(Border::BORDER_THIN);
                }

                /* =======================
                   AUTO WIDTH
                ======================= */
                foreach (range('A','K') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                /* =======================
                   FREEZE HEADER
                ======================= */
                $sheet->freezePane('A5');

                /* =======================
                   TOTAL PENDAPATAN
                ======================= */
                $sheet->setCellValue('A'.$row, 'TOTAL PENDAPATAN');
                $sheet->mergeCells('A'.$row.':J'.$row);
                $sheet->setCellValue('K'.$row, $totalHarga);

                $sheet->getStyle('A'.$row.':K'.$row)->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT],
                    'borders' => [
                        'top' => ['borderStyle' => Border::BORDER_THICK]
                    ]
                ]);

                $sheet->getStyle('K'.$row)
                      ->getNumberFormat()
                      ->setFormatCode('"Rp" #,##0');

                /* =======================
                   OUTPUT
                ======================= */
                if (ob_get_contents()) {
                    ob_end_clean();
                }
                
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="Laporan_Pesanan_Jasa_Jahit.xlsx"');
                header('Cache-Control: max-age=0');

                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output');
                exit();
            } else {
                $_SESSION['gagal'] = "PhpSpreadsheet library tidak ditemukan.";
                header("Location: " . base_url('admin/data_laporan/laporan'));
                exit();
            }
        } else {
            header("Location: " . base_url('admin/data_laporan/laporan'));
            exit();
        }
    }
}

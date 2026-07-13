<?php
$judul = 'Pembayaran Berhasil | Jasa Jahit Premium';
ob_start();
?>
<style>
/* ===== SUCCESS PAGE CSS ===== */
        body {
            background: linear-gradient(rgba(10,10,10,0.8), rgba(10,10,10,0.9)), url('<?= base_url("public/img/hero/hero1.jpeg") ?>') center/cover fixed !important;
        }
        .main-header { background-color: #0a0a0a !important; }
        
        .success-container {
            max-width: 600px;
            margin: 100px auto 60px;
            padding: 40px;
            background: #1e140d;
            border: 1px solid rgba(236, 173, 41, 0.3);
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
            animation: slideUp 0.6s ease;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            margin: 0 auto 20px;
            box-shadow: 0 10px 25px rgba(39, 174, 96, 0.4);
            animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) 0.2s both;
        }

        .success-title {
            color: #ecad29;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .success-text {
            color: #bbb;
            font-size: 15px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .order-summary {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: left;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.1);
        }
        .summary-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .summary-item span { color: #888; font-size: 14px; }
        .summary-item strong { color: #eee; font-size: 14px; font-weight: 600; }
        .summary-item .highlight { color: #ecad29; font-size: 16px; font-weight: 700; }

        .btn-action {
            display: inline-block;
            background: linear-gradient(135deg, #ecad29, #b8860b);
            color: #0a0a0a;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(236, 173, 41, 0.3);
        }
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(236, 173, 41, 0.4);
            color: #000;
            text-decoration: none;
        }

        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes popIn { 0% { transform: scale(0); } 80% { transform: scale(1.1); } 100% { transform: scale(1); } }
</style>
<?php
$extra_css = ob_get_clean();
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h1 class="success-title">Pembayaran Berhasil!</h1>
        <p class="success-text">Terima kasih, pembayaran Anda telah kami terima. Pesanan Anda akan segera kami proses ke tahap penjahitan.</p>

        <div class="order-summary">
            <div class="summary-item">
                <span>ID Pesanan</span>
                <strong>#<?= htmlspecialchars($pesanan->id_pesanan) ?></strong>
            </div>
            <div class="summary-item">
                <span>Layanan</span>
                <strong><?= htmlspecialchars($pesanan->nama_layanan) ?></strong>
            </div>
            <div class="summary-item">
                <span>Nama Pelanggan</span>
                <strong><?= htmlspecialchars($pesanan->nama_lengkap) ?></strong>
            </div>
            <div class="summary-item">
                <span>Status Pesanan</span>
                <strong>Proses Jahit</strong>
            </div>
            <div class="summary-item">
                <span>Total Dibayar</span>
                <?php 
                $harga_bayar = (isset($pesanan->harga_final) && $pesanan->harga_final > 0) ? $pesanan->harga_final : ((isset($pesanan->estimasi_harga) && $pesanan->estimasi_harga > 0) ? $pesanan->estimasi_harga : $pesanan->harga_mulai); 
                ?>
                <strong class="highlight">Rp <?= number_format($harga_bayar, 0, ',', '.') ?></strong>
            </div>
        </div>

        <a href="<?= base_url('lacak?keyword=' . urlencode($pesanan->no_telepon)) ?>" class="btn-action">
            <i class="fas fa-search"></i> Lacak Pesanan Lagi
        </a>
    </div>
</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>

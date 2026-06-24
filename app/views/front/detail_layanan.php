<?php
$judul = htmlspecialchars($layanan['nama_layanan'] ?? '') . ' | Jasa Jahit Premium';
$extra_css = '<link rel="stylesheet" href="' . base_url('public/css/detail-layanan.css') . '">' . "\n" .
             '<link rel="stylesheet" href="' . base_url('public/css/kalkulator.css') . '">';
require_once __DIR__ . '/../layouts/header.php';
?>

    <!-- ================= HERO DETAIL ================= -->
    <section class="detail-hero">
        <img src="<?= $foto ?>" alt="<?= htmlspecialchars($layanan['nama_layanan'] ?? '') ?>" class="detail-hero-img">

        <div class="detail-hero-overlay"></div>

        <div class="detail-hero-content">
            <span class="detail-badge"><?= strtoupper(htmlspecialchars($layanan['nama_kategori'] ?? '')) ?></span>
            <h1><?= htmlspecialchars($layanan['nama_layanan'] ?? '') ?></h1>
            <p><?= htmlspecialchars($layanan['deskripsi'] ?? '') ?></p>
            <a href="#detail" class="btn-gold">Lihat Detail</a>
        </div>
    </section>

    <!-- ================= DETAIL LAYANAN ================= -->
    <section class="detail-section" id="detail">
        <div class="detail-container">

            <!-- KIRI -->
            <div class="detail-desc">
                <h2>Deskripsi Layanan</h2>
                <p><?= nl2br(htmlspecialchars($layanan['deskripsi'] ?? '')) ?></p>

                <ul class="detail-features">
                    <?php if (!empty($layanan['fitur_1'])): ?>
                        <li><i class="fas fa-check"></i> <?= htmlspecialchars($layanan['fitur_1']) ?></li>
                    <?php endif; ?>

                    <?php if (!empty($layanan['fitur_2'])): ?>
                        <li><i class="fas fa-check"></i> <?= htmlspecialchars($layanan['fitur_2']) ?></li>
                    <?php endif; ?>

                    <?php if (!empty($layanan['fitur_3'])): ?>
                        <li><i class="fas fa-check"></i> <?= htmlspecialchars($layanan['fitur_3']) ?></li>
                    <?php endif; ?>

                    <?php if (!empty($layanan['fitur_4'])): ?>
                        <li><i class="fas fa-check"></i> <?= htmlspecialchars($layanan['fitur_4']) ?></li>
                    <?php endif; ?>

                    <?php
                    if (
                        empty($layanan['fitur_1']) && empty($layanan['fitur_2']) &&
                        empty($layanan['fitur_3']) && empty($layanan['fitur_4'])
                    ):
                        ?>
                        <li><i class="fas fa-check"></i> Jahitan rapi & berkualitas</li>
                        <li><i class="fas fa-check"></i> Dikerjakan dengan teliti</li>
                        <li><i class="fas fa-check"></i> Hasil sesuai harapan</li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- KANAN -->
            <div class="detail-info-card">
                <h3>Informasi Layanan</h3>

                <div class="info-row">
                    <span>Kategori</span>
                    <strong><?= htmlspecialchars($layanan['nama_kategori'] ?? '') ?></strong>
                </div>

                <div class="info-row" style="margin-bottom: 15px;">
                    <span>Estimasi Waktu</span>
                    <strong><?= htmlspecialchars($layanan['estimasi_hari'] ?? '') ?></strong>
                </div>

                <style>
                    .premium-select-wrapper { position: relative; margin-bottom: 12px; }
                    .premium-select-label { display:flex; align-items:center; gap:6px; font-size:12px; color:#ecad29; margin-bottom:6px; font-weight: 500; }
                    .premium-select { appearance:none; -webkit-appearance:none; width:100%; padding:10px 35px 10px 15px; background:rgba(20, 15, 5, 0.8); border:1px solid rgba(236,173,41,0.3); color:#fff; border-radius:6px; font-size: 13px; outline:none; transition: all 0.3s ease; cursor:pointer; box-shadow: inset 0 2px 4px rgba(0,0,0,0.5); font-family: inherit; }
                    .premium-select:focus { border-color:#ecad29; box-shadow:0 0 8px rgba(236,173,41,0.3), inset 0 2px 4px rgba(0,0,0,0.5); }
                    .premium-select option { background: #1a150e; color: #fff; }
                    .premium-select-icon { position:absolute; right:15px; top:35px; color:#ecad29; font-size:12px; pointer-events:none; }
                </style>

                <div class="premium-select-wrapper">
                    <label for="calcBahan" class="premium-select-label"><i class="fas fa-scroll"></i> Ketersediaan Bahan</label>
                    <select id="calcBahan" class="premium-select">
                    <option value="0">Bawa Bahan Sendiri</option>
                    <option value="50000">Bahan Standar (Disediakan)</option>
                    <option value="150000">Bahan Premium (Disediakan)</option>
                    </select>
                    <i class="fas fa-chevron-down premium-select-icon"></i>
                </div>

                <div class="premium-select-wrapper" style="margin-bottom: 20px;">
                    <label for="calcKerumitan" class="premium-select-label"><i class="fas fa-gem"></i> Tingkat Kerumitan</label>
                    <select id="calcKerumitan" class="premium-select">
                    <option value="0">Standar (Tanpa Payet)</option>
                    <option value="50000">Bordir / Payet Ringan</option>
                    <option value="100000">Payet Sedang</option>
                    <option value="200000">Payet Full / Custom</option>
                    </select>
                    <i class="fas fa-chevron-down premium-select-icon"></i>
                </div>

                <div class="info-row" style="background: rgba(236,173,41,0.1); padding: 12px; border-radius: 8px; border: 1px solid rgba(236,173,41,0.2); margin-bottom: 10px;">
                    <span style="color: #ecad29; font-size: 13px;">Estimasi Total</span>
                    <strong id="calcTotal" data-base-price="<?= $layanan['harga_mulai'] ?? 0 ?>" style="color: #fff; font-size: 16px;">Rp <?= number_format($layanan['harga_mulai'] ?? 0, 0, ',', '.') ?></strong>
                </div>
                
                <p style="font-size: 11px; color: #888; text-align: center; margin-bottom: 20px; line-height: 1.4;">
                    *Estimasi awal. Harga akhir ditentukan setelah konsultasi desain dan ukuran.
                </p>

                <a href="#" class="btn-gold full" id="btnPesanSekarang"
                    data-nama-layanan="<?= htmlspecialchars($layanan['nama_layanan'] ?? '') ?>"
                    data-kategori="<?= htmlspecialchars($layanan['nama_kategori'] ?? '') ?>"
                    data-estimasi="<?= htmlspecialchars($layanan['estimasi_hari'] ?? '') ?>"
                    data-harga-mulai="<?= number_format($layanan['harga_mulai'] ?? 0, 0, ',', '.') ?>">
                    <i class="fab fa-whatsapp"></i> Pesan Sekarang
                </a>
            </div>

        </div>
    </section>

    <!-- ================= PROSES ================= -->
    <section class="detail-process">
        <h2>Alur Pengerjaan</h2>

        <div class="process-grid">
            <div class="process-step">
                <span>01</span>
                <p>Konsultasi & Ukur</p>
            </div>
            <div class="process-step">
                <span>02</span>
                <p>Proses Jahit</p>
            </div>
            <div class="process-step">
                <span>03</span>
                <p>Finishing</p>
            </div>
            <div class="process-step">
                <span>04</span>
                <p>Siap Diambil</p>
            </div>
        </div>
    </section>

<?php
$extra_js = '<script src="' . base_url('public/js/kalkulator.js') . '"></script>' . "\n" .
            '<script src="' . base_url('public/js/WhatsApp-Pesan.js') . '"></script>';
require_once __DIR__ . '/../layouts/footer.php';
?>
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
    <style>
        .layout-2-cols {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 40px;
            align-items: start;
        }
        @media (max-width: 1024px) {
            .layout-2-cols {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }
    </style>
    <section class="detail-section" id="detail" style="padding-bottom: 60px;">
        <div class="detail-container" style="max-width: 1200px; margin: auto; display: block;">

            <!-- ATAS (Deskripsi) -->
            <div class="detail-desc" style="margin-bottom: 50px;">
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

            <!-- BAWAH (Grid 2 Kolom untuk Form) -->
            <div class="layout-2-cols">
            <div style="width: 100%; box-sizing: border-box; background: #15110b; padding: 35px; border-radius: 16px; border: 1px solid rgba(236,173,41,0.2); box-shadow: 0 15px 35px rgba(0,0,0,0.6);">
                <h3 style="text-align: center; margin-bottom: 30px; color: #ecad29; font-size: 22px; font-weight: 600;"><i class="fas fa-clipboard-list" style="margin-right: 10px;"></i>Pesan di Website sekarang</h3>
                
                <form id="formPesanWebsite">
                    <input type="hidden" id="inputIdLayanan" value="<?= $layanan['id_layanan'] ?? 0 ?>">
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                        <div class="premium-select-wrapper" style="margin-bottom: 0;">
                            <label class="premium-select-label">Nama Lengkap *</label>
                            <input type="text" id="inputNamaLengkap" placeholder="Masukkan nama" class="premium-select" style="cursor: text; padding: 10px;" required>
                        </div>
                        <div class="premium-select-wrapper" style="margin-bottom: 0;">
                            <label class="premium-select-label">No WhatsApp *</label>
                            <input type="number" id="inputNoTelepon" placeholder="62812..." class="premium-select" style="cursor: text; padding: 10px;" required>
                        </div>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px;">
                        <div class="premium-select-wrapper" style="margin-bottom: 0;">
                            <label class="premium-select-label">Email</label>
                            <input type="email" id="inputEmail" placeholder="Email aktif" class="premium-select" style="cursor: text; padding: 10px;">
                        </div>
                        <div class="premium-select-wrapper" style="margin-bottom: 0;">
                            <label class="premium-select-label">Ukuran Pakaian *</label>
                            <select id="inputUkuranPakaian" class="premium-select" style="padding: 10px;">
                                <optgroup label="Dewasa">
                                    <option value="S - Dewasa">S - Dewasa</option>
                                    <option value="M - Dewasa">M - Dewasa</option>
                                    <option value="L - Dewasa">L - Dewasa</option>
                                    <option value="XL - Dewasa">XL - Dewasa</option>
                                    <option value="XXL - Dewasa">XXL - Dewasa</option>
                                    <option value="XXXL - Dewasa">XXXL - Dewasa</option>
                                </optgroup>
                                <optgroup label="Anak-Anak">
                                    <option value="S - Anak-Anak">S - Anak-Anak</option>
                                    <option value="M - Anak-Anak">M - Anak-Anak</option>
                                    <option value="L - Anak-Anak">L - Anak-Anak</option>
                                    <option value="XL - Anak-Anak">XL - Anak-Anak</option>
                                    <option value="XXL - Anak-Anak">XXL - Anak-Anak</option>
                                    <option value="XXXL - Anak-Anak">XXXL - Anak-Anak</option>
                                </optgroup>
                                <option value="Custom">Custom (Isi Detail)</option>
                            </select>
                            <i class="fas fa-chevron-down premium-select-icon" style="top: 32px; right: 10px;"></i>
                        </div>
                    </div>

                    <!-- CUSTOM SIZE CONTAINER -->
                    <div id="customSizeContainer" style="display: none; background: rgba(255,255,255,0.02); padding: 20px; border-radius: 12px; margin-bottom: 25px; border: 1px solid rgba(236,173,41,0.2);">
                        <h4 style="color: #ecad29; margin-bottom: 20px; text-align: center; font-size: 15px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Detail Ukuran Custom (Cm)</h4>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                            <!-- ATASAN -->
                            <div>
                                <h5 style="color: #ecad29; margin-bottom: 15px; border-bottom: 1px dashed rgba(236,173,41,0.3); padding-bottom: 8px; font-size: 14px; display: flex; align-items: center; gap: 8px;"><i class="fas fa-tshirt"></i> Atasan</h5>
                                
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="A_lingkar_dada" placeholder="Lingkar Dada" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="A_lingkar_pinggang" placeholder="L. Pinggang (Atasan)" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="A_lingkar_pinggul" placeholder="L. Pinggul (Atasan)" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="A_lebar_bahu" placeholder="Lebar Bahu" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="A_panjang_lengan" placeholder="Panjang Lengan" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="A_lingkar_lengan" placeholder="Lingkar Lengan" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="A_panjang_baju" placeholder="Panjang Baju" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="A_lingkar_leher" placeholder="Lingkar Leher" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                
                                <div class="premium-select-wrapper">
                                    <select id="A_model_fit" class="premium-select" style="padding: 8px;">
                                        <option value="">-- Model Fit --</option>
                                        <option value="fit_badan">Fit Badan</option>
                                        <option value="regular">Regular</option>
                                        <option value="longgar">Longgar</option>
                                    </select>
                                    <i class="fas fa-chevron-down premium-select-icon" style="top: 10px; right: 8px;"></i>
                                </div>
                                <div class="premium-select-wrapper">
                                    <select id="A_kegunaan" class="premium-select" style="padding: 8px;">
                                        <option value="">-- Kegunaan --</option>
                                        <option value="formal">Formal</option>
                                        <option value="santai">Santai</option>
                                    </select>
                                    <i class="fas fa-chevron-down premium-select-icon" style="top: 10px; right: 8px;"></i>
                                </div>
                            </div>

                            <!-- BAWAHAN -->
                            <div>
                                <h5 style="color: #ecad29; margin-bottom: 15px; border-bottom: 1px dashed rgba(236,173,41,0.3); padding-bottom: 8px; font-size: 14px; display: flex; align-items: center; gap: 8px;"><i class="fas fa-socks"></i> Bawahan</h5>
                                
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="B_lingkar_pinggang" placeholder="L. Pinggang (Bwhn)" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="B_lingkar_pinggul" placeholder="L. Pinggul (Bwhn)" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="B_panjang_celana" placeholder="Panjang Celana/Rok" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="B_lingkar_paha" placeholder="Lingkar Paha" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="B_lingkar_lutut" placeholder="Lingkar Lutut" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="B_lingkar_kaki" placeholder="Lingkar Kaki Bawah" class="premium-select" style="cursor:text; padding: 8px;"></div>
                                <div class="premium-select-wrapper"><input type="number" step="0.1" id="B_tinggi_duduk" placeholder="Tinggi Duduk" class="premium-select" style="cursor:text; padding: 8px;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- CALCULATOR WEB FORM -->
                    <div style="background: rgba(236,173,41,0.05); padding: 20px; border-radius: 12px; margin-bottom: 25px; border: 1px solid rgba(236,173,41,0.2);">
                        <div class="premium-select-wrapper">
                            <label for="webCalcBahan" class="premium-select-label"><i class="fas fa-scroll"></i> Ketersediaan Bahan</label>
                            <select id="webCalcBahan" class="premium-select">
                            <option value="0">Bawa Bahan Sendiri</option>
                            <option value="50000">Bahan Standar (Disediakan)</option>
                            <option value="150000">Bahan Premium (Disediakan)</option>
                            </select>
                            <i class="fas fa-chevron-down premium-select-icon"></i>
                        </div>

                        <div class="premium-select-wrapper" style="margin-bottom: 20px;">
                            <label for="webCalcKerumitan" class="premium-select-label"><i class="fas fa-gem"></i> Tingkat Kerumitan</label>
                            <select id="webCalcKerumitan" class="premium-select">
                            <option value="0">Standar (Tanpa Payet)</option>
                            <option value="50000">Bordir / Payet Ringan</option>
                            <option value="100000">Payet Sedang</option>
                            <option value="200000">Payet Full / Custom</option>
                            </select>
                            <i class="fas fa-chevron-down premium-select-icon"></i>
                        </div>

                        <div class="info-row" style="background: rgba(236,173,41,0.1); padding: 12px; border-radius: 8px; border: 1px solid rgba(236,173,41,0.2); margin-bottom: 0;">
                            <span style="color: #ecad29; font-size: 13px;">Estimasi Total</span>
                            <strong id="webCalcTotal" data-base-price="<?= $layanan['harga_mulai'] ?? 0 ?>" style="color: #fff; font-size: 16px;">Rp <?= number_format($layanan['harga_mulai'] ?? 0, 0, ',', '.') ?></strong>
                        </div>
                    </div>

                    <div class="premium-select-wrapper" style="margin-bottom: 25px;">
                        <label class="premium-select-label">Catatan Tambahan (Opsional)</label>
                        <textarea id="inputCatatan" placeholder="Detail request desain, dsb." class="premium-select" style="cursor: text; height: 80px; padding: 10px; resize: none;"></textarea>
                    </div>

                    <button type="submit" class="btn-gold full" id="btnPesanWebsite" style="border: none; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 10px; font-size: 15px; padding: 14px; border-radius: 8px; font-weight: 600;">
                        <i class="fas fa-paper-plane"></i> Kirim Pesanan
                    </button>
                </form>
            </div>

            <!-- KANAN (Info Layanan & Tombol WA) -->
            <div class="detail-info-card" style="position: sticky; top: 100px;">
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
                    <i class="fab fa-whatsapp"></i> Pesan lewat WhatsApp
                </a>
            </div>

            <!-- Tutup layout-2-cols -->
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
$extra_js = '<script src="' . base_url('public/js/kalkulator.js?v=') . time() . '"></script>' . "\n" .
            '<script src="' . base_url('public/js/WhatsApp-Pesan.js?v=') . time() . '"></script>' . "\n" .
            '<script src="' . base_url('public/js/pesan-website.js?v=') . time() . '"></script>';
require_once __DIR__ . '/../layouts/footer.php';
?>
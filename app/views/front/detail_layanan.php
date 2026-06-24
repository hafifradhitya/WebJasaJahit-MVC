<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title><?= htmlspecialchars($layanan['nama_layanan'] ?? '') ?> | Jasa Jahit Premium</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= htmlspecialchars($layanan['deskripsi'] ?? '') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url('public/css/detail-layanan.css') ?>">

    <style>
        /* ===== USER DROPDOWN (ISOLATED) ===== */
        .user-action {
            position: relative;
            margin-left: 20px;
        }

        .user-profile {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
        }

        .user-profile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Dropdown box */
        .user-menu {
            position: absolute;
            top: 60px;
            right: 0;
            width: 200px;
            background: #fff;
            border-radius: 12px;
            padding: 10px 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            opacity: 0;
            visibility: hidden;
            transition: 0.3s ease;
            z-index: 999;
        }

        .user-menu.active {
            opacity: 1;
            visibility: visible;
            top: 50px;
        }

        /* KHUSUS dropdown */
        .user-menu h3 {
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .user-menu h3 span {
            font-size: 13px;
            color: #999;
            font-weight: 400;
        }

        .user-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .user-menu ul li {
            display: flex;
            align-items: center;
            padding: 8px 0;
            border-top: 1px solid #eee;
        }

        .user-menu ul li i {
            width: 20px;
            color: #999;
            margin-right: 8px;
        }

        .user-menu ul li a {
            text-decoration: none;
            color: #444;
            font-size: 14px;
        }

        .user-menu ul li:hover a {
            color: #b68d40;
        }
    </style>
</head>

<body>

    <div class="top-header">
        <div class="container">
            <nav class="top-nav">
                <span>📍 Gg. Mushollah, Desa Jadimulya</span>
                <span>|</span>
                <span>⏰ Senin–Sabtu 08.00–17.00</span>
                <span>|</span>
                <span>📞 089682506082</span>
            </nav>
        </div>
    </div>


    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <a href="<?= base_url('front/beranda.php') ?>">
                    <img src="<?= base_url('public/img/logo/logo-jasa-jahit.png') ?>" alt="Jasa Jahit Premium" />
                </a>
            </div>

            <nav class="main-nav">
                <a href="<?= base_url('#beranda') ?>">Beranda</a>
                <a href="<?= base_url('#tentang-jasa') ?>">Tentang Kami</a>
                <a href="<?= base_url('#jasa') ?>">Layanan</a>
                <a href="<?= base_url('#process') ?>">Proses</a>
                <a href="<?= base_url('#process-gallery') ?>">Galeri</a>
                <!-- LOGIN BUTTON -->


                <?php if (!empty($_SESSION['login'])): ?>
                    <div class="user-action">
                        <div class="user-profile" onclick="userMenuToggle()">
                            <img src="<?= base_url('public/img/foto_pelanggan/' . ($_SESSION['foto'] ?? 'default.jpg')) ?>"
                                alt="Foto">
                        </div>

                        <div class="user-menu">
                            <h3>
                                <?= htmlspecialchars($_SESSION['nama_lengkap'] ?? ''); ?><br>
                                <span><?= htmlspecialchars($_SESSION['role'] ?? ''); ?></span>
                            </h3>
                            <ul>
                                <li><i class="fas fa-user"></i><a
                                        href="<?= base_url('pelanggan/fitur_lainnya/profile.php') ?>">Profil</a></li>
                                <li><i class="fas fa-chart-line"></i><a
                                        href="<?= base_url('pelanggan/dashboard/dashboard.php') ?>">Dashboard</a></li>
                                <li><i class="fas fa-sign-out-alt"></i><a
                                        href="<?= base_url('auth/logout.php') ?>">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

            </nav>

            <!-- Burger Menu Button -->
            <button class="burger-menu" id="burgerMenu" aria-label="Toggle Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

    <!-- Mobile Menu Sidebar -->
    <nav class="mobile-menu" id="mobileMenu">
        <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Close Menu">
            <i class="fas fa-times"></i>
        </button>
        <div class="mobile-menu-content">
            <a href="<?= base_url('#beranda') ?>" class="mobile-menu-link">Beranda</a>
            <a href="<?= base_url('#tentang-jasa') ?>" class="mobile-menu-link">Tentang Kami</a>
            <a href="<?= base_url('#jasa') ?>" class="mobile-menu-link">Layanan</a>
            <a href="<?= base_url('#process') ?>" class="mobile-menu-link">Proses</a>
            <a href="<?= base_url('#process-gallery') ?>" class="mobile-menu-link">Galeri</a>

            <div class="mobile-menu-divider"></div>
            <?php if (!empty($_SESSION['login'])): ?>
                <!-- USER LOGIN -->
                <div class="mobile-user-info">
                    <img src="<?= base_url('public/img/foto_pelanggan/' . ($_SESSION['foto'] ?? 'default.jpg')) ?>"
                        alt="Foto User" class="mobile-user-avatar">
                    <div class="mobile-user-text">
                        <strong><?= htmlspecialchars($_SESSION['nama_lengkap'] ?? ''); ?></strong><br>
                        <span><?= htmlspecialchars($_SESSION['role'] ?? ''); ?></span>
                    </div>
                </div>

                <a href="<?= base_url('pelanggan/fitur_lainnya/profile.php') ?>" class="mobile-menu-link secondary">
                    <i class="fas fa-user"></i> Profil
                </a>
                <a href="<?= base_url('pelanggan/dashboard/dashboard.php') ?>" class="mobile-menu-link secondary">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
                <a href="<?= base_url('auth/logout.php') ?>" class="mobile-menu-link secondary danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            <?php endif; ?>
        </div>
    </nav>

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
                    // Jika tidak ada fitur sama sekali, tampilkan default
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

                <div class="info-row">
                    <span>Estimasi Waktu</span>
                    <strong><?= htmlspecialchars($layanan['estimasi_hari'] ?? '') ?></strong>
                </div>

                <div class="info-row">
                    <span>Harga Mulai</span>
                    <strong>Rp <?= number_format($layanan['harga_mulai'] ?? 0, 0, ',', '.') ?></strong>
                </div>

                <a href="#" class="btn-gold full" id="btnPesanSekarang"
                    data-nama-layanan="<?= htmlspecialchars($layanan['nama_layanan'] ?? '') ?>"
                    data-kategori="<?= htmlspecialchars($layanan['nama_kategori'] ?? '') ?>"
                    data-estimasi="<?= htmlspecialchars($layanan['estimasi_hari'] ?? '') ?>"
                    data-harga-mulai="<?= number_format($layanan['harga_mulai'] ?? 0, 0, ',', '.') ?>">
                    Pesan Sekarang
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

    <script src="<?= base_url('public/js/burgermenu.js') ?>"></script>
    <script src="<?= base_url('public/js/WhatsApp-Pesan.js') ?>"></script>
</body>

</html>

<script>
    function userMenuToggle() {
        document.querySelector('.user-menu').classList.toggle('active');
    }

    // klik di luar → menu menutup
    document.addEventListener('click', function (e) {
        const action = document.querySelector('.user-action');
        if (action && !action.contains(e.target)) {
            document.querySelector('.user-menu')?.classList.remove('active');
        }
    });
</script>
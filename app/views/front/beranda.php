<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Data $kategori_array dan $layanan_by_kategori sekarang didapatkan dari BerandaController
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="public/img/logo/logo-mesin-jahit.png" type="image/x-icon" />
  <title>JAHIT - Jadimulya Jasa Jahit</title>
  <link rel="stylesheet" href="<?= base_url('public/css/style-jahit.css') ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* Golden Brown Empty State - DeskApp Friendly */

    .tp-card {
      transition: all 0.3s ease;
    }

    #emptyState {
      animation: fadeInUp 0.6s ease;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .empty-state-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 420px;
      padding: 50px 0;
    }

    .empty-state-card {
      text-align: center;
      max-width: 620px;
      padding: 65px 45px;
      background: linear-gradient(145deg, #fff8ee, #ffffff);
      border-radius: 16px;
      border: 1px solid rgba(182, 141, 64, 0.25);
      box-shadow:
        0 15px 40px rgba(182, 141, 64, 0.18),
        inset 0 1px 0 rgba(255, 255, 255, 0.6);
      position: relative;
      overflow: hidden;
    }

    .empty-state-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at top, rgba(224, 192, 122, 0.15), transparent 60%);
      pointer-events: none;
    }

    .icon-box {
      margin-bottom: 30px;
    }

    .icon-box i {
      font-size: 84px;
      color: #b68d40;
      background: linear-gradient(135deg, #e0c07a, #b68d40);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .empty-state-card h3 {
      font-size: 30px;
      color: #5a3e1b;
      margin-bottom: 18px;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    .empty-state-card p {
      font-size: 16px;
      color: #7a5a2f;
      line-height: 1.9;
      margin-bottom: 35px;
    }

    .empty-state-card strong {
      color: #b68d40;
      font-weight: 600;
    }

    .action-group .btn {
      background: linear-gradient(135deg, #b68d40, #e0c07a);
      border: none;
      color: #fff;
      padding: 12px 26px;
      font-size: 15px;
      font-weight: 600;
      border-radius: 50px;
      box-shadow: 0 8px 25px rgba(182, 141, 64, 0.35);
      transition: all 0.3s ease;
    }

    .action-group .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(182, 141, 64, 0.45);
      background: linear-gradient(135deg, #a47b33, #d6b46a);
    }

    .tp-card[style*="display: none"] {
      display: none !important;
    }

    .tp-card[style*="display: block"] {
      display: block !important;
    }
  </style>


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

  <style>
  .mobile-user-info {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
  }

  .mobile-user-avatar {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    object-fit: cover;
  }

  .mobile-user-text span {
    font-size: 12px;
    color: #aaa;
  }

  .mobile-menu-link.danger {
    color: #ff5c5c;
  }
  </style>

  <!-- Popup Chat Pelanggan -->
  <style>
    .chat-popup {
      position: fixed;
      right: -420px;
      bottom: 20px;
      width: 360px;
      max-height: 70vh;
      background: #ffffff;
      border-radius: 16px 0 0 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      display: flex;
      flex-direction: column;
      overflow: hidden;
      z-index: 9999;
      transition: right 0.35s ease;
    }

    .chat-popup.open {
      right: 20px;
    }

    .chat-header {
      background: linear-gradient(135deg, #b68d40, #e0c07a);
      color: #fff;
      padding: 10px 14px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 14px;
      font-weight: 600;
    }

    .chat-close {
      border: none;
      background: transparent;
      color: #fff;
      font-size: 18px;
      cursor: pointer;
      line-height: 1;
    }

    .chat-messages {
      padding: 10px 12px;
      flex: 1;
      overflow-y: auto;
      background: #f9f5ec;
    }

    .chat-message {
      margin-bottom: 8px;
      font-size: 13px;
      max-width: 80%;
      padding: 6px 10px;
      border-radius: 12px;
      clear: both;
    }

    .chat-message.you {
      margin-left: auto;
      background: #b68d40;
      color: #fff;
    }

    .chat-message.admin {
      margin-right: auto;
      background: #ffffff;
      border: 1px solid #e0c07a;
      color: #5a3e1b;
    }

    .chat-form {
      display: flex;
      border-top: 1px solid #eee;
      background: #fff;
    }

    .chat-form input {
      flex: 1;
      border: none;
      padding: 10px 12px;
      font-size: 14px;
      outline: none;
    }

    .chat-form button {
      border: none;
      background: #b68d40;
      color: #fff;
      padding: 0 16px;
      cursor: pointer;
      font-weight: 600;
    }

    @media (max-width: 576px) {
      .chat-popup {
        width: 100%;
        right: -100%;
        border-radius: 16px 16px 0 0;
      }

      .chat-popup.open {
        right: 0;
        left: 0;
        margin: 0 auto;
      }
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
        <a href="#">
          <img src="<?= base_url('public/img/logo/logo-jasa-jahit.png') ?>" alt="Jasa Jahit Premium" />
        </a>
      </div>
  
      <nav class="main-nav">
        <a href="beranda#beranda">Beranda</a>
        <a href="beranda#tentang-jasa">Tentang Kami</a>
        <a href="beranda#jasa">Layanan</a>
        <a href="beranda#process">Proses</a>
        <a href="beranda#process-gallery">Galeri</a>
        <!-- LOGIN BUTTON -->


        <?php if (!empty($_SESSION['login'])): ?>
          <div class="user-action">
            <div class="user-profile" onclick="userMenuToggle()">
              <img src="<?= base_url('public/img/foto_pelanggan/' . ($_SESSION['foto'] ?? 'default.jpg')) ?>" alt="Foto">
            </div>

            <div class="user-menu">
              <h3>
                <?= htmlspecialchars($_SESSION['nama_lengkap'] ?? ''); ?><br>
                <span><?= htmlspecialchars($_SESSION['role'] ?? ''); ?></span>
              </h3>
              <ul>
                <li><i class="fas fa-user"></i><a href="<?= base_url('pelanggan/fitur_lainnya/profile.php') ?>">Profil</a></li>
                <li><i class="fas fa-comments"></i><a href="javascript:void(0)" onclick="openChatPopup()">Chat</a></li>
                <li><i class="fas fa-sign-out-alt"></i><a href="<?= base_url('auth/logout.php') ?>">Logout</a></li>
              </ul>
            </div>
          </div>
        <?php else: ?>
          <a href="<?= base_url('auth/login') ?>" class="nav-login">
            <i class="fas fa-user"></i> Login
          </a>
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
      <a href="<?= base_url('front/beranda.php#beranda') ?>" class="mobile-menu-link">Beranda</a>
      <a href="<?= base_url('front/beranda.php#tentang-jasa') ?>" class="mobile-menu-link">Tentang Kami</a>
      <a href="<?= base_url('front/beranda.php#jasa') ?>" class="mobile-menu-link">Layanan</a>
      <a href="<?= base_url('front/beranda.php#process') ?>" class="mobile-menu-link">Proses</a>
      <a href="<?= base_url('front/beranda.php#process-gallery') ?>" class="mobile-menu-link">Galeri</a>

      <div class="mobile-menu-divider"></div>

      <?php if (!empty($_SESSION['login'])): ?>
        <!-- USER LOGIN -->
        <div class="mobile-user-info">
          <img 
            src="<?= base_url('public/img/foto_pelanggan/' . ($_SESSION['foto'] ?? 'default.jpg')) ?>" 
            alt="Foto User"
            class="mobile-user-avatar"
          >
          <div class="mobile-user-text">
            <strong><?= htmlspecialchars($_SESSION['nama_lengkap']); ?></strong>
            <span><?= htmlspecialchars($_SESSION['role']); ?></span>
          </div>
        </div>

        <a href="<?= base_url('pelanggan/fitur_lainnya/profile.php') ?>" class="mobile-menu-link secondary">
          <i class="fas fa-user"></i> Profil
        </a>
        <a href="javascript:void(0)" class="mobile-menu-link secondary" onclick="openChatPopup()">
          <i class="fas fa-comments"></i> Chat
        </a>
        <a href="<?= base_url('auth/logout.php') ?>" class="mobile-menu-link secondary danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>

      <?php else: ?>
        <!-- BELUM LOGIN -->
        <a href="<?= base_url('auth/login.php') ?>" class="mobile-menu-link secondary">
          <i class="fas fa-sign-in-alt"></i> Login
        </a>
      <?php endif; ?>
    </div>
  </nav>


  <!-- Hero Slider -->
  <section class="hero-slider" id="beranda">
    <div class="slider-container">
      <div class="slide active">
        <img src="<?= base_url('public/img/hero/hero1.jpeg') ?>" alt="" />
      </div>
      <div class="slide">
        <img src="<?= base_url('public/img/hero/hero2.jpeg') ?>" alt="" />
      </div>
      <div class="slide">
        <img src="<?= base_url('public/img/hero/hero3.jpeg') ?>" alt="" />
      </div>

      <!-- Navigation Arrows -->
      <button class="slider-nav prev" onclick="previousSlide()">‹</button>
      <button class="slider-nav next" onclick="nextSlide()">›</button>

      <!-- Indicators -->
      <div class="slider-indicators">
        <div class="indicator active" onclick="currentSlide(1)"></div>
        <div class="indicator" onclick="currentSlide(2)"></div>
        <div class="indicator" onclick="currentSlide(3)"></div>
      </div>
    </div>
  </section>

  <!-- Kenapa Pilih Jasa Jahit Section -->
  <section class="sambutan" id="tentang-jasa">
    <div class="container">

      <!-- Feature Icons -->
      <div class="feature-grid">
        <div class="feature-item">
          <div class="feature-thumb count-thumb">
            <span>10+</span>
          </div>
          <p>Tahun<br />Pengalaman</p>
        </div>

        <div class="feature-item">
          <div class="feature-thumb count-thumb">
            <span>1500+</span>
          </div>
          <p>Pelanggan<br />Puas</p>
        </div>

        <div class="feature-item">
          <div class="feature-thumb count-thumb">
            <span>100%</span>
          </div>
          <p>Jahitan<br />Presisi</p>
        </div>

        <div class="feature-item">
          <div class="feature-thumb count-thumb">
            <span>Fast</span>
          </div>
          <p>Proses<br />Cepat</p>
        </div>
      </div>

      <!-- Heading & Description -->
      <div class="why">
        <h2>Mengapa Pilih <span class="highlight">Jasa Jahit Kami</span>?</h2>
        <h3>
          Kami menghadirkan layanan jahit dengan standar kualitas tinggi, detail presisi,
          serta sentuhan profesional. Setiap jahitan dikerjakan dengan ketelitian,
          menggunakan bahan terbaik dan disesuaikan dengan kebutuhan pelanggan.
          Kepuasan Anda adalah prioritas utama kami.
        </h3>
      </div>
    </div>

    <!-- Statistics Band -->
    <div class="stats-band">
      <div class="stats-wrapper">
        <div class="stat-card">
          <span class="stat-label">Kualitas Jahitan</span>
          <span class="stat-value accent">PREMIUM</span>
        </div>

        <div class="stat-card">
          <span class="stat-label">Ketepatan Ukuran</span>
          <span class="stat-value">AKURAT</span>
        </div>

        <div class="stat-card">
          <span class="stat-label">Kepercayaan Pelanggan</span>
          <span class="stat-value accent">TINGGI</span>
        </div>
      </div>
    </div>
  </section>

  <section class="temukan-layanan" id="jasa" style="margin-top: 100px;">
    <div class="container">
      <h2 class="tp-title">Temukan Layanan Jahit Terbaik untuk Anda</h2>

      <!-- Filter Tabs -->
      <div class="tp-filters" role="tablist" aria-label="Filter Layanan">
        <button class="tp-filter active" data-filter="all" role="tab" aria-selected="true">
          Semua Layanan
        </button>
        <?php foreach ($kategori_array as $kategori) : ?>
          <button class="tp-filter" data-filter="kategori-<?= $kategori['id_kategori'] ?>" role="tab" aria-selected="false">
            <?= htmlspecialchars($kategori['nama_kategori']) ?>
          </button>
        <?php endforeach ?>
      </div>

      <!-- Intro Text - akan disembunyikan saat empty state muncul -->
      <h3 class="tp-intro" id="introText" style="font-weight: normal;">
        Kami menyediakan berbagai layanan jahit profesional mulai dari kebutuhan
        harian hingga busana formal dan custom eksklusif. Setiap jahitan dikerjakan
        dengan ketelitian, bahan berkualitas, dan sentuhan pengalaman untuk
        memastikan hasil yang rapi, nyaman, dan sesuai keinginan Anda.
      </h3>

      <!-- Programs Grid -->
      <div class="tp-grid" id="programGrid">
        <?php
        $total_layanan = 0;
        foreach ($layanan_by_kategori as $id_kat => $layanan_list) {
          foreach ($layanan_list as $layanan) {
            $total_layanan++;
        ?>
            <article class="tp-card" data-category="kategori-<?= $layanan['id_kategori'] ?>">
              <div class="tp-card-media">
                <img src="<?= base_url('public/img/layanan/' . $layanan['foto']) ?>" alt="<?= htmlspecialchars($layanan['nama_layanan']) ?>" loading="lazy" />
              </div>
              <div class="tp-card-body">
                <h3><?= htmlspecialchars($layanan['nama_layanan']) ?></h3>
                <p><?= htmlspecialchars($layanan['deskripsi']) ?></p>
                <a href="<?= base_url('front/detail_layanan.php?id=' . $layanan['id_layanan']) ?>" class="tp-card-btn">Detail Layanan</a>
              </div>
            </article>
          <?php
          }
        }

        // Jika tidak ada layanan sama sekali
        if ($total_layanan == 0) :
          ?>
          <div class="col-12">
            <div class="alert alert-info text-center" role="alert">
              <i class="icon-copy dw dw-information" style="font-size: 48px;"></i>
              <h4 class="alert-heading mt-3">Layanan Belum Tersedia</h4>
              <p class="mb-0">Maaf, saat ini belum ada layanan yang tersedia. Silakan hubungi kami untuk informasi lebih lanjut.</p>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <!-- Empty State Modern - untuk kategori kosong -->
      <div id="emptyState" style="display: none;">
        <div class="empty-state-wrapper">
          <div class="empty-state-card">

            <div class="icon-box">
              <i class="dw dw-broken-link"></i>
            </div>

            <h3>Layanan Belum Tersedia</h3>

            <p>
              Untuk kategori yang Anda pilih, layanan masih dalam tahap
              <strong>pengembangan</strong> dan belum dapat ditampilkan saat ini.
              <br>
              Silakan jelajahi kategori lain atau hubungi kami untuk informasi lebih lanjut.
            </p>

            <div class="action-group">
              <button class="btn" onclick="showAllServices()">
                <i class="dw dw-left-arrow-3"></i> Lihat Semua Layanan
              </button>
            </div>

          </div>
        </div>
      </div>

    </div>
  </section>

  <section class="section-timeline" id="process">
    <div class="page-wrapper">

      <!-- HEADING -->
      <div class="section-timeline-heading">
        <div class="container">
          <div class="padding-vertical-xlarge">
            <div class="timeline-main_heading-wrapper">
              <div class="margin-bottom-medium">
                <h2 class="title-timeline">From Fabric to Fit</h2>
              </div>
              <p class="paragraph-large">
                Setiap langkah kami kerjakan dengan presisi, detail, dan rasa —
                memastikan setiap jahitan mencerminkan kualitas dan karakter Anda.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- TIMELINE -->
      <div class="container">
        <div class="timeline-component">

          <!-- PROGRESS LINE -->
          <div class="timeline_progress">
            <div class="timeline_progress-bar"></div>
          </div>

          <!-- STEP 1 -->
          <div class="timeline_item">
            <div class="timeline_left">
              <div class="timeline_date-text">01</div>
            </div>

            <div class="timeline_centre">
              <div class="timeline_circle"></div>
            </div>

            <div class="timeline-right">
              <div class="margin-bottom-medium">
                <div class="timeline_text">
                  Konsultasi & Pengukuran
                  <span class="text-colour-lightgrey">
                    — kami mendengarkan kebutuhan dan mengambil ukuran secara detail.
                  </span>
                </div>
              </div>

              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero1.jpeg') ?>" alt="Konsultasi dan pengukuran" loading="lazy" />
              </div>
            </div>
          </div>

          <!-- STEP 2 -->
          <div class="timeline_item">
            <div class="timeline-right">
              <div class="margin-bottom-medium">
                <div class="timeline_text">
                  Pemilihan Kain
                  <span class="text-colour-lightgrey">
                    — bahan terbaik disesuaikan dengan fungsi dan karakter.
                  </span>
                </div>
              </div>
              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero2.jpeg') ?>" alt="Konsultasi dan pengukuran" loading="lazy" />
              </div>
            </div>

            <div class="timeline_centre">
              <div class="timeline_circle"></div>
            </div>

            <div class="timeline_right">
              <div class="timeline_date-text">02</div>
            </div>


          </div>

          <!-- STEP 3 -->
          <div class="timeline_item">
            <div class="timeline_left">
              <div class="timeline_date-text">03</div>
            </div>

            <div class="timeline_centre">
              <div class="timeline_circle"></div>
            </div>

            <div class="timeline-right">
              <div class="margin-bottom-medium">
                <div class="timeline_text">
                  Pola & Potong
                  <span class="text-colour-lightgrey">
                    — presisi pola menentukan hasil akhir yang sempurna.
                  </span>
                </div>
              </div>
              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero3.jpeg') ?>" alt="Konsultasi dan pengukuran" loading="lazy" />
              </div>
            </div>
          </div>

          <!-- STEP 4 -->
          <div class="timeline_item">
            <div class="timeline-right">
              <div class="margin-bottom-medium">
                <div class="timeline_text">
                  Jahit & Finishing
                  <span class="text-colour-lightgrey">
                    — detail halus pada setiap jahitan.
                  </span>
                </div>
              </div>
              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero1.jpeg') ?>" alt="Konsultasi dan pengukuran" loading="lazy" />
              </div>
            </div>

            <div class="timeline_centre">
              <div class="timeline_circle"></div>
            </div>

            <div class="timeline_right">
              <div class="timeline_date-text">04</div>
            </div>
          </div>

          <!-- STEP 5 -->
          <div class="timeline_item">
            <div class="timeline_left">
              <div class="timeline_date-text">05</div>
            </div>

            <div class="timeline_centre">
              <div class="timeline_circle"></div>
            </div>

            <div class="timeline-right">
              <div class="margin-bottom-medium">
                <div class="timeline_text">
                  Fitting Akhir
                  <span class="text-colour-lightgrey">
                    — memastikan kenyamanan dan kesempurnaan.
                  </span>
                </div>
              </div>
              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero2.jpeg') ?>" alt="Konsultasi dan pengukuran" loading="lazy" />
              </div>
            </div>
          </div>

          <!-- OVERLAY -->
          <div class="overlay-fade-top"></div>
          <div class="overlay-fade-bottom"></div>

        </div>
      </div>
    </div>
  </section>

  <section class="jahit-gallery" id="process-gallery">
    <div class="km-container">
      <h2>Workshop & Proses Jahit Kami</h2>
      <h3 class="km-intro">
        Setiap detail kami kerjakan langsung di workshop kami — mulai dari
        pengukuran, pemilihan kain, hingga finishing akhir dengan standar kualitas tinggi.
      </h3>

      <div class="km-grid">
        <figure class="km-item km-item--auditorium">
          <img src="<?= base_url('public/img/galeri/Mesin-Jahit-Benang.jpg') ?>" alt="Workshop Jahit" loading="lazy" />
          <figcaption>Workshop Jahit</figcaption>
        </figure>

        <figure class="km-item km-item--rapat">
          <img src="<?= base_url('public/img/galeri/ngukur-kain.jpg') ?>" alt="Konsultasi Pelanggan" loading="lazy" />
          <figcaption>Konsultasi & Ukur</figcaption>
        </figure>

        <figure class="km-item km-item--lab">
          <img src="<?= base_url('public/img/galeri/cutting-cloth.jpg') ?>" alt="Pembuatan Pola" loading="lazy" />
          <figcaption>Pola & Potong</figcaption>
        </figure>

        <figure class="km-item km-item--perpus">
          <img src="<?= base_url('public/img/galeri/jahit-kain.jpg') ?>" alt="Finishing Jahitan" loading="lazy" />
          <figcaption>Jahit & Finishing</figcaption>
        </figure>
      </div>
    </div>
  </section>

  <!-- Popup Chat Pelanggan -->
  <?php if (!empty($_SESSION['login']) && ($_SESSION['role'] ?? '') === 'pelanggan') : ?>
    <div id="chatPopup" class="chat-popup">
      <div class="chat-header">
        <span>Chat dengan Penjahit</span>
        <button type="button" class="chat-close" onclick="closeChatPopup()">×</button>
      </div>
      <div id="chatMessages" class="chat-messages">
        <!-- Pesan dimuat via AJAX -->
      </div>
      <form id="chatForm" class="chat-form">
        <input type="text" id="chatInput" placeholder="Tulis pesan..." autocomplete="off" required />
        <button type="submit">Kirim</button>
      </form>
    </div>
  <?php endif; ?>

  <!-- WHATSAPP FLOAT GOLDEN -->
  <a href="https://wa.me/6285720301295?text=Halo%20saya%20ingin%20konsultasi%20jasa%20jahit"
    class="wa-golden"
    target="_blank"
    aria-label="Chat WhatsApp Ja sa Jahit">
    <i class="fab fa-whatsapp"></i>
  </a>


  <!-- ================= FAQ ================= -->
  <section class="faq-section" id="faq">
    <div class="container">

      <div class="faq-heading">
        <h2>Pertanyaan yang <span class="highlight">Sering Diajukan</span></h2>
        <p>
          Temukan jawaban seputar layanan jasa jahit kami dengan mudah dan cepat.
        </p>
      </div>

      <div class="faq-wrapper">

        <div class="faq-item">
          <button class="faq-question">
            Apakah bisa jahit baju sesuai desain sendiri?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p>
              Tentu bisa. Anda dapat membawa desain sendiri atau referensi gambar,
              dan kami akan membantu menyesuaikan model, ukuran, serta bahan agar
              hasilnya maksimal dan nyaman dipakai.
            </p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">
            Berapa lama proses pengerjaan jahit?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p>
              Waktu pengerjaan tergantung tingkat kesulitan dan jumlah pesanan.
              Rata-rata proses jahit membutuhkan waktu 3–7 hari kerja.
            </p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">
            Apakah menerima permak atau revisi ukuran?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p>
              Ya, kami menerima permak dan revisi ukuran seperti mengecilkan,
              membesarkan, atau memperbaiki jahitan agar pas di badan.
            </p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question">
            Apakah harus datang langsung ke toko?
            <span class="faq-icon">+</span>
          </button>
          <div class="faq-answer">
            <p>
              Untuk pengukuran disarankan datang langsung ke toko.
              Namun untuk konsultasi awal, Anda bisa menghubungi kami terlebih dahulu
              melalui WhatsApp atau form pesan.
            </p>
          </div>
        </div>

      </div>

    </div>
  </section>


  <!-- ================= CONTACT & LOCATION ================= -->
  <section class="contact-location" id="kontak">
    <div class="container">

      <div class="contact-wrapper">

        <!-- LEFT : FORM -->
        <div class="contact-card">
          <h2>Hubungi <span class="highlight">Kami</span></h2>
          <p class="contact-desc">
            Kirim pesan atau pertanyaan Anda terkait jasa jahit kami.
            Kami siap membantu dengan sepenuh hati.
          </p>

          <form class="contact-form" id="waForm">
            <div class="form-group">
              <label>Email</label>
              <input type="email" id="email" placeholder="email@example.com" required>
            </div>

            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" id="nama" placeholder="Nama Anda" required>
            </div>

            <div class="form-group">
              <label>Pesan</label>
              <textarea id="pesan" rows="4" placeholder="Tuliskan pesan Anda..." required></textarea>
            </div>

            <button type="submit" class="btn-submit">
              Kirim Pesan
            </button>
          </form>
        </div>

        <!-- RIGHT : MAP -->
        <div class="map-card">
          <iframe
            src="https://www.google.com/maps?q=-6.689232,108.550924&z=17&output=embed"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
          <div class="map-info">
            <h4>📍 Lokasi Toko Jahit Jadimulya</h4>
            <p>Jadimulya, Kabupaten Bekasi<br>Jawa Barat, Indonesia</p>
          </div>
        </div>

      </div>

    </div>
  </section>

  <footer class="site-footer">
    <div class="footer-main">

      <!-- LEFT -->
      <div class="footer-left">
        <!-- LOGO -->
        <div class="footer-logo">
          <img src="<?= base_url('public/img/logo/logo-jasa-jahit.png') ?>" alt="Jasa Jahit Logo">
        </div>

        <!-- LINKS -->
        <div class="footer-links">
          <ul>
            <li><a href="#layanan">Layanan Jahit</a></li>
            <li><a href="#process">Proses Pengerjaan</a></li>
            <li><a href="#portfolio">Hasil Jahitan</a></li>
            <li><a href="#testimoni">Testimoni</a></li>
          </ul>

          <ul>
            <li><a href="#tentang">Tentang Kami</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#kontak">Kontak</a></li>
          </ul>
        </div>

        <!-- CONTACT -->
        <div class="footer-contact">
          <p>Jl. Gunung Jati Gg. Mushollah, Desa Jadimulya, RT 02/RW 01, Kecamatan Gunung Jati, Kabupaten Cirebon, Provinsi Jawa Barat</p>
          <p>WhatsApp: +62 896-8250-6082</p>
          <p>Email: aldivamuhammad@gmail.com</p>
          <p>Jam Operasional: Senin – Sabtu, 09.00 – 18.00</p>
        </div>
      </div>

      <!-- RIGHT -->
      <div class="footer-right">
        <!-- SOCIAL -->
        <div class="footer-social">
          <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
          <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
          <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        </div>

        <!-- DECORATIVE IMAGE -->
        <div class="footer-rektorat">
          <img src="<?= base_url('public/img/footer/toko-jahit.png') ?>" alt="Mesin Jahit">
        </div>
      </div>

    </div>

    <!-- COPYRIGHT -->
    <div class="footer-copy">
      <p>© 2025 Jasa Jahit — Tailored with Precision & Care.</p>
    </div>
  </footer>


  <button id="backToTop" class="back-to-top" aria-label="Kembali ke atas" title="Kembali ke atas">
    ▲
  </button>

  <script>
    let chatPollingInterval = null;

    function openChatPopup() {
      const popup = document.getElementById('chatPopup');
      if (!popup) return;
      popup.classList.add('open');
      loadChatMessages();
      if (!chatPollingInterval) {
        chatPollingInterval = setInterval(loadChatMessages, 3000);
      }
    }

    function closeChatPopup() {
      const popup = document.getElementById('chatPopup');
      if (!popup) return;
      popup.classList.remove('open');
      if (chatPollingInterval) {
        clearInterval(chatPollingInterval);
        chatPollingInterval = null;
      }
    }

    function appendMessages(messages) {
      const container = document.getElementById('chatMessages');
      if (!container) return;
      container.innerHTML = '';
      messages.forEach(function(m) {
        const div = document.createElement('div');
        div.className = 'chat-message ' + (m.sender === 'pelanggan' ? 'you' : 'admin');
        div.textContent = m.message;
        container.appendChild(div);
      });
      container.scrollTop = container.scrollHeight;
    }

    function loadChatMessages() {
      fetch('<?= base_url('pelanggan/chat_get.php') ?>')
        .then(function(r) {
          return r.json();
        })
        .then(function(data) {
          if (data.success) {
            appendMessages(data.messages);
          }
        })
        .catch(function() {});
    }

    document.addEventListener('DOMContentLoaded', function() {
      const form = document.getElementById('chatForm');
      if (!form) return;

      form.addEventListener('submit', function(e) {
        e.preventDefault();
        const input = document.getElementById('chatInput');
        const text = input.value.trim();
        if (!text) return;

        fetch('<?= base_url('pelanggan/chat_send.php') ?>', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'message=' + encodeURIComponent(text)
          })
          .then(function(r) {
            return r.json();
          })
          .then(function(data) {
            if (data.success) {
              input.value = '';
              loadChatMessages();
            }
          })
          .catch(function() {});
      });
    });
  </script>

  <script>
    function userMenuToggle() {
      document.querySelector('.user-menu').classList.toggle('active');
    }

    // klik di luar → menu menutup
    document.addEventListener('click', function(e) {
      const action = document.querySelector('.user-action');
      if (!action.contains(e.target)) {
        document.querySelector('.user-menu')?.classList.remove('active');
      }
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const filters = document.querySelectorAll('.tp-filter');
      const cards = document.querySelectorAll('.tp-card');
      const grid = document.getElementById('programGrid');
      const emptyState = document.getElementById('emptyState');

      filters.forEach(filter => {
        filter.addEventListener('click', function() {
          const filterValue = this.getAttribute('data-filter');

          // Update active state
          filters.forEach(f => {
            f.classList.remove('active');
            f.setAttribute('aria-selected', 'false');
          });
          this.classList.add('active');
          this.setAttribute('aria-selected', 'true');

          let visibleCount = 0;

          // Filter cards
          cards.forEach(card => {
            if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
              card.style.display = 'block';
              visibleCount++;
            } else {
              card.style.display = 'none';
            }
          });

          // Show/hide empty state
          if (visibleCount === 0) {
            emptyState.style.display = 'block';
            cards.forEach(card => card.style.display = 'none');
          } else {
            emptyState.style.display = 'none';
          }
        });
      });
    });

    function showAllServices() {
      const allButton = document.querySelector('.tp-filter[data-filter="all"]');
      if (allButton) {
        allButton.click();
      }
    }
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const filters = document.querySelectorAll('.tp-filter');
      const cards = document.querySelectorAll('.tp-card');
      const grid = document.getElementById('programGrid');
      const emptyState = document.getElementById('emptyState');
      const introText = document.getElementById('introText');

      filters.forEach(filter => {
        filter.addEventListener('click', function() {
          const filterValue = this.getAttribute('data-filter');

          // Update active state
          filters.forEach(f => {
            f.classList.remove('active');
            f.setAttribute('aria-selected', 'false');
          });
          this.classList.add('active');
          this.setAttribute('aria-selected', 'true');

          let visibleCount = 0;

          // Filter cards
          cards.forEach(card => {
            if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
              card.style.display = 'block';
              visibleCount++;
            } else {
              card.style.display = 'none';
            }
          });

          // Show/hide empty state dan intro text
          if (visibleCount === 0) {
            // Sembunyikan intro text
            introText.style.display = 'none';
            // Sembunyikan grid
            grid.style.display = 'none';
            // Tampilkan empty state
            emptyState.style.display = 'block';
          } else {
            // Tampilkan intro text
            introText.style.display = 'block';
            // Tampilkan grid
            grid.style.display = 'grid';
            // Sembunyikan empty state
            emptyState.style.display = 'none';
          }
        });
      });
    });

    function showAllServices() {
      const allButton = document.querySelector('.tp-filter[data-filter="all"]');
      if (allButton) {
        allButton.click();
      }
    }
  </script>
  <script src="<?= base_url('public/js/scroll.js') ?>"></script>
  <script src="<?= base_url('public/js/script.js') ?>"></script>
  <script src="<?= base_url('public/js/burgermenu.js') ?>"></script>
  <script src="<?= base_url('public/js/faq.js') ?>"></script>
  <script src="<?= base_url('public/js/whatsapp-form.js') ?>"></script>
  <script src="<?= base_url('public/js/backtotop.js') ?>"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Alert Berhasil -->
  <?php if (isset($_SESSION['berhasil'])) : ?>
    <script>
      const Berhasil = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Berhasil.fire({
        icon: "success",
        title: "<?= $_SESSION['berhasil'] ?>"
      });
    </script>
    <?php unset($_SESSION['berhasil']); ?>

  <?php endif; ?>
</body>

</html>

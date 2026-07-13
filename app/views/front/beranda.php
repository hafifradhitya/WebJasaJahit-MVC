<?php require_once __DIR__ . '/../layouts/header.php'; ?>


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
      <button class="slider-nav prev" onclick="previousSlide()">&#10094;</button>
      <button class="slider-nav next" onclick="nextSlide()">&#10095;</button>

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
        <?php foreach ($kategori_array as $kategori): ?>
          <button class="tp-filter" data-filter="kategori-<?= $kategori['id_kategori'] ?>" role="tab"
            aria-selected="false">
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
                <img src="<?= base_url('public/img/layanan/' . $layanan['foto']) ?>"
                  alt="<?= htmlspecialchars($layanan['nama_layanan']) ?>" loading="lazy" />
              </div>
              <div class="tp-card-body">
                <h3><?= htmlspecialchars($layanan['nama_layanan']) ?></h3>
                <p><?= htmlspecialchars($layanan['deskripsi']) ?></p>
                <a href="<?= base_url('front/detail_layanan.php?slug=' . $layanan['slug']) ?>"
                  class="tp-card-btn">Detail Layanan</a>
              </div>
            </article>
            <?php
          }
        }

        // Jika tidak ada layanan sama sekali
        if ($total_layanan == 0):
          ?>
          <div class="col-12">
            <div class="alert alert-info text-center" role="alert">
              <i class="icon-copy dw dw-information" style="font-size: 48px;"></i>
              <h4 class="alert-heading mt-3">Layanan Belum Tersedia</h4>
              <p class="mb-0">Maaf, saat ini belum ada layanan yang tersedia. Silakan hubungi kami untuk informasi lebih
                lanjut.</p>
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
                Setiap langkah kami kerjakan dengan presisi, detail, dan rasa -
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
                    - kami mendengarkan kebutuhan dan mengambil ukuran secara detail.
                  </span>
                </div>
              </div>

              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero1.jpeg') ?>" alt="Konsultasi dan pengukuran"
                  loading="lazy" />
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
                    - bahan terbaik disesuaikan dengan fungsi dan karakter.
                  </span>
                </div>
              </div>
              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero2.jpeg') ?>" alt="Konsultasi dan pengukuran"
                  loading="lazy" />
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
                    - presisi pola menentukan hasil akhir yang sempurna.
                  </span>
                </div>
              </div>
              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero3.jpeg') ?>" alt="Konsultasi dan pengukuran"
                  loading="lazy" />
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
                    - detail halus pada setiap jahitan.
                  </span>
                </div>
              </div>
              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero1.jpeg') ?>" alt="Konsultasi dan pengukuran"
                  loading="lazy" />
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
                    - memastikan kenyamanan dan kesempurnaan.
                  </span>
                </div>
              </div>
              <!-- IMAGE -->
              <div class="timeline-image-wrapper">
                <img src="<?= base_url('public/img/hero/hero2.jpeg') ?>" alt="Konsultasi dan pengukuran"
                  loading="lazy" />
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
        Setiap detail kami kerjakan langsung di workshop kami - mulai dari
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


<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

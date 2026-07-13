  <!-- Popup Chat Pelanggan -->
  <div id="chatOverlay" class="chat-overlay" onclick="closeChatPopup()"></div>
  <div id="chatPopup" class="chat-popup">
    <div class="chat-header">
      <div class="chat-title">
        <div class="chat-avatar">
          <i class="fas fa-headset"></i>
        </div>
        <div class="chat-title-text">
          <strong>Asisten AI Jadimulya</strong>
          <span class="chat-status">Online via Google Gemini</span>
        </div>
      </div>
      <button type="button" class="close-btn" onclick="closeChatPopup()" aria-label="Tutup chat">&times;</button>
    </div>
    <div id="chatMessages" class="chat-messages">
      <!-- Pesan dimuat via AJAX -->
    </div>
    <form id="chatForm" class="chat-form">
      <input type="text" id="chatInput" placeholder="Tulis pesan..." autocomplete="off" required />
      <button type="submit" aria-label="Kirim pesan">
        <i class="fas fa-paper-plane"></i>
      </button>
    </form>
    <button type="button" id="chatCloseBottom" class="chat-bottom-close" onclick="closeChatPopup()" aria-label="Tutup chat">
      <i class="fas fa-times"></i>
    </button>
  </div>

  <!-- CHATBOT FLOAT GOLDEN (Kiri Atas) -->
  <button type="button" id="aiFloatingButton" class="ai-golden" onclick="toggleChatPopup()" aria-label="Chat customer service">
    <i class="fas fa-headset"></i>
  </button>

  <!-- WHATSAPP FLOAT GOLDEN (Kiri Bawah) -->
  <a href="https://wa.me/6285720301295?text=Halo%20saya%20ingin%20konsultasi%20jasa%20jahit" class="wa-golden wa-left" target="_blank" aria-label="Chat WhatsApp Jasa Jahit" style="text-decoration: none;">
    <i class="fab fa-whatsapp"></i>
  </a>

  <!-- PESAN FLOAT GOLDEN (Kanan) -->
  <a href="<?= base_url('#jasa') ?>" class="wa-golden" aria-label="Tambah Pesanan" style="text-decoration: none;">
    <i class="fas fa-shopping-cart"></i>
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
              Rata-rata proses jahit membutuhkan waktu 3-7 hari kerja.
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
          <h2>Kerja Sama <span class="highlight">Bisnis</span></h2>
          <p class="contact-desc">
            Tertarik untuk menjalin kemitraan atau kerja sama bisnis dengan Jahit Jadimulya? 
            Kirimkan penawaran atau proposal Anda melalui form di bawah ini.
          </p>

          <form class="contact-form" action="<?= base_url('beranda/send_email') ?>" method="POST">
            <div class="form-group">
              <label>Email Perusahaan / Pribadi</label>
              <input type="email" id="email" name="email" placeholder="email@perusahaan.com" required>
            </div>

            <div class="form-group">
              <label>Nama Lengkap / Instansi</label>
              <input type="text" id="nama" name="nama" placeholder="Nama Anda / Instansi" required>
            </div>

            <div class="form-group">
              <label>Pesan Penawaran</label>
              <textarea id="pesan" name="pesan" rows="4" placeholder="Tuliskan pesan penawaran kerja sama..." required></textarea>
            </div>

            <button type="submit" class="btn-submit">
              Kirim Pesan
            </button>
          </form>
        </div>

        <!-- RIGHT : MAP -->
        <div class="map-card">
          <iframe src="https://www.google.com/maps?q=-6.689232,108.550924&z=17&output=embed" allowfullscreen
            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
          </iframe>
          <div class="map-info">
            <h4>ðŸ“ Lokasi Toko Jahit Jadimulya</h4>
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
          <p>Jl. Gunung Jati Gg. Mushollah, Desa Jadimulya, RT 02/RW 01, Kecamatan Gunung Jati, Kabupaten Cirebon,
            Provinsi Jawa Barat</p>
          <p>WhatsApp: +62 896-8250-6082</p>
          <p>Email: aldivamuhammad@gmail.com</p>
          <p>Jam Operasional: Senin - Sabtu, 09.00 - 18.00</p>
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
      <p>&copy; 2025 Jasa Jahit &mdash; Tailored with Precision & Care.</p>
    </div>
  </footer>


  <!-- BACK TO TOP BUTTON -->
  <button type="button" id="backToTop" class="back-to-top" onclick="scrollToTop()" aria-label="Kembali ke atas">
    &#9650;
  </button>

  <script>
    function appendMessage(text, sender) {
      const container = document.getElementById('chatMessages');
      if (!container) return;
      const div = document.createElement('div');
      div.className = 'chat-message ' + (sender === 'user' ? 'you' : 'admin');
      if (sender === 'user') {
        div.textContent = text;
      } else {
        div.innerHTML = text;
      }
      container.appendChild(div);
      container.scrollTop = container.scrollHeight;
    }

    // Flag for initial message
    let chatOpened = false;
    let chatHistory = [];
    let chatCloseTimer = null;

    function htmlToText(html) {
      const div = document.createElement('div');
      div.innerHTML = html;
      return div.textContent || div.innerText || '';
    }

    function pulseAiButton() {
      const aiButton = document.getElementById('aiFloatingButton');
      if (!aiButton) return;
      aiButton.classList.remove('vortex-pulse');
      void aiButton.offsetWidth;
      aiButton.classList.add('vortex-pulse');
      window.setTimeout(function () {
        aiButton.classList.remove('vortex-pulse');
      }, 700);
    }

    function setAiButtonOpen(isOpen) {
      const aiButton = document.getElementById('aiFloatingButton');
      if (!aiButton) return;
      const icon = aiButton.querySelector('i');
      aiButton.classList.toggle('chat-open', isOpen);
      aiButton.setAttribute('aria-label', isOpen ? 'Tutup chat customer service' : 'Chat customer service');
      if (icon) {
        icon.className = isOpen ? 'fas fa-times' : 'fas fa-headset';
      }
    }

    function toggleChatPopup() {
      const popup = document.getElementById('chatPopup');
      if (popup && popup.classList.contains('open')) {
        closeChatPopup();
      } else {
        openChatPopup();
      }
    }

    function openChatPopup() {
      const popup = document.getElementById('chatPopup');
      const overlay = document.getElementById('chatOverlay');
      if (!popup) return;
      if (chatCloseTimer) {
        window.clearTimeout(chatCloseTimer);
        chatCloseTimer = null;
      }
      pulseAiButton();
      popup.classList.remove('vortex-out');
      popup.classList.add('vortex-in');
      popup.classList.add('open');
      if (overlay) overlay.classList.add('open');
      setAiButtonOpen(true);
      
      if (!chatOpened) {
        const greeting = 'Halo! Saya Asisten AI Jadimulya Jasa Jahit.<br>Saya bisa bantu info harga, layanan, estimasi pengerjaan, alamat, jam buka, dan kontak pemesanan.';
        appendMessage(greeting, 'admin');
        chatHistory.push({ role: 'assistant', content: htmlToText(greeting) });
        chatOpened = true;
      }
    }

    function closeChatPopup() {
      const popup = document.getElementById('chatPopup');
      const overlay = document.getElementById('chatOverlay');
      if (!popup) return;
      pulseAiButton();
      popup.classList.remove('vortex-in');
      popup.classList.add('vortex-out');
      if (overlay) overlay.classList.remove('open');
      setAiButtonOpen(false);
      chatCloseTimer = window.setTimeout(function () {
        popup.classList.remove('open', 'vortex-out');
        chatCloseTimer = null;
      }, 420);
    }

    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('chatForm');
      if (!form) return;
      const submitButton = form.querySelector('button[type="submit"]');

      form.addEventListener('submit', function (e) {
        e.preventDefault();
        const input = document.getElementById('chatInput');
        const text = input.value.trim();
        if (!text) return;

        // Tampilkan pesan user
        appendMessage(text, 'user');
        chatHistory.push({ role: 'user', content: text });
        input.value = '';
        input.disabled = true;
        if (submitButton) submitButton.disabled = true;

        // Tampilkan indikator mengetik
        const container = document.getElementById('chatMessages');
        const loadingDiv = document.createElement('div');
        loadingDiv.className = 'chat-message admin loading-indicator';
        loadingDiv.innerHTML = '<span class="typing-dot"></span><span class="typing-dot"></span><span class="typing-dot"></span>';
        container.appendChild(loadingDiv);
        container.scrollTop = container.scrollHeight;

        fetch('<?= base_url('chatbot/reply') ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: 'message=' + encodeURIComponent(text) + '&history=' + encodeURIComponent(JSON.stringify(chatHistory.slice(-8)))
        })
          .then(function (r) {
            return r.json();
          })
          .then(function (data) {
            // Hapus indikator
            if (container.contains(loadingDiv)) {
              container.removeChild(loadingDiv);
            }
            input.disabled = false;
            if (submitButton) submitButton.disabled = false;
            input.focus();
            if (data.success) {
              appendMessage(data.reply, 'admin');
              chatHistory.push({ role: 'assistant', content: htmlToText(data.reply) });
            } else {
              const errorReply = data.reply || 'Maaf, pesan belum bisa diproses. Coba tanyakan harga, layanan, estimasi, alamat, atau kontak WhatsApp ya.';
              appendMessage(errorReply, 'admin');
              chatHistory.push({ role: 'assistant', content: htmlToText(errorReply) });
            }
          })
          .catch(function () { 
            if (container.contains(loadingDiv)) {
              container.removeChild(loadingDiv);
            }
            input.disabled = false;
            if (submitButton) submitButton.disabled = false;
            input.focus();
            const errorReply = 'Koneksi ke chatbot terputus. Coba kirim ulang pesan sebentar lagi ya.';
            appendMessage(errorReply, 'admin');
            chatHistory.push({ role: 'assistant', content: errorReply });
          });
      });
    });
  </script>

  <script>
    function userMenuToggle() {
      document.querySelector('.user-menu').classList.toggle('active');
    }

    // klik di luar area menu menutup
    document.addEventListener('click', function (e) {
      const action = document.querySelector('.user-action');
      if (!action.contains(e.target)) {
        document.querySelector('.user-menu')?.classList.remove('active');
      }
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const filters = document.querySelectorAll('.tp-filter');
      const cards = document.querySelectorAll('.tp-card');
      const grid = document.getElementById('programGrid');
      const emptyState = document.getElementById('emptyState');

      filters.forEach(filter => {
        filter.addEventListener('click', function () {
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
    document.addEventListener('DOMContentLoaded', function () {
      const filters = document.querySelectorAll('.tp-filter');
      const cards = document.querySelectorAll('.tp-card');
      const grid = document.getElementById('programGrid');
      const emptyState = document.getElementById('emptyState');
      const introText = document.getElementById('introText');

      filters.forEach(filter => {
        filter.addEventListener('click', function () {
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
  <script src="<?= base_url('public/js/backtotop.js') ?>"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Alert Berhasil -->
  <?php if (isset($_SESSION['berhasil'])): ?>
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
  <?= $extra_js ?? '' ?>
</body>

</html>

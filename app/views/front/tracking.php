<?php
$judul = 'Lacak Pesanan | Jasa Jahit Premium';
ob_start();
?>
<style>
/* ===== TRACKING PAGE CSS ===== */
        body {
            background: linear-gradient(rgba(10,10,10,0.8), rgba(10,10,10,0.8)), url('<?= base_url("public/img/hero/hero1.jpeg") ?>') center/cover fixed !important;
        }
        .main-header { background-color: #0a0a0a !important; }
        .tracking-hero {
            padding: 100px 20px 60px;
            text-align: center;
            color: #fff;
        }
        .tracking-hero h1 { font-size: 36px; color: #ecad29; margin-bottom: 15px; }
        .tracking-hero p { font-size: 16px; max-width: 600px; margin: 0 auto 30px; opacity: 0.9; color: #ddd; }
        
        .search-box {
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            display: flex;
            background: #1e140d;
            border: 1px solid rgba(236, 173, 41, 0.3);
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }
        .search-box input {
            flex: 1;
            padding: 18px 25px;
            border: none;
            outline: none;
            background: transparent;
            font-size: 16px;
            color: #fff;
        }
        .search-box input::placeholder {
            color: #888;
        }
        .search-box button {
            background: linear-gradient(135deg, #ecad29, #b8860b);
            color: #0a0a0a;
            border: none;
            padding: 0 30px;
            font-weight: 700;
            cursor: pointer;
            transition: opacity 0.3s;
        }
        .search-box button:hover { opacity: 0.85; }

        /* Hasil Pencarian */
        .tracking-result-container {
            max-width: 800px;
            margin: -30px auto 60px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .state-message {
            background: #1e140d;
            border: 1px solid rgba(236, 173, 41, 0.15);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            display: none;
            animation: fadeIn 0.4s ease;
        }
        .state-message i { font-size: 40px; color: #ecad29; margin-bottom: 15px; }
        .state-message h3 { color: #fff; margin-bottom: 10px; }
        .state-message p { color: #bbb; }

        .order-card {
            background: #1e140d;
            border: 1px solid rgba(236, 173, 41, 0.2);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            margin-bottom: 25px;
            display: none; /* hidden by default */
            animation: slideUp 0.5s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(236, 173, 41, 0.15);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .order-id { font-size: 18px; font-weight: 700; color: #ecad29; }
        .order-date { font-size: 14px; color: #999; }

        .order-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }
        .detail-item span { display: block; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .detail-item strong { display: block; font-size: 15px; color: #eee; }

        /* Progress Bar Stepper */
        .stepper {
            display: flex;
            justify-content: space-between;
            position: relative;
        }
        .step {
            text-align: center;
            flex: 1;
            position: relative;
            z-index: 1;
        }
        .step::before {
            content: '';
            position: absolute;
            top: 20px;
            left: -50%;
            width: 100%;
            height: 3px;
            background-color: #332415;
            z-index: -1;
        }
        .step:first-child::before { display: none; }
        
        .step-icon {
            width: 40px;
            height: 40px;
            background-color: #1e140d;
            border: 3px solid #332415;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 16px;
            margin-bottom: 10px;
            transition: 0.3s;
        }
        .step-label { font-size: 13px; color: #888; font-weight: 500; transition: 0.3s; }

        /* Active & Completed States */
        .step.completed .step-icon, .step.active .step-icon {
            border-color: #ecad29;
            background-color: #ecad29;
            color: #0a0a0a;
            box-shadow: 0 0 15px rgba(236, 173, 41, 0.4);
        }
        .step.completed .step-label, .step.active .step-label { color: #ecad29; }
        .step.completed::before, .step.active::before { background-color: #ecad29; }

        /* Animasi */
        @keyframes slideUp { to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        /* Responsiveness */
        @media (max-width: 768px) {
            .order-details { grid-template-columns: 1fr; }
            .step-label { font-size: 11px; }
            .step-icon { width: 30px; height: 30px; font-size: 12px; top: 15px; }
            .step::before { top: 15px; }
            .tracking-hero h1 { font-size: 28px; }
        }
</style>
<?php
$extra_css = ob_get_clean();
require_once __DIR__ . '/../layouts/header.php';
?>

<section class="tracking-hero">
        <h1>Lacak Pesanan Anda</h1>
        <p>Pantau progres jahitan Anda secara real-time. Masukkan ID Pesanan atau Nomor WhatsApp Anda di bawah ini.</p>
        
        <?php $autoKeyword = isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>
        <form id="formLacak" class="search-box">
            <input type="text" id="inputKeyword" value="<?= $autoKeyword ?>" placeholder="Contoh: INV-0109 atau 0812345678" required autocomplete="off">
            <button type="submit" id="btnSearch">
                <i class="fas fa-search"></i> Lacak
            </button>
        </form>
    </section>

    <!-- Result Section -->
    <div class="tracking-result-container" id="resultContainer">
        
        <!-- State: Welcome / Empty -->
        <div class="state-message" id="stateWelcome" style="display: block;">
            <i class="fas fa-box-open"></i>
            <h3>Siap Melacak Pesanan</h3>
            <p>Hasil pencarian Anda akan muncul di sini.</p>
        </div>

        <!-- State: Loading -->
        <div class="state-message" id="stateLoading">
            <i class="fas fa-circle-notch fa-spin"></i>
            <h3>Mencari Data...</h3>
            <p>Mohon tunggu sebentar, kami sedang mencari pesanan Anda.</p>
        </div>

        <!-- State: Error / Not Found -->
        <div class="state-message" id="stateError">
            <i class="fas fa-exclamation-triangle" style="color: #e74c3c;"></i>
            <h3 id="errorTitle">Tidak Ditemukan</h3>
            <p id="errorText">Pesanan tidak ditemukan.</p>
        </div>

        <!-- Placeholder for Dynamic Order Cards -->
        <div id="cardsWrapper"></div>

    </div>

    <!-- Template for Order Card (Hidden) -->
    <template id="orderCardTemplate">
        <div class="order-card" style="display: block;">
            <div class="order-header">
                <div class="order-id">ID Pesanan: <span class="val-id">#0</span></div>
                <div class="order-date"><i class="far fa-calendar-alt"></i> <span class="val-date"></span></div>
            </div>

            <div class="order-details">
                <div class="detail-item">
                    <span>Nama Pelanggan</span>
                    <strong class="val-name"></strong>
                </div>
                <div class="detail-item">
                    <span>Layanan</span>
                    <strong class="val-service"></strong>
                </div>
            </div>

            <!-- Stepper -->
            <div class="stepper">
                <div class="step step-menunggu">
                    <div class="step-icon"><i class="fas fa-clipboard-list"></i></div>
                    <div class="step-label">Menunggu</div>
                </div>
                <div class="step step-proses">
                    <div class="step-icon"><i class="fas fa-cut"></i></div>
                    <div class="step-label">Proses Jahit</div>
                </div>
                <div class="step step-selesai">
                    <div class="step-icon"><i class="fas fa-check-double"></i></div>
                    <div class="step-label">Selesai</div>
                </div>
                <div class="step step-diambil">
                    <div class="step-icon"><i class="fas fa-box"></i></div>
                    <div class="step-label">Diambil</div>
                </div>
            </div>

            <!-- Pembayaran -->
            <div class="payment-box" style="display:none; text-align: center; margin-top: 25px; padding: 20px; background: rgba(236,173,41,0.1); border: 1px solid #ecad29; border-radius: 10px;">
                <h4 style="color:#ecad29; margin-bottom: 15px; font-size: 16px;">Total Tagihan: <strong class="val-harga-final"></strong></h4>
                <button class="btn-bayar" data-id="" style="background: linear-gradient(135deg, #ecad29, #b8860b); color: #0a0a0a; border: none; padding: 12px 30px; font-weight: bold; border-radius: 50px; cursor: pointer; transition: 0.3s; font-size: 15px; box-shadow: 0 5px 15px rgba(236, 173, 41, 0.3);">
                    <i class="fas fa-wallet"></i> Bayar Sekarang
                </button>
            </div>
            
            <div class="lunas-box" style="display:none; text-align: center; margin-top: 25px; padding: 15px; background: rgba(39, 174, 96, 0.1); border: 1px solid #27ae60; border-radius: 10px;">
                <h4 style="color:#27ae60; margin-bottom: 0; font-size: 16px;"><i class="fas fa-check-circle"></i> Pembayaran Lunas</h4>
            </div>

            <!-- Keterangan Status -->
            <div class="order-keterangan" style="margin-top: 25px; padding: 15px 20px; background: rgba(236, 173, 41, 0.1); border-radius: 8px; border-left: 4px solid #ecad29; display: none;">
                <strong class="ket-title" style="color: #ecad29; font-size: 14px;"><i class="fas fa-info-circle"></i> Keterangan Status:</strong>
                <p class="val-keterangan" style="color: #eee; font-size: 13px; margin-top: 8px; margin-bottom: 0; line-height: 1.5;"></p>
            </div>
        </div>
    </template>

<?php
ob_start();
?>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= $_ENV['MIDTRANS_CLIENT_KEY'] ?? '' ?>"></script>
<script>
// Auto-reset UI when input is cleared
        document.getElementById('inputKeyword').addEventListener('input', function(e) {
            if (e.target.value.trim() === '') {
                document.getElementById('cardsWrapper').innerHTML = '';
                document.getElementById('stateLoading').style.display = 'none';
                document.getElementById('stateError').style.display = 'none';
                document.getElementById('stateWelcome').style.display = 'block';
            }
        });

        // AJAX Tracking Logic
        document.getElementById('formLacak').addEventListener('submit', function(e) {
            e.preventDefault();
            const keyword = document.getElementById('inputKeyword').value.trim();
            if (!keyword) return;
            
            // Format keyword for URL (always prepend INV- if it's not there)
            let urlKeyword = keyword;
            if (!/^INV\s*-/i.test(urlKeyword)) {
                urlKeyword = 'INV-' + urlKeyword;
            }
            
            // Update URL without reloading
            const newUrl = new URL(window.location.href);
            newUrl.searchParams.set('keyword', urlKeyword);
            window.history.pushState({path: newUrl.href}, '', newUrl.href);

            // UI States
            const stateWelcome = document.getElementById('stateWelcome');
            const stateLoading = document.getElementById('stateLoading');
            const stateError = document.getElementById('stateError');
            const cardsWrapper = document.getElementById('cardsWrapper');

            // Reset UI
            stateWelcome.style.display = 'none';
            stateError.style.display = 'none';
            cardsWrapper.innerHTML = '';
            stateLoading.style.display = 'block';

            // Mengirim request JSON AJAX
            fetch('<?= base_url("lacak/search") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ keyword: keyword })
            })
            .then(response => response.json())
            .then(data => {
                stateLoading.style.display = 'none';

                if (data.status === 'success') {
                    // Render Cards
                    const template = document.getElementById('orderCardTemplate');
                    const statuses = ['menunggu', 'proses', 'selesai', 'diambil'];

                    data.data.forEach((pesanan, index) => {
                        const clone = template.content.cloneNode(true);
                        
                        // Isi Detail
                        clone.querySelector('.val-id').textContent = 'INV-' + pesanan.id_pesanan.toString().padStart(4, '0');
                        clone.querySelector('.val-date').textContent = pesanan.tanggal_pesan;
                        clone.querySelector('.val-name').textContent = pesanan.nama_lengkap;
                        clone.querySelector('.val-service').textContent = pesanan.nama_layanan;

                        // Logic Progress Bar
                        const currentStatus = pesanan.status_pesanan.toLowerCase();
                        const currentIndex = statuses.indexOf(currentStatus);

                        // Iterasi ke masing-masing step
                        statuses.forEach((statusName, i) => {
                            const stepEl = clone.querySelector('.step-' + statusName);
                            if (i < currentIndex) {
                                stepEl.classList.add('completed');
                            } else if (i === currentIndex) {
                                stepEl.classList.add('active');
                            }
                        });

                        // Set Text Keterangan
                        let ketText = '';
                        let colorHex = '#ecad29'; // Default Golden
                        
                        if (currentStatus === 'menunggu') {
                            ketText = 'Pesanan Anda telah masuk dan sedang menunggu antrean untuk segera diproses.';
                        } else if (currentStatus === 'proses') {
                            ketText = 'Pesanan Anda sedang dalam tahap proses penjahitan oleh tim penjahit kami.';
                        } else if (currentStatus === 'selesai') {
                            ketText = 'Hore! Pesanan Anda sudah selesai dikerjakan dan siap untuk diambil di toko kami. Silakan datang ke lokasi dengan membawa bukti pesanan.';
                            if (pesanan.waktu_selesai) {
                                ketText += `<br><br><small><i class="far fa-clock"></i> Diselesaikan pada: <strong>${pesanan.waktu_selesai}</strong></small>`;
                            }
                            colorHex = '#3498db'; // Blue
                        } else if (currentStatus === 'diambil') {
                            ketText = 'Pesanan telah diambil oleh Anda. Terima kasih banyak telah menggunakan layanan Jasa Jahit kami!';
                            if (pesanan.waktu_selesai) {
                                ketText += `<br><br><small><i class="far fa-check-circle"></i> Diselesaikan pada: <strong>${pesanan.waktu_selesai}</strong></small>`;
                            }
                            if (pesanan.waktu_diambil) {
                                ketText += `<br><small><i class="far fa-clock"></i> Diambil pada: <strong>${pesanan.waktu_diambil}</strong></small>`;
                            }
                            colorHex = '#27ae60'; // Green
                        }
                        
                        const ketBox = clone.querySelector('.order-keterangan');
                        const ketTitle = clone.querySelector('.ket-title');
                        clone.querySelector('.val-keterangan').innerHTML = ketText;
                        
                        ketBox.style.display = 'block';
                        ketBox.style.borderLeftColor = colorHex;
                        ketBox.style.background = colorHex + '1A'; // 10% opacity hex
                        ketTitle.style.color = colorHex;

                        // Logic Payment Midtrans
                        const paymentBox = clone.querySelector('.payment-box');
                        const lunasBox = clone.querySelector('.lunas-box');
                        const btnBayar = clone.querySelector('.btn-bayar');
                        const valHargaFinal = clone.querySelector('.val-harga-final');
                        
                        const hargaBayar = (pesanan.harga_final && pesanan.harga_final > 0) ? pesanan.harga_final : ((pesanan.estimasi_harga && pesanan.estimasi_harga > 0) ? pesanan.estimasi_harga : pesanan.harga_mulai);
                        
                        if (hargaBayar > 0) {
                            if (pesanan.status_pembayaran === 'lunas') {
                                lunasBox.style.display = 'block';
                            } else if (currentStatus === 'selesai' || currentStatus === 'diambil') {
                                paymentBox.style.display = 'block';
                                valHargaFinal.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(hargaBayar);
                                btnBayar.dataset.id = pesanan.id_pesanan;
                                
                                btnBayar.addEventListener('click', function() {
                                    const originalText = this.innerHTML;
                                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                                    this.disabled = true;
                                    
                                    fetch('<?= base_url("payment/token") ?>', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'Accept': 'application/json'
                                        },
                                        body: JSON.stringify({ id_pesanan: pesanan.id_pesanan })
                                    })
                                    .then(res => res.json())
                                    .then(resData => {
                                        this.innerHTML = originalText;
                                        this.disabled = false;
                                        
                                        if (resData.status === 'success') {
                                            snap.pay(resData.token, {
                                                onSuccess: function(result){
                                                    window.location.href = '<?= base_url("payment/success?id_pesanan=") ?>' + pesanan.id_pesanan;
                                                },
                                                onPending: function(result){
                                                    Swal.fire({
                                                        icon: 'info',
                                                        title: 'Menunggu Pembayaran',
                                                        text: 'Silakan selesaikan pembayaran Anda.',
                                                        confirmButtonColor: '#ecad29',
                                                        background: '#1e140d',
                                                        color: '#fff'
                                                    });
                                                },
                                                onError: function(result){
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Pembayaran Gagal',
                                                        text: 'Maaf, transaksi pembayaran Anda gagal.',
                                                        confirmButtonColor: '#e74c3c',
                                                        background: '#1e140d',
                                                        color: '#fff'
                                                    });
                                                },
                                                onClose: function(){
                                                    // customer closed popup
                                                }
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: resData.message,
                                                confirmButtonColor: '#ecad29',
                                                background: '#1e140d',
                                                color: '#fff'
                                            });
                                        }
                                    })
                                    .catch(err => {
                                        this.innerHTML = originalText;
                                        this.disabled = false;
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Koneksi Bermasalah',
                                            text: 'Terjadi kesalahan jaringan. Silakan coba lagi.',
                                            confirmButtonColor: '#ecad29',
                                            background: '#1e140d',
                                            color: '#fff'
                                        });
                                    });
                                });
                            }
                        }

                        // Set delay untuk animasi cascade
                        const cardElement = clone.querySelector('.order-card');
                        cardElement.style.animationDelay = (index * 0.15) + 's';

                        cardsWrapper.appendChild(clone);
                    });

                } else {
                    // Error / Not Found
                    stateError.style.display = 'block';
                    document.getElementById('errorText').textContent = data.message;
                    if (data.status === 'not_found') {
                        document.getElementById('errorTitle').textContent = 'Pencarian Nihil';
                        stateError.querySelector('i').className = 'fas fa-search-minus';
                    } else {
                        document.getElementById('errorTitle').textContent = 'Terjadi Kesalahan';
                        stateError.querySelector('i').className = 'fas fa-exclamation-triangle';
                    }
                }
            })
            .catch(error => {
                stateLoading.style.display = 'none';
                stateError.style.display = 'block';
                document.getElementById('errorTitle').textContent = 'Koneksi Bermasalah';
                document.getElementById('errorText').textContent = 'Tidak dapat terhubung ke server. Periksa koneksi internet Anda.';
            });
        });

        // Auto trigger search if keyword is present
        <?php if (!empty($autoKeyword)): ?>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('btnSearch').click();
        });
        <?php endif; ?>
</script>
<?php
$extra_js = ob_get_clean();
require_once __DIR__ . '/../layouts/footer.php';
?>
document.addEventListener("DOMContentLoaded", function () {
  const formPesanWebsite = document.getElementById("formPesanWebsite");
  if (!formPesanWebsite) return;

  // Toggle Custom Size Container
  const inputUkuranPakaian = document.getElementById("inputUkuranPakaian");
  const customSizeContainer = document.getElementById("customSizeContainer");
  
  if (inputUkuranPakaian && customSizeContainer) {
      inputUkuranPakaian.addEventListener("change", function() {
          if (this.value === "Custom") {
              customSizeContainer.style.display = "block";
          } else {
              customSizeContainer.style.display = "none";
          }
      });
  }

  formPesanWebsite.addEventListener("submit", function (e) {
    e.preventDefault();

    const btnPesan = document.getElementById("btnPesanWebsite");
    const originalText = btnPesan.innerHTML;
    btnPesan.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
    btnPesan.disabled = true;

    // Get basic form data
    const idLayanan = document.getElementById("inputIdLayanan").value;
    const namaLengkap = document.getElementById("inputNamaLengkap").value;
    const noTelepon = document.getElementById("inputNoTelepon").value;
    const email = document.getElementById("inputEmail") ? document.getElementById("inputEmail").value : "";
    const catatan = document.getElementById("inputCatatan").value;
    const ukuranPakaian = inputUkuranPakaian ? inputUkuranPakaian.value : "Standar";

    // Get calculator data
    const calcBahan = document.getElementById("webCalcBahan");
    const calcKerumitan = document.getElementById("webCalcKerumitan");
    const calcTotal = document.getElementById("webCalcTotal");

    let teksBahan = "";
    let teksKerumitan = "";
    let angkaEstimasi = 0;

    if (calcBahan && calcKerumitan && calcTotal) {
      teksBahan = calcBahan.options[calcBahan.selectedIndex].text;
      teksKerumitan = calcKerumitan.options[calcKerumitan.selectedIndex].text;
      const totalEstimasiStr = calcTotal.textContent;
      
      // Extract number from string like "Rp 50.000"
      angkaEstimasi = parseInt(totalEstimasiStr.replace(/[^0-9]/g, ''), 10) || 0;
    }

    const payload = {
        id_layanan: idLayanan,
        nama_lengkap: namaLengkap,
        no_telepon: noTelepon,
        email: email,
        catatan: catatan,
        ukuran_pakaian: ukuranPakaian,
        opsi_bahan: teksBahan,
        opsi_kerumitan: teksKerumitan,
        estimasi_harga: angkaEstimasi
    };

    // If Custom Size, append size data
    if (ukuranPakaian === "Custom") {
        payload.ukuran_custom = {
            atasan: {
                lingkar_dada: document.getElementById("A_lingkar_dada").value,
                lingkar_pinggang: document.getElementById("A_lingkar_pinggang").value,
                lingkar_pinggul: document.getElementById("A_lingkar_pinggul").value,
                lebar_bahu: document.getElementById("A_lebar_bahu").value,
                panjang_lengan: document.getElementById("A_panjang_lengan").value,
                lingkar_lengan: document.getElementById("A_lingkar_lengan").value,
                panjang_baju: document.getElementById("A_panjang_baju").value,
                lingkar_leher: document.getElementById("A_lingkar_leher").value,
                model_fit: document.getElementById("A_model_fit").value,
                kegunaan: document.getElementById("A_kegunaan").value
            },
            bawahan: {
                lingkar_pinggang: document.getElementById("B_lingkar_pinggang").value,
                lingkar_pinggul: document.getElementById("B_lingkar_pinggul").value,
                panjang_celana: document.getElementById("B_panjang_celana").value,
                lingkar_paha: document.getElementById("B_lingkar_paha").value,
                lingkar_lutut: document.getElementById("B_lingkar_lutut").value,
                lingkar_kaki: document.getElementById("B_lingkar_kaki").value,
                tinggi_duduk: document.getElementById("B_tinggi_duduk").value
            }
        };
    }

    // Replace base_url path dynamically or use a relative path
    const url = '/WebJasaJahit-MVC/checkout/process';

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .then(data => {
        btnPesan.innerHTML = originalText;
        btnPesan.disabled = false;

        if (data.success) {
            Swal.fire({
                title: 'Pesanan Berhasil!',
                html: 'Kode Pesanan Anda: <strong style="font-size: 1.2em; color: #fff;">' + data.id_pesanan + '</strong><br><br>Silakan simpan kode pesanan ini untuk melacak status pesanan Anda di menu Lacak Pesanan.',
                icon: 'success',
                background: '#15110b',
                color: '#ecad29',
                confirmButtonColor: '#b68d40',
                confirmButtonText: 'Lacak Pesanan Sekarang'
            }).then(() => {
                formPesanWebsite.reset();
                if (customSizeContainer) customSizeContainer.style.display = "none";
                window.location.href = '/WebJasaJahit-MVC/lacak';
            });
        } else {
            Swal.fire({
                title: 'Gagal',
                text: data.message,
                icon: 'error',
                background: '#15110b',
                color: '#ecad29',
                confirmButtonColor: '#b68d40'
            });
        }
    })
    .catch(error => {
        console.error("Error:", error);
        btnPesan.innerHTML = originalText;
        btnPesan.disabled = false;
        Swal.fire({
            title: 'Error Jaringan',
            text: 'Terjadi kesalahan sistem, silakan coba lagi atau gunakan opsi pesan lewat WhatsApp.',
            icon: 'error',
            background: '#15110b',
            color: '#ecad29',
            confirmButtonColor: '#b68d40'
        });
    });
  });
});

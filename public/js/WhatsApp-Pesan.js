document.addEventListener("DOMContentLoaded", function () {
  const btnPesan = document.getElementById("btnPesanSekarang");
  if (!btnPesan) return;

  btnPesan.addEventListener("click", function (e) {
    e.preventDefault();

    const nomorWA = "6285720301295"; // tanpa + dan tanpa spasi

    const namaLayanan = this.dataset.namaLayanan || "";
    const kategori = this.dataset.kategori || "";
    const estimasi = this.dataset.estimasi || "";
    const hargaMulai = this.dataset.hargaMulai || "";

    const namaLengkap = this.dataset.namaLengkap || "";
    const noTelepon = this.dataset.noTelepon || "";
    const email = this.dataset.email || "-";

    const now = new Date();
    const tanggalPesan = now.toLocaleDateString("id-ID", {
      day: "2-digit",
      month: "2-digit",
      year: "numeric",
    });

    // Ambil detail tambahan jika pelanggan menggunakan fitur estimasi
    const calcBahan = document.getElementById("calcBahan");
    const calcKerumitan = document.getElementById("calcKerumitan");
    const calcTotal = document.getElementById("calcTotal");

    let teksKalkulator = "";
    if (calcBahan && calcKerumitan && calcTotal) {
      const txtBahan = calcBahan.options[calcBahan.selectedIndex].text;
      const txtKerumitan = calcKerumitan.options[calcKerumitan.selectedIndex].text;
      const totalEstimasi = calcTotal.textContent;

      teksKalkulator = 
        "Rincian Preferensi Tambahan:\n" +
        `- Ketersediaan Bahan: ${txtBahan}\n` +
        `- Tingkat Kerumitan: ${txtKerumitan}\n` +
        `Estimasi Biaya Total: ${totalEstimasi}\n\n`;
    }

    const pesan =
      "Halo, saya ingin memesan jasa jahit.\n\n" +
      "Data Pemesan:\n" +
      `Nama Lengkap : .....\n` +
      `No. Telepon : .....\n` +
      `Email : .....\n\n` +
      "Detail Pesanan:\n" +
      `Nama Layanan : ${namaLayanan}\n` +
      `Kategori : ${kategori}\n` +
      `Estimasi Waktu : ${estimasi}\n` +
      `Harga Mulai (Sistem) : Rp ${hargaMulai}\n` +
      `Tanggal Pesan : ${tanggalPesan}\n` +
      "Status Pesanan : menunggu\n\n" +
      teksKalkulator +
      "Silakan saya akan mengisi data berikut:\n" +
      "Ukuran Pakaian (Custom/S-XXXL Anak Anak, S-XXXL Dewasa) : \n\n" +
      "Jika memilih Custom, mohon isi ukuran berikut.\n" +
      "Ukuran Atasan:\n" +
      "- Lingkar dada:\n" +
      "- Lingkar pinggang:\n" +
      "- Lingkar pinggul:\n" +
      "- Lebar bahu:\n" +
      "- Panjang lengan:\n" +
      "- Lingkar lengan:\n" +
      "- Panjang baju:\n" +
      "- Lingkar leher:\n" +
      "- Model fit (fit_badan / regular / longgar):\n" +
      "- Kegunaan (formal / santai):\n\n" +
      "Ukuran Bawahan:\n" +
      "- Lingkar pinggang:\n" +
      "- Lingkar pinggul:\n" +
      "- Panjang celana:\n" +
      "- Lingkar paha:\n" +
      "- Lingkar lutut:\n" +
      "- Lingkar kaki:\n" +
      "- Tinggi duduk:\n";

    const url = `https://wa.me/${nomorWA}?text=${encodeURIComponent(pesan)}`;
    window.open(url, "_blank");
  });
});  


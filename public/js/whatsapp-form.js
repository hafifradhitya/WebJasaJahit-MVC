document.getElementById("waForm").addEventListener("submit", function (e) {
  e.preventDefault(); // stop submit biasa

  // =============================
  // AMBIL DATA FORM
  // =============================
  const nama = document.getElementById("nama").value;
  const email = document.getElementById("email").value;
  const pesan = document.getElementById("pesan").value;

  // =============================
  // NOMOR WHATSAPP TUJUAN
  // (GANTI DENGAN NOMOR KAMU)
  // =============================
  const nomorWA = "6285720301295"; // tanpa + dan tanpa spasi

  // =============================
  // FORMAT PESAN WHATSAPP
  // =============================
  const textWA =
    `Halo, saya ingin konsultasi jasa jahit.%0A%0A` +
    `Nama : ${nama}%0A` +
    `Email : ${email}%0A` +
    `Pesan : %0A${pesan}`;

  // =============================
  // REDIRECT KE WHATSAPP
  // =============================
  const url = `https://wa.me/${nomorWA}?text=${textWA}`;
  window.open(url, "_blank");
});

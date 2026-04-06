                </div>
        </div>
</div>
<!-- <div class="footer-wrap pd-20 mb-20 card-box">
        DeskApp - Bootstrap 4 Admin Template By
        <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
</div> -->
<!-- js -->
   
<script src="<?= base_url('public/scripts/core.js') ?>"></script>
<script src="<?= base_url('public/scripts/script.min.js') ?>"></script>
<script src="<?= base_url('public/scripts/process.js') ?>"></script>
<script src="<?= base_url('public/scripts/layout-settings.js') ?>"></script>
<script src="<?= base_url('public/scripts/jquery.steps.js') ?>"></script>
<script src="<?= base_url('public/scripts/steps-setting.js') ?>"></script>
<script src="<?= base_url('public/scripts/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('public/scripts/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/scripts/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('public/scripts/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('public/scripts/responsive.bootstrap4.min.js') ?>"></script>




<!-- Google Tag Manager (noscript) -->
<script>
$(document).ready(function () {
    $('#tabelsaya').DataTable({
        autoWidth: false
    });
});
$(document).ready(function () {
    $('#tabelkategori').DataTable({
        autoWidth: false
    });
});
</script>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
<!-- Alert Validasi -->
    <?php if(isset($_SESSION['validasi'])) : ?>
        <script>
            const Toast = Swal.mixin({
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
            Toast.fire({
                icon: "error",
                title: "<?= $_SESSION['validasi'] ?>"
            });
        </script>
        <?php unset($_SESSION['validasi']); ?>
    
    <?php endif; ?>

<!-- Alert Berhasil -->
    <?php if(isset($_SESSION['berhasil'])) : ?>
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

    <!-- Alert Konfirmasi Hapus -->
    <script>
        $('.tombol-hapus').on('click', function(){
            var getLink = $(this).attr('href');
            Swal.fire({
                title: "Yakin hapus?",
                text: "Data yang sudah dihapus tidak bisa dikembalikan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = getLink
                }
            })
            return false;
        });
    </script>

    


<noscript><iframe
                src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
                height="0"
                width="0"
                style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>

</html>

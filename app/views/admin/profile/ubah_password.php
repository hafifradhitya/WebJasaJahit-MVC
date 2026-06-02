<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="row justify-content-center">
    <div class="col-xl-4 col-lg-5 col-md-6">

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="text-center mb-4 font-weight-bold">Ubah Password</h5>

                <form method="POST" action="<?= base_url('admin/profile/ubah_password') ?>" autocomplete="off">
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password_baru" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Ulangi Password Baru</label>
                        <input type="password" name="ulangi_password_baru" class="form-control">
                    </div>

                    <button type="submit" name="update" class="btn btn-primary btn-block">
                        <i class="fa fa-lock"></i> Simpan Password
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>

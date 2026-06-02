<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="row justify-content-center">
    <div class="col-xl-4 col-lg-5 col-md-6">

        <div class="card shadow-sm">
            <div class="card-body text-center">

                <!-- FOTO -->
                <div class="mb-3">
                    <img
                        src="<?= base_url('public/img/foto_pelanggan/' . (!empty($user->foto) ? $user->foto : 'default.jpg')) ?>"
                        class="rounded-circle"
                        style="width:120px;height:120px;object-fit:cover;border:4px solid #f2f2f2;"
                        alt="Foto Profile">
                </div>

                <!-- NAMA -->
                <h5 class="mb-1 font-weight-bold"><?= htmlspecialchars($user->nama_lengkap ?? '') ?></h5>
                <small class="text-muted"><?= htmlspecialchars(strtoupper($user->role ?? '')) ?></small>

                <hr>

                <!-- DATA -->
                <table class="table table-borderless text-left">
                    <tr>
                        <td width="40%">Email</td>
                        <td>: <?= htmlspecialchars($user->email ?? '') ?></td>
                    </tr>
                    <tr>
                        <td>No. Telepon</td>
                        <td>: <?= htmlspecialchars($user->no_telepon ?? '') ?></td>
                    </tr>
                </table>

                <!-- BUTTON EDIT -->
                <button class="btn btn-primary btn-block mt-3" data-toggle="modal" data-target="#editProfile">
                    <i class="fa fa-edit"></i> Ubah Profile
                </button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProfile" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="<?= base_url('admin/profile') ?>" enctype="multipart/form-data">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Ubah Profile</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control"
                            value="<?= htmlspecialchars($user->nama_lengkap ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                            value="<?= htmlspecialchars($user->email ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="text" name="no_telepon" class="form-control"
                            value="<?= htmlspecialchars($user->no_telepon ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label>Foto Profile (Opsional)</label>
                        <input type="file" name="foto" class="form-control-file">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" name="update_profile" class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>

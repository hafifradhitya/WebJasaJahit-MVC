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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form method="POST" action="<?= base_url('admin/profile') ?>" enctype="multipart/form-data" style="width: 100%;">
            <div class="modal-content" style="border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">

                <div class="modal-header" style="background: #f8f9fa; border-bottom: 1px solid #edf0f5; padding: 20px 25px;">
                    <h5 class="modal-title font-weight-bold" style="color: #333;"><i class="fa fa-user-circle-o mr-2 text-primary"></i>Ubah Profile & Keamanan</h5>
                    <button type="button" class="close" data-dismiss="modal" style="outline: none;">&times;</button>
                </div>

                <div class="modal-body" style="padding: 25px;">
                    <div class="row">
                        <!-- KOLOM KIRI: DATA PROFIL -->
                        <div class="col-md-6 border-right pr-md-4">
                            <h6 class="text-primary mb-3 font-weight-bold"><i class="fa fa-id-card-o mr-2"></i>Data Profil</h6>
                            
                            <div class="form-group">
                                <label class="font-weight-bold text-muted small">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" style="border-radius: 8px;"
                                    value="<?= htmlspecialchars($user->nama_lengkap ?? '') ?>" required>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold text-muted small">Email</label>
                                <input type="email" name="email" class="form-control" style="border-radius: 8px;"
                                    value="<?= htmlspecialchars($user->email ?? '') ?>" required>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold text-muted small">No Telepon</label>
                                <input type="text" name="no_telepon" class="form-control" style="border-radius: 8px;"
                                    value="<?= htmlspecialchars($user->no_telepon ?? '') ?>" required>
                            </div>

                            <div class="form-group mb-md-0">
                                <label class="font-weight-bold text-muted small">Foto Profile</label>
                                <div class="custom-file" style="border-radius: 8px;">
                                    <input type="file" name="foto" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile" style="border-radius: 8px; color: #888;">Pilih foto baru...</label>
                                </div>
                                <small class="text-muted mt-1 d-block"><i class="fa fa-info-circle mr-1"></i>Kosongkan jika tidak ingin mengganti</small>
                            </div>
                        </div>

                        <!-- KOLOM KANAN: KEAMANAN (PASSWORD) -->
                        <div class="col-md-6 pl-md-4 mt-4 mt-md-0">
                            <h6 class="text-primary mb-3 font-weight-bold"><i class="fa fa-lock mr-2"></i>Ubah Password</h6>
                            
                            <div class="alert alert-light border shadow-sm p-3 mb-4" style="border-radius: 8px; font-size: 13px;">
                                <i class="fa fa-lightbulb-o text-warning mr-1"></i> Kosongkan kedua kolom di bawah ini jika Anda <strong>tidak ingin</strong> mengubah password.
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold text-muted small">Password Baru</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background: transparent; border-right: none; border-radius: 8px 0 0 8px;"><i class="fa fa-key text-muted"></i></span>
                                    </div>
                                    <input type="password" name="password_baru" class="form-control" style="border-left: none; border-radius: 0 8px 8px 0;" placeholder="Masukkan password baru">
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <label class="font-weight-bold text-muted small">Ulangi Password Baru</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background: transparent; border-right: none; border-radius: 8px 0 0 8px;"><i class="fa fa-check-circle-o text-muted"></i></span>
                                    </div>
                                    <input type="password" name="ulangi_password_baru" class="form-control" style="border-left: none; border-radius: 0 8px 8px 0;" placeholder="Ketik ulang password baru">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="background: #f8f9fa; border-top: 1px solid #edf0f5; padding: 15px 25px;">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="border-radius: 8px; padding: 8px 20px;">Batal</button>
                    <button type="submit" name="update_profile" class="btn btn-primary" style="border-radius: 8px; padding: 8px 20px; font-weight: 600;">
                        <i class="fa fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>

            </div>
        </form>
    </div>
    
    <script>
        // Update label custom-file saat file dipilih
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("customFile").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>

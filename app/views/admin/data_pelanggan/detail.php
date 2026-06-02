<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="page-body">
    <div class="container-fluid">

        <div class="row">
            <!-- DETAIL DATA -->
            <div class="col-lg-7 col-md-12 mb-20">
                <div class="card-box pd-20">
                    <h4 class="text-blue h4 mb-20">Informasi Pelanggan</h4>

                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">Nama Lengkap</th>
                            <td><?= htmlspecialchars($user->nama_lengkap ?? '') ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= htmlspecialchars($user->email ?? '') ?></td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td><?= htmlspecialchars($user->no_telepon ?? '') ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>
                                <span class="badge badge-primary">
                                    <?= isset($user->role) ? strtoupper($user->role) : '' ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php if (isset($user->status) && $user->status == 'Aktif') : ?>
                                    <span class="badge badge-success">AKTIF</span>
                                <?php else : ?>
                                    <span class="badge badge-danger">NONAKTIF</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- FOTO -->
            <div class="col-lg-5 col-md-12 mb-20">
                <div class="card-box pd-20 text-center">
                    <h4 class="text-blue h4 mb-20">Foto Pelanggan</h4>
  
                    <?php
                        $foto = $user->foto ?? '';
                        // Assuming public/img/foto_pelanggan is the new location where files actually exist
                        $filePathServer = UPLOAD_PATH . "foto_pelanggan/" . $foto;
                        $fotoPath = (!empty($foto) && file_exists($filePathServer))
                            ? base_url("public/img/foto_pelanggan/".$foto)
                            : base_url("public/img/placeholder-user.png"); // changed assets to public based on user header.php changes previously
                    ?>

                    <img src="<?= $fotoPath ?>"
                         class="img-fluid rounded"
                         style="max-width: 280px;">
                </div>
            </div>
        </div>

    </div>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>

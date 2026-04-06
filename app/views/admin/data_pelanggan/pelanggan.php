<!-- Simple Datatable start -->
<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="card-box mb-30">
    <div class="pd-20">
        <div class="d-flex justify-content-between align-items-start flex-wrap">
            <!-- KIRI -->
            <div>
                <h4 class="mb-1">Data Pelanggan</h4>
                <small class="text-muted">
                    Kelola seluruh data pelanggan jahit
                </small>
            </div>

            <!-- KANAN -->
            <a href="<?= base_url('admin/data_pelanggan/tambah') ?>" 
            class="btn btn-primary">
                <i class="fa fa-plus-circle"></i> Tambah Data
            </a>
        </div>
    </div>
    <div class="pb-20 table-responsive">
        <table class="table stripe hover nowrap" id="tabelsaya">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Status & Role</th>
                    <th>Kode User</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($users)) { ?>
                <tr>
                    <td colspan="7" class="text-center">Data Kosong, silahkan tambahkan data baru</td>
                </tr>
                    <?php } else{ ?>
                        <?php $no = 1;
                        foreach($users as $user) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $user->nama_lengkap ?></td>
                            <td><?= $user->email ?></td>
                            <td><?= $user->no_telepon ?></td>
                            <td>
                                <?php if(strtolower($user->status) == 'aktif'): ?>
                                    <span class="badge badge-success"><?= ucfirst($user->status) ?></span>
                                <?php else: ?>
                                    <span class="badge badge-danger"><?= ucfirst($user->status) ?></span>
                                <?php endif; ?>
                                <?php if(strtolower($user->role) == 'admin'): ?>
                                    <span class="badge badge-primary"><?= ucfirst($user->role) ?></span>
                                <?php else: ?>
                                    <span class="badge badge-warning"><?= ucfirst($user->role) ?></span>
                                <?php endif; ?>
                            </td>

                            <td><?= $user->kode_user ?></td>
                            <td>
                                <div class="dropdown">
                                    <a
                                        class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#"
                                        role="button"
                                        data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div
                                        class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="<?= base_url('admin/data_pelanggan/detail?kode_user=' . urlencode($user->kode_user)) ?>"><i class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item" href="<?= base_url('admin/data_pelanggan/edit?kode_user=' . urlencode($user->kode_user)) ?>">
                                            <i class="dw dw-edit2"></i> Edit
                                        </a>

                                        <?php if ($user->id_user != $_SESSION['id_user']) : ?>
                                            <a class="dropdown-item tombol-hapus" href="<?= base_url('admin/data_pelanggan/hapus?id_user=' . $user->id_user) ?>"><i class="dw dw-delete-3"></i> Delete</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Simple Datatable End -->
<?php include(__DIR__ . '/../layout/footer.php'); ?>

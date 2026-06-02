<!-- Simple Datatable start -->
<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="card-box mb-30">
    <div class="pd-20">
        <div class="d-flex justify-content-between align-items-start flex-wrap">
            <div>
                <h4 class="mb-1">Data Layanan</h4>
                <small class="text-muted">
                    Kelola seluruh data layanan
                </small>
            </div>

            <a href="<?= base_url('admin/data_layanan/tambah') ?>"
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
                    <th>Nama Layanan</th>
                    <th>Kategori</th>
                    <th>Harga Mulai</th>
                    <th>Estimasi (Hari)</th>
                    <th>Status</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($layanans)) : ?>
                    <tr>
                        <td colspan="7" class="text-center">
                            Data kosong, silahkan tambahkan data baru
                        </td>
                    </tr>
                <?php else : ?>
                    <?php $no = 1; 
                    foreach($layanans as $layanan) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($layanan->nama_layanan) ?></td>
                            <td>
                                <span class="badge badge-info">
                                    <?= htmlspecialchars($layanan->nama_kategori) ?>
                                </span>
                            </td>
                            <td>Rp <?= number_format($layanan->harga_mulai, 0, ',', '.') ?></td>
                            <td><?= $layanan->estimasi_hari ?> Hari</td>
                            <td>
                                <?php if ($layanan->status == 'Aktif') : ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else : ?>
                                    <span class="badge badge-secondary">Tidak Aktif</span>
                                <?php endif; ?>
                            </td> 
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item"
                                            href="<?= base_url('admin/data_layanan/edit?id_layanan=' . $layanan->id_layanan) ?>">
                                            <i class="dw dw-edit2"></i> Edit
                                        </a>
                                        <a class="dropdown-item tombol-hapus"
                                            href="<?= base_url('admin/data_layanan/hapus?id_layanan=' . $layanan->id_layanan) ?>">
                                            <i class="dw dw-delete-3"></i> Hapus
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Simple Datatable End -->
<?php include(__DIR__ . '/../layout/footer.php'); ?>
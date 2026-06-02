<!-- Simple Datatable start -->
<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="card-box mb-30">
    <div class="pd-20">
        <div class="d-flex justify-content-between align-items-start flex-wrap">
            <div>
                <h4 class="mb-1">Data Kategori</h4>
                <small class="text-muted">
                    Kelola data seluruh kategori
                </small>
            </div>

            <a href="<?= base_url('admin/data_kategori/tambah') ?>"
                class="btn btn-primary">
                <i class="fa fa-plus-circle"></i> Tambah Data
            </a>
        </div>
    </div>

    <div class="pb-20 table-responsive">
        <table class="table stripe hover nowrap" id="tabelkategori">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($kategoris)) : ?>
                    <tr>
                        <td colspan="7" class="text-center">
                            Data kosong, silahkan tambahkan data baru
                        </td>
                    </tr>
                <?php else : ?>
                    <?php $no = 1; ?>
                    <?php foreach ($kategoris as $kategori) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($kategori->nama_kategori) ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item"
                                            href="<?= base_url('admin/data_kategori/edit?id_kategori=' . $kategori->id_kategori) ?>">
                                            <i class="dw dw-edit2"></i> Edit
                                        </a>
                                        <a class="dropdown-item tombol-hapus"
                                            href="<?= base_url('admin/data_kategori/hapus?id_kategori=' . $kategori->id_kategori) ?>">
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
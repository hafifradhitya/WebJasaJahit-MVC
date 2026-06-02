<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="card-box mb-30">
    <div class="pd-20">
        <div class="d-flex justify-content-between align-items-start flex-wrap">
            <div>
                <h4 class="mb-1">Data Pesanan Selesai / Diambil</h4>
                <small class="text-muted">Kelola semua pesanan yang sudah selesai atau sudah diambil</small>
            </div>
        </div>
    </div>

    <div class="pb-20 table-responsive">
        <table class="table stripe hover nowrap" id="tabelsaya">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Layanan</th>
                    <th>Ukuran Pakaian</th>
                    <th>Periode Pesanan</th>
                    <th>Status</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pesanans)) : ?>
                    <tr>
                        <td colspan="7" class="text-center">
                            Tidak ada pesanan yang selesai / diambil
                        </td>
                    </tr>
                <?php else : ?>
                    <?php $no = 1; ?>
                    <?php foreach ($pesanans as $row) : ?>
                        <?php
                        $badgeClass = $row->status_pesanan === 'diambil' ? 'badge-primary' : 'badge-success';
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row->nama_lengkap) ?></td>
                            <td><?= htmlspecialchars($row->nama_layanan) ?></td>
                            <td><?= htmlspecialchars($row->ukuran_pakaian) ?></td>
                            <td>
                                <div>
                                    <i class="fa fa-calendar text-primary"></i>
                                    <?= date('d M Y', strtotime($row->tanggal_pesan)) ?>
                                </div>
                                <div>
                                    <i class="fa fa-flag-checkered text-success"></i>
                                    <?= date('d M Y', strtotime($row->tanggal_selesai)) ?>
                                </div>
                            </td>
                            <td>
                                <span class="badge <?= $badgeClass ?>">
                                    <?= ucfirst($row->status_pesanan) ?>
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="<?= base_url('admin/data_pesanan/detail?id_pesanan=' . $row->id_pesanan) ?>">
                                            <i class="dw dw-eye"></i> View
                                        </a>
                                        <a class="dropdown-item" href="<?= base_url('admin/data_pesanan/edit?id_pesanan=' . $row->id_pesanan) ?>">
                                            <i class="dw dw-edit2"></i> Edit
                                        </a>
                                        <a class="dropdown-item tombol-hapus" href="<?= base_url('admin/data_pesanan/hapus?id_pesanan=' . $row->id_pesanan) ?>">
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

<?php include(__DIR__ . '/../layout/footer.php'); ?>

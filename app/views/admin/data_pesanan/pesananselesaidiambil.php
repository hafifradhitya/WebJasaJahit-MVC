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
                    <th>Pembayaran</th>
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
                                <form action="<?= base_url('admin/data_pesanan/update_status') ?>" method="POST" style="margin: 0;" id="form-status-<?= $row->id_pesanan ?>">
                                    <input type="hidden" name="id_pesanan" value="<?= $row->id_pesanan ?>">
                                    <input type="hidden" name="status_pesanan" id="status-<?= $row->id_pesanan ?>" value="<?= $row->status_pesanan ?>">
                                    <div class="dropdown">
                                        <button class="btn badge <?= $badgeClass ?> dropdown-toggle border-0" type="button" data-toggle="dropdown" aria-expanded="false" style="color: #fff; padding: 6px 12px; font-size: 12px; font-weight: 500; cursor: pointer; text-transform: capitalize; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                            <?= $row->status_pesanan ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0" style="border-radius: 8px; overflow: hidden; padding: 0; min-width: 120px;">
                                            <a class="dropdown-item py-2 <?= $row->status_pesanan == 'menunggu' ? 'active' : '' ?>" href="#" onclick="document.getElementById('status-<?= $row->id_pesanan ?>').value='menunggu'; document.getElementById('form-status-<?= $row->id_pesanan ?>').submit(); return false;">Menunggu</a>
                                            <a class="dropdown-item py-2 <?= $row->status_pesanan == 'proses' ? 'active' : '' ?>" href="#" onclick="document.getElementById('status-<?= $row->id_pesanan ?>').value='proses'; document.getElementById('form-status-<?= $row->id_pesanan ?>').submit(); return false;">Proses</a>
                                            <a class="dropdown-item py-2 <?= $row->status_pesanan == 'selesai' ? 'active' : '' ?>" href="#" onclick="document.getElementById('status-<?= $row->id_pesanan ?>').value='selesai'; document.getElementById('form-status-<?= $row->id_pesanan ?>').submit(); return false;">Selesai</a>
                                            <a class="dropdown-item py-2 <?= $row->status_pesanan == 'diambil' ? 'active' : '' ?>" href="#" onclick="document.getElementById('status-<?= $row->id_pesanan ?>').value='diambil'; document.getElementById('form-status-<?= $row->id_pesanan ?>').submit(); return false;">Diambil</a>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <?php if (isset($row->status_pembayaran) && $row->status_pembayaran == 'lunas') : ?>
                                    <span class="badge badge-success border-0 shadow-sm" style="padding: 6px 12px; font-weight: 500;"><i class="fa fa-check-circle"></i> Lunas</span>
                                <?php else : ?>
                                    <span class="badge badge-warning text-white border-0 shadow-sm" style="padding: 6px 12px; font-weight: 500;"><i class="fa fa-clock-o"></i> Belum</span>
                                <?php endif; ?>
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

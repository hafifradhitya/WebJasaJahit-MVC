<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="card-box mb-30">
    <div class="pd-20">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h4 class="mb-1">Hasil Pencarian</h4>
                <?php if (!empty($q)): ?>
                    <small class="text-muted">
                        Menampilkan <strong><?= $total ?></strong> hasil untuk kata kunci: 
                        <strong>"<?= htmlspecialchars($q) ?>"</strong>
                        <?php if (!empty($status)): ?> &bull; Status: <span class="badge badge-info"><?= ucfirst($status) ?></span><?php endif; ?>
                        <?php if (!empty($tanggal_dari) && !empty($tanggal_sampai)): ?> &bull; <?= date('d M Y', strtotime($tanggal_dari)) ?> s/d <?= date('d M Y', strtotime($tanggal_sampai)) ?><?php endif; ?>
                    </small>
                <?php else: ?>
                    <small class="text-muted">Masukkan kata kunci pada kolom pencarian di atas</small>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($q) || (!empty($tanggal_dari) && !empty($tanggal_sampai))): ?>

    <?php if ($total === 0): ?>
        <div class="card-box mb-30 pd-20 text-center">
            <i class="dw dw-search2" style="font-size:60px; color:#ccc;"></i>
            <h4 class="mt-3 text-muted">Tidak ada hasil ditemukan</h4>
            <p class="text-muted">Coba gunakan kata kunci yang berbeda</p>
        </div>
    <?php endif; ?>

    <!-- ======== HASIL PESANAN ======== -->
    <?php if (!empty($results['pesanan'])): ?>
    <div class="card-box mb-30">
        <div class="pd-20">
            <h5 class="mb-0">
                <i class="fa fa-archive text-primary"></i> Pesanan
                <span class="badge badge-primary ml-2"><?= count($results['pesanan']) ?></span>
            </h5>
        </div>
        <div class="pb-20 table-responsive">
            <table class="table table-hover nowrap">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Layanan</th>
                        <th>Ukuran</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($results['pesanan'] as $row): ?>
                        <?php
                        $badgeMap = [
                            'menunggu' => 'badge-warning',
                            'proses'   => 'badge-info',
                            'selesai'  => 'badge-success',
                            'diambil'  => 'badge-primary',
                        ];
                        $badge = $badgeMap[$row->status_pesanan] ?? 'badge-secondary';
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row->nama_lengkap) ?></td>
                            <td><?= htmlspecialchars($row->nama_layanan) ?></td>
                            <td><?= htmlspecialchars($row->ukuran_pakaian) ?></td>
                            <td>
                                <small>
                                    <i class="fa fa-calendar text-primary"></i> <?= date('d M Y', strtotime($row->tanggal_pesan)) ?><br>
                                    <i class="fa fa-flag-checkered text-success"></i> <?= date('d M Y', strtotime($row->tanggal_selesai)) ?>
                                </small>
                            </td>
                            <td><span class="badge <?= $badge ?>"><?= ucfirst($row->status_pesanan) ?></span></td>
                            <td>
                                <a href="<?= base_url('admin/data_pesanan/detail?id_pesanan=' . $row->id_pesanan) ?>" class="btn btn-sm btn-outline-info">
                                    <i class="dw dw-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <!-- ======== HASIL PELANGGAN ======== -->
    <?php if (!empty($results['pelanggan'])): ?>
    <div class="card-box mb-30">
        <div class="pd-20">
            <h5 class="mb-0">
                <i class="fa fa-users text-success"></i> Pelanggan
                <span class="badge badge-success ml-2"><?= count($results['pelanggan']) ?></span>
            </h5>
        </div>
        <div class="pb-20 table-responsive">
            <table class="table table-hover nowrap">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>No. Telepon</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($results['pelanggan'] as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <img src="<?= base_url('public/img/foto_pelanggan/' . (!empty($row->foto) ? $row->foto : 'default.jpg')) ?>"
                                    class="rounded-circle" width="36" height="36" style="object-fit:cover;" alt="">
                            </td>
                            <td><?= htmlspecialchars($row->nama_lengkap) ?></td>
                            <td><?= htmlspecialchars($row->email) ?></td>
                            <td><?= htmlspecialchars($row->no_telepon) ?></td>
                            <td>
                                <span class="badge <?= $row->status === 'Aktif' ? 'badge-success' : 'badge-danger' ?>">
                                    <?= htmlspecialchars($row->status) ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/data_pelanggan/detail?id_user=' . $row->id_user) ?>" class="btn btn-sm btn-outline-info">
                                    <i class="dw dw-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <!-- ======== HASIL LAYANAN ======== -->
    <?php if (!empty($results['layanan'])): ?>
    <div class="card-box mb-30">
        <div class="pd-20">
            <h5 class="mb-0">
                <i class="fa fa-scissors text-warning"></i> Layanan
                <span class="badge badge-warning ml-2"><?= count($results['layanan']) ?></span>
            </h5>
        </div>
        <div class="pb-20 table-responsive">
            <table class="table table-hover nowrap">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Layanan</th>
                        <th>Kategori</th>
                        <th>Harga Mulai</th>
                        <th>Estimasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($results['layanan'] as $row): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row->nama_layanan) ?></td>
                            <td><?= htmlspecialchars($row->nama_kategori ?? '-') ?></td>
                            <td>Rp <?= number_format($row->harga_mulai, 0, ',', '.') ?></td>
                            <td><?= $row->estimasi_hari ?> Hari</td>
                            <td>
                                <span class="badge <?= $row->status === 'Aktif' ? 'badge-success' : 'badge-secondary' ?>">
                                    <?= htmlspecialchars($row->status) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

<?php endif; ?>

<?php include(__DIR__ . '/../layout/footer.php'); ?>

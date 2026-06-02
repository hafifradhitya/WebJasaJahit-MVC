<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Detail Pesanan</h4>
            <p class="mb-30">Informasi lengkap pesanan</p>
        </div>
        <div class="pull-right">
            <a href="<?= base_url('admin/data_pesanan/semuapesanan') ?>" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="200">ID Pesanan</th>
                <td><?= htmlspecialchars($pesanan->id_pesanan) ?></td>
            </tr>
            <tr>
                <th>Nama Pelanggan</th>
                <td><?= htmlspecialchars($pesanan->nama_lengkap) ?></td>
            </tr>
            <tr>
                <th>No Telepon</th>
                <td><?= htmlspecialchars($pesanan->no_telepon) ?></td>
            </tr>
            <tr>
                <th>Layanan</th>
                <td><?= htmlspecialchars($pesanan->nama_layanan) ?></td>
            </tr>
            <tr>
                <th>Harga</th>
                <td>Rp <?= number_format($pesanan->harga_mulai, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <th>Estimasi Pengerjaan</th>
                <td><?= htmlspecialchars($pesanan->estimasi_hari) ?> Hari</td>
            </tr>
            <tr>
                <th>Ukuran Pakaian</th>
                <td><?= htmlspecialchars($pesanan->ukuran_pakaian) ?></td>
            </tr>
            <tr>
                <th>Catatan</th>
                <td><?= htmlspecialchars($pesanan->catatan) ?: '<em class="text-muted">Tidak ada catatan</em>' ?></td>
            </tr>
            <tr>
                <th>Tanggal Pesan</th>
                <td>
                    <i class="fa fa-calendar text-primary"></i>
                    <?= date('d M Y', strtotime($pesanan->tanggal_pesan)) ?>
                </td>
            </tr>
            <tr>
                <th>Tanggal Selesai</th>
                <td>
                    <i class="fa fa-flag-checkered text-success"></i>
                    <?= date('d M Y', strtotime($pesanan->tanggal_selesai)) ?>
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <?php
                    $status = $pesanan->status_pesanan;
                    switch ($status) {
                        case 'menunggu':
                            $badge = 'badge-warning';
                            $text  = 'Menunggu';
                            break;
                        case 'proses':
                            $badge = 'badge-info';
                            $text  = 'Proses';
                            break;
                        case 'selesai':
                            $badge = 'badge-success';
                            $text  = 'Selesai';
                            break;
                        case 'diambil':
                            $badge = 'badge-primary';
                            $text  = 'Diambil';
                            break;
                        default:
                            $badge = 'badge-secondary';
                            $text  = 'Unknown';
                    }
                    ?>
                    <span class="badge <?= $badge ?>"><?= $text ?></span>
                </td>
            </tr>
        </table>
    </div>

    <div class="text-right mt-3">
        <a href="<?= base_url('admin/data_pesanan/edit?id_pesanan=' . $pesanan->id_pesanan) ?>" class="btn btn-warning btn-sm">
            <i class="dw dw-edit2"></i> Edit
        </a>
        <a href="<?= base_url('admin/data_pesanan/hapus?id_pesanan=' . $pesanan->id_pesanan) ?>" class="btn btn-danger btn-sm tombol-hapus">
            <i class="dw dw-delete-3"></i> Hapus
        </a>
    </div>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>

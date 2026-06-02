<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="card-box mb-30">
    <div class="pd-20">

        <h4 class="mb-15">Data Laporan</h4>

        <div class="row align-items-center">

            <div class="col-md-2 mb-10">
                <button type="button"
                    class="btn btn-success"
                    data-toggle="modal"
                    data-target="#laporanModal">
                    Export Excel
                </button>
            </div>

            <!-- MODAL EXPORT -->
            <div class="modal fade" id="laporanModal" tabindex="-1" role="dialog" aria-labelledby="laporanModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="laporanModalLabel"> Export Laporan </h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <form method="POST" action="<?= base_url('admin/data_laporan/rekap_data_excel.php') ?>">
                            <div class="modal-body">
                                <div class="form-group"> <label>Tanggal Pesan</label> <input type="text" name="tanggal_pesan" class="form-control date-picker" required> </div>
                                <div class="form-group"> <label>Tanggal Selesai</label> <input type="text" name="tanggal_selesai" class="form-control date-picker" required> </div>
                                <div class="form-group"> <label>Status Pesanan</label> <select name="status_pesanan" class="form-control">
                                        <option value="">Pilih Status</option>
                                        <option value="proses">Proses</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="diambil">Diambil</option>
                                    </select> </div>
                            </div>
                            <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal </button> <button type="submit" class="btn btn-success"> Export </button> </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- FILTER TANGGAL -->
            <div class="col-md-10">
                <form method="GET" onsubmit="return filterTanggal();" action="<?= base_url('admin/data_laporan/laporan') ?>">
                    <div class="d-flex align-items-center">
                        <input type="date"
                            class="form-control mr-2"
                            name="tanggal_pesan"
                            id="tanggal_pesan"
                            value="<?= $tanggal_pesan ?>">

                        <input type="date"
                            class="form-control mr-2"
                            name="tanggal_selesai"
                            id="tanggal_selesai"
                            value="<?= $tanggal_selesai ?>">

                        <button type="submit"
                            class="btn btn-primary text-nowrap">
                            Tampilkan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- TABLE -->
    <div class="pb-20 table-responsive">
        <table class="table table-striped table-hover nowrap" id="tabelsaya">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Layanan</th>
                    <th>Ukuran</th>
                    <th>Periode</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($laporan)) : ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Data tidak ditemukan
                        </td>
                    </tr>
                <?php else : ?>
                    <?php $no = 1; ?>
                    <?php foreach ($laporan as $row) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row->nama_lengkap ?? '') ?></td>
                            <td><?= htmlspecialchars($row->nama_layanan ?? '') ?></td>
                            <td><?= htmlspecialchars($row->ukuran_pakaian ?? '') ?></td>
                            <td>
                                <div>
                                    <?= date('d M Y', strtotime($row->tanggal_pesan)) ?>
                                </div>
                                <div>
                                    <?= date('d M Y', strtotime($row->tanggal_selesai)) ?>
                                </div>
                            </td>
                            <td>
                                <?php
                                $status = $row->status_pesanan;
                                $map = [
                                    'menunggu' => ['badge-warning', 'Menunggu'],
                                    'proses'   => ['badge-info', 'Proses'],
                                    'selesai'  => ['badge-success', 'Selesai'],
                                    'diambil'  => ['badge-primary', 'Diambil']
                                ];
                                [$badge, $text] = $map[$status] ?? ['badge-secondary', 'Unknown'];
                                ?>
                                <span class="badge <?= $badge ?>">
                                    <?= $text ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function filterTanggal() {
        const t1 = document.getElementById('tanggal_pesan').value;
        const t2 = document.getElementById('tanggal_selesai').value;

        if (t1 === '' && t2 === '') {
            window.location.href = '<?= base_url('admin/data_laporan/laporan') ?>';
            return false;
        }
        return true;
    }
</script>

<?php include(__DIR__ . '/../layout/footer.php'); ?>

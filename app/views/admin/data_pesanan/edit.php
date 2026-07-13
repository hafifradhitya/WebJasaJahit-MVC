<?php include(__DIR__ . '/../layout/header.php'); ?>

<!-- Wizard Card -->
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <h4 class="text-blue h4">Form Edit Pesanan</h4>
        <p class="mb-30">Perbarui data pesanan secara bertahap</p>
    </div>

    <div class="wizard-content">
        <form action="<?= base_url('admin/data_pesanan/edit') ?>" method="POST" class="tab-wizard wizard-circle wizard vertical" enctype="multipart/form-data">

            <input type="hidden" name="id_pesanan" value="<?= htmlspecialchars($pesanan->id_pesanan) ?>">

            <!-- STEP 1: Data User -->
            <h5>Data User</h5>
            <section>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Pelanggan</label>
                            <select
                                class="custom-select2 form-control"
                                name="id_user"
                                id="id_user"
                                required
                                style="width: 100%; height: 38px">
                                <option value="">-- Pilih Pelanggan --</option>
                                <?php foreach ($users as $user) : ?>
                                    <option
                                        value="<?= $user->id_user ?>"
                                        data-telp="<?= htmlspecialchars($user->no_telepon) ?>"
                                        <?= ($pesanan->id_user == $user->id_user) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($user->nama_lengkap) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="text"
                                class="form-control"
                                id="no_telepon"
                                value="<?= htmlspecialchars($pesanan->no_telepon) ?>"
                                placeholder="No telepon otomatis"
                                readonly>
                        </div>
                    </div>
                </div>
            </section>

            <!-- STEP 2: Data Layanan -->
            <h5>Data Layanan</h5>
            <section>
                <div class="row">

                    <!-- NAMA LAYANAN -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Layanan</label>
                            <select
                                class="custom-select2 form-control"
                                name="id_layanan"
                                id="id_layanan"
                                required
                                style="width: 100%; height: 38px">
                                <option value="">-- Pilih Layanan --</option>
                                <?php foreach ($layanans as $l) : ?>
                                    <option
                                        value="<?= $l->id_layanan ?>"
                                        data-harga="<?= $l->harga_mulai ?>"
                                        data-estimasi="<?= $l->estimasi_hari ?>"
                                        <?= ($pesanan->id_layanan == $l->id_layanan) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($l->nama_layanan) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- JENIS UKURAN -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ukuran Pakaian</label>
                            <select
                                name="ukuran_pakaian"
                                class="custom-select2 form-control"
                                id="ukuran_pakaian"
                                required
                                style="width: 100%; height: 38px">
                                <option value="">-- Pilih --</option>
                                <?php
                                $ukuranList = [
                                    'S - Anak-Anak', 'M - Anak-Anak', 'L - Anak-Anak',
                                    'XL - Anak-Anak', 'XXL - Anak-Anak', 'XXXL - Anak-Anak',
                                    'S - Dewasa', 'M - Dewasa', 'L - Dewasa',
                                    'XL - Dewasa', 'XXL - Dewasa', 'XXXL - Dewasa',
                                    'Custom'
                                ];
                                foreach ($ukuranList as $u) : ?>
                                    <option value="<?= $u ?>" <?= ($pesanan->ukuran_pakaian == $u) ? 'selected' : '' ?>>
                                        <?= $u ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- HARGA MULAI -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga Mulai</label>
                            <input
                                type="text"
                                id="harga_mulai"
                                class="form-control"
                                readonly
                                value="<?= htmlspecialchars($pesanan->harga_mulai) ?>"
                                placeholder="Otomatis dari layanan">
                        </div>
                    </div>

                    <!-- ESTIMASI HARI -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Estimasi Hari</label>
                            <input
                                type="text"
                                id="estimasi_hari"
                                class="form-control"
                                readonly
                                value="<?= htmlspecialchars($pesanan->estimasi_hari) ?>"
                                placeholder="Otomatis dari layanan">
                        </div>
                    </div>

                </div>

                <!-- CUSTOM UKURAN -->
                <div id="wrap-ukuran-custom" style="display:none;">
                    <hr>
                    <h5 class="step-ukuran">Data Ukuran Atasan</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Model Fit</label>
                                <select
                                    name="model_fit"
                                    class="custom-select2 form-control"
                                    id="model_fit"
                                    style="width: 100%; height: 38px">
                                    <option value="">-- Pilih --</option>
                                    <option value="fit_badan" <?= (isset($ukuran_atasan) && $ukuran_atasan->model_fit == 'fit_badan') ? 'selected' : '' ?>>Fit Badan</option>
                                    <option value="regular" <?= (isset($ukuran_atasan) && $ukuran_atasan->model_fit == 'regular') ? 'selected' : '' ?>>Regular</option>
                                    <option value="longgar" <?= (isset($ukuran_atasan) && $ukuran_atasan->model_fit == 'longgar') ? 'selected' : '' ?>>Longgar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kegunaan</label>
                                <select
                                    name="kegunaan"
                                    class="custom-select2 form-control"
                                    id="kegunaan"
                                    style="width: 100%; height: 38px">
                                    <option value="">-- Pilih --</option>
                                    <option value="formal" <?= (isset($ukuran_atasan) && $ukuran_atasan->kegunaan == 'formal') ? 'selected' : '' ?>>Formal</option>
                                    <option value="santai" <?= (isset($ukuran_atasan) && $ukuran_atasan->kegunaan == 'santai') ? 'selected' : '' ?>>Santai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lingkar Dada</label>
                                <input type="number" name="lingkar_dada" class="form-control"
                                    value="<?= isset($ukuran_atasan) ? $ukuran_atasan->lingkar_dada : '' ?>"
                                    placeholder="Contoh: 90" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lingkar Pinggang</label>
                                <input type="number" name="lingkar_pinggang_atasan" class="form-control"
                                    value="<?= isset($ukuran_atasan) ? $ukuran_atasan->lingkar_pinggang : '' ?>"
                                    placeholder="Contoh: 75" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lingkar Pinggul</label>
                                <input type="number" name="lingkar_pinggul_atasan" class="form-control"
                                    value="<?= isset($ukuran_atasan) ? $ukuran_atasan->lingkar_pinggul : '' ?>"
                                    placeholder="Contoh: 95" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lebar Bahu</label>
                                <input type="number" name="lebar_bahu" class="form-control"
                                    value="<?= isset($ukuran_atasan) ? $ukuran_atasan->lebar_bahu : '' ?>"
                                    placeholder="Contoh: 40" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Panjang Lengan</label>
                                <input type="number" name="panjang_lengan" class="form-control"
                                    value="<?= isset($ukuran_atasan) ? $ukuran_atasan->panjang_lengan : '' ?>"
                                    placeholder="Contoh: 58" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lingkar Lengan</label>
                                <input type="number" name="lingkar_lengan" class="form-control"
                                    value="<?= isset($ukuran_atasan) ? $ukuran_atasan->lingkar_lengan : '' ?>"
                                    placeholder="Contoh: 30" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Panjang Baju</label>
                                <input type="number" name="panjang_baju" class="form-control"
                                    value="<?= isset($ukuran_atasan) ? $ukuran_atasan->panjang_baju : '' ?>"
                                    placeholder="Contoh: 70" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lingkar Leher</label>
                                <input type="number" name="lingkar_leher" class="form-control"
                                    value="<?= isset($ukuran_atasan) ? $ukuran_atasan->lingkar_leher : '' ?>"
                                    placeholder="Contoh: 38" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h5>Data Ukuran Bawahan</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lingkar Pinggang</label>
                                <input type="number" name="lingkar_pinggang_bawahan" class="form-control"
                                    value="<?= isset($ukuran_bawahan) ? $ukuran_bawahan->lingkar_pinggang : '' ?>"
                                    placeholder="Contoh: 75" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lingkar Pinggul</label>
                                <input type="number" name="lingkar_pinggul_bawahan" class="form-control"
                                    value="<?= isset($ukuran_bawahan) ? $ukuran_bawahan->lingkar_pinggul : '' ?>"
                                    placeholder="Contoh: 95" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Panjang Celana</label>
                                <input type="number" name="panjang_celana" class="form-control"
                                    value="<?= isset($ukuran_bawahan) ? $ukuran_bawahan->panjang_celana : '' ?>"
                                    placeholder="Contoh: 100" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tinggi Duduk</label>
                                <input type="number" name="tinggi_duduk" class="form-control"
                                    value="<?= isset($ukuran_bawahan) ? $ukuran_bawahan->tinggi_duduk : '' ?>"
                                    placeholder="Contoh: 55" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Lingkar Paha</label>
                                <input type="number" name="lingkar_paha" class="form-control"
                                    value="<?= isset($ukuran_bawahan) ? $ukuran_bawahan->lingkar_paha : '' ?>"
                                    placeholder="Contoh: 55" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Lingkar Lutut</label>
                                <input type="number" name="lingkar_lutut" class="form-control"
                                    value="<?= isset($ukuran_bawahan) ? $ukuran_bawahan->lingkar_lutut : '' ?>"
                                    placeholder="Contoh: 40" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Lingkar Kaki</label>
                                <input type="number" name="lingkar_kaki" class="form-control"
                                    value="<?= isset($ukuran_bawahan) ? $ukuran_bawahan->lingkar_kaki : '' ?>"
                                    placeholder="Contoh: 25" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- STEP 3: Tanggal Pesanan -->
            <h5>Tanggal Pesanan</h5>
            <section>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Pesan</label>
                            <input type="text"
                                name="tanggal_pesan"
                                class="form-control date-picker"
                                value="<?= !empty($pesanan->tanggal_pesan) ? date('m/d/Y', strtotime($pesanan->tanggal_pesan)) : '' ?>"
                                placeholder="Masukkan tanggal pesan"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Selesai</label>
                            <input type="text"
                                name="tanggal_selesai"
                                class="form-control date-picker"
                                value="<?= !empty($pesanan->tanggal_selesai) ? date('m/d/Y', strtotime($pesanan->tanggal_selesai)) : '' ?>"
                                placeholder="Masukkan tanggal selesai"
                                required>
                        </div>
                    </div>
                </div>
            </section>

            <!-- STEP 4: Rincian Tambahan & Status -->
            <h5>Rincian Tambahan & Status</h5>
            <section>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Opsi Bahan</label>
                            <select name="opsi_bahan" id="opsi_bahan" class="custom-select2 form-control" style="width: 100%; height: 38px">
                                <option value="Bawa Bahan Sendiri" data-price="0" <?= ($pesanan->opsi_bahan == 'Bawa Bahan Sendiri') ? 'selected' : '' ?>>Bawa Bahan Sendiri</option>
                                <option value="Bahan Standar (Disediakan)" data-price="50000" <?= ($pesanan->opsi_bahan == 'Bahan Standar (Disediakan)') ? 'selected' : '' ?>>Bahan Standar (Disediakan)</option>
                                <option value="Bahan Premium (Disediakan)" data-price="150000" <?= ($pesanan->opsi_bahan == 'Bahan Premium (Disediakan)') ? 'selected' : '' ?>>Bahan Premium (Disediakan)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Opsi Kerumitan</label>
                            <select name="opsi_kerumitan" id="opsi_kerumitan" class="custom-select2 form-control" style="width: 100%; height: 38px">
                                <option value="Standar (Tanpa Payet)" data-price="0" <?= ($pesanan->opsi_kerumitan == 'Standar (Tanpa Payet)') ? 'selected' : '' ?>>Standar (Tanpa Payet)</option>
                                <option value="Bordir / Payet Ringan" data-price="50000" <?= ($pesanan->opsi_kerumitan == 'Bordir / Payet Ringan') ? 'selected' : '' ?>>Bordir / Payet Ringan</option>
                                <option value="Payet Sedang" data-price="100000" <?= ($pesanan->opsi_kerumitan == 'Payet Sedang') ? 'selected' : '' ?>>Payet Sedang</option>
                                <option value="Payet Full / Custom" data-price="200000" <?= ($pesanan->opsi_kerumitan == 'Payet Full / Custom') ? 'selected' : '' ?>>Payet Full / Custom</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Estimasi Harga</label>
                            <input type="number" name="estimasi_harga" id="estimasi_harga" class="form-control" value="<?= htmlspecialchars($pesanan->estimasi_harga ?? '') ?>" placeholder="Contoh: 25000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Harga Final (Rp)</label>
                            <input type="number" name="harga_final" id="harga_final" class="form-control" value="<?= htmlspecialchars($pesanan->harga_final ?? '') ?>" placeholder="Input harga setelah fix/deal">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status Pembayaran</label>
                            <select name="status_pembayaran" id="status_pembayaran" class="custom-select2 form-control" required style="width: 100%; height: 38px">
                                <option value="belum_bayar" <?= (isset($pesanan->status_pembayaran) && $pesanan->status_pembayaran == 'belum_bayar') ? 'selected' : '' ?>>Belum Bayar</option>
                                <option value="lunas" <?= (isset($pesanan->status_pembayaran) && $pesanan->status_pembayaran == 'lunas') ? 'selected' : '' ?>>Lunas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Catatan Pesanan</label>
                            <textarea name="catatan"
                                class="form-control"
                                rows="4"
                                placeholder="Masukkan catatan pesanan (opsional)"><?= htmlspecialchars($pesanan->catatan) ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Status Pesanan</label>
                            <select name="status_pesanan" class="custom-select2 form-control" id="status_pesanan" required style="width: 100%; height: 38px">
                                <option value="">-- Pilih Status --</option>
                                <option value="menunggu" <?= ($pesanan->status_pesanan == 'menunggu') ? 'selected' : '' ?>>Menunggu</option>
                                <option value="proses" <?= ($pesanan->status_pesanan == 'proses') ? 'selected' : '' ?>>Proses</option>
                                <option value="selesai" <?= ($pesanan->status_pesanan == 'selesai') ? 'selected' : '' ?>>Selesai</option>
                                <option value="diambil" <?= ($pesanan->status_pesanan == 'diambil') ? 'selected' : '' ?>>Diambil</option>
                            </select>
                        </div>
                    </div>
                </div>
            </section>

            <button type="submit" name="edit" id="btnSubmit" style="display:none;"></button>
        </form>
    </div>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>

<script>
$(document).ready(function () {

    // Toggle custom ukuran fields
    function toggleCustom() {
        let ukuran = $('#ukuran_pakaian').val();

        if (ukuran === 'Custom') {
            $('#wrap-ukuran-custom').slideDown();
        } else {
            $('#wrap-ukuran-custom').slideUp();
            $('#wrap-ukuran-custom')
                .find('input, select')
                .val('');
        }
    }

    // Select2 change event
    $('#ukuran_pakaian').on('change.select2 change', function () {
        toggleCustom();
    });

    // First load - check if already Custom
    toggleCustom();

    // Auto-fill no telepon saat pilih pelanggan
    $('#id_user').on('change.select2 change', function() {
        let telp = $(this).find(':selected').data('telp');
        $('#no_telepon').val(telp ?? '');
    });

    // Auto-fill harga & estimasi saat pilih layanan
    $('#id_layanan').on('change.select2 change', function() {
        let harga = $(this).find(':selected').data('harga');
        let estimasi = $(this).find(':selected').data('estimasi');

        $('#harga_mulai').val(harga ?? '');
        $('#estimasi_hari').val(estimasi ?? '');
        kalkulasiEstimasiHarga();
    });

    // Kalkulasi otomatis Estimasi Harga di Step 4
    function kalkulasiEstimasiHarga() {
        let hargaBase = parseInt($('#id_layanan').find(':selected').data('harga')) || 0;
        let hargaBahan = parseInt($('#opsi_bahan').find(':selected').data('price')) || 0;
        let hargaKerumitan = parseInt($('#opsi_kerumitan').find(':selected').data('price')) || 0;

        let total = hargaBase + hargaBahan + hargaKerumitan;
        $('#estimasi_harga').val(total);
    }

    $('#opsi_bahan, #opsi_kerumitan').on('change.select2 change', function() {
        kalkulasiEstimasiHarga();
    });

    // Submit via Finish button
    $('.actions a[href="#finish"]').on('click', function() {
        $('#btnSubmit').click();
    });
});
</script>


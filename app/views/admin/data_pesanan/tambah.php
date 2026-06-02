<?php include(__DIR__ . '/../layout/header.php'); ?>

<!-- Wizard Card -->
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <h4 class="text-blue h4">Form Tambah Pesanan</h4>
        <p class="mb-30">Isi data pesanan secara bertahap</p>
    </div>

    <div class="wizard-content">
        <form action="<?= base_url('admin/data_pesanan/tambah') ?>" method="POST" class="tab-wizard wizard-circle wizard vertical" enctype="multipart/form-data">

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
                                        data-telp="<?= htmlspecialchars($user->no_telepon) ?>">
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
                                        data-estimasi="<?= $l->estimasi_hari ?>">
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
                                <option value="S - Anak-Anak">S - Anak-Anak</option>
                                <option value="M - Anak-Anak">M - Anak-Anak</option>
                                <option value="L - Anak-Anak">L - Anak-Anak</option>
                                <option value="XL - Anak-Anak">XL - Anak-Anak</option>
                                <option value="XXL - Anak-Anak">XXL - Anak-Anak</option>
                                <option value="XXXL - Anak-Anak">XXXL - Anak-Anak</option>
                                <option value="S - Dewasa">S - Dewasa</option>
                                <option value="M - Dewasa">M - Dewasa</option>
                                <option value="L - Dewasa">L - Dewasa</option>
                                <option value="XL - Dewasa">XL - Dewasa</option>
                                <option value="XXL - Dewasa">XXL - Dewasa</option>
                                <option value="XXXL - Dewasa">XXXL - Dewasa</option>
                                <option value="Custom">Custom</option>
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
                                    <option value="fit_badan">Fit Badan</option>
                                    <option value="regular">Regular</option>
                                    <option value="longgar">Longgar</option>
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
                                    <option value="formal">Formal</option>
                                    <option value="santai">Santai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lingkar Dada</label>
                                <input type="number" name="lingkar_dada" class="form-control"
                                    placeholder="Contoh: 90" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lingkar Pinggang</label>
                                <input type="number" name="lingkar_pinggang_atasan" class="form-control"
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
                                    placeholder="Contoh: 95" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lebar Bahu</label>
                                <input type="number" name="lebar_bahu" class="form-control"
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
                                    placeholder="Contoh: 58" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lingkar Lengan</label>
                                <input type="number" name="lingkar_lengan" class="form-control"
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
                                    placeholder="Contoh: 70" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lingkar Leher</label>
                                <input type="number" name="lingkar_leher" class="form-control"
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
                                    placeholder="Contoh: 75" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lingkar Pinggul</label>
                                <input type="number" name="lingkar_pinggul_bawahan" class="form-control"
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
                                    placeholder="Contoh: 100" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tinggi Duduk</label>
                                <input type="number" name="tinggi_duduk" class="form-control"
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
                                    placeholder="Contoh: 55" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Lingkar Lutut</label>
                                <input type="number" name="lingkar_lutut" class="form-control"
                                    placeholder="Contoh: 40" min="0" step="0.1">
                                <small class="form-text text-muted">Satuan dalam centimeter (cm)</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Lingkar Kaki</label>
                                <input type="number" name="lingkar_kaki" class="form-control"
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
                                placeholder="Masukkan tanggal selesai"
                                required>
                        </div>
                    </div>
                </div>
            </section>

            <!-- STEP 4: Catatan -->
            <h5>Catatan</h5>
            <section>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Catatan Pesanan</label>
                            <textarea name="catatan"
                                class="form-control"
                                rows="4"
                                placeholder="Masukkan catatan pesanan (opsional)"></textarea>
                        </div>
                    </div>
                </div>
            </section>

            <button type="submit" name="submit" id="btnSubmit" style="display:none;"></button>
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
            $('#wrap-ukuran-custom')
                .find('input, select')
                .prop('required', true);
        } else {
            $('#wrap-ukuran-custom').slideUp();
            $('#wrap-ukuran-custom')
                .find('input, select')
                .prop('required', false)
                .val('');
        }
    }

    // Select2 change event
    $('#ukuran_pakaian').on('change.select2 change', function () {
        toggleCustom();
    });

    // First load
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
    });

    // Submit via Finish button
    $('.actions a[href="#finish"]').on('click', function() {
        $('#btnSubmit').click();
    });
});
</script>

<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Edit Data Layanan</h4>
            <p class="mb-30">Perbarui data layanan</p>
        </div>
    </div>

    <form action="<?= base_url('admin/data_layanan/edit') ?>" method="POST" enctype="multipart/form-data">

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Nama Layanan</label>
            <div class="col-sm-12 col-md-10">
                <input type="text" name="nama_layanan" class="form-control" value="<?= htmlspecialchars($layanan->nama_layanan) ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Foto</label>

            <div class="col-sm-12 col-md-10">
                <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($layanan->foto) ?>">

                <div class="d-flex align-items-center flex-wrap">
                    <!-- Preview Foto -->
                    <div class="mr-3 mb-2">
                        <img
                            id="preview-foto-edit"
                            src="<?= base_url('public/img/layanan/' . $layanan->foto) ?>"
                            class="rounded border"
                            style="width: 100px; height: 100px; object-fit: cover;"
                            alt="Preview Foto">
                    </div>

                    <!-- Input File -->
                    <div>
                        <input
                            type="file"
                            class="form-control-file"
                            name="foto_baru"
                            id="input-foto-baru">
                        <small class="form-text text-muted">
                            Format JPG/PNG/JPEG, maksimal 10MB. Kosongkan jika tidak ingin mengubah foto.
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- KATEGORI -->
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Kategori</label>
            <div class="col-sm-12 col-md-10">
                <select name="id_kategori" class="custom-select col-12" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach($kategoris as $k) : ?>
                        <option value="<?= $k->id_kategori; ?>" <?= ($layanan->id_kategori == $k->id_kategori) ? 'selected' : '' ?>>
                            <?= $k->nama_kategori ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Deskripsi</label>
            <div class="col-sm-12 col-md-10">
                <textarea name="deskripsi" class="form-control"><?= htmlspecialchars($layanan->deskripsi) ?></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Harga</label>
            <div class="col-sm-12 col-md-10">
                <input type="number" name="harga_mulai" class="form-control"
                    value="<?= htmlspecialchars($layanan->harga_mulai) ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Estimasi Hari</label>
            <div class="col-sm-12 col-md-10">
                <input type="number" name="estimasi_hari" class="form-control"
                    value="<?= htmlspecialchars($layanan->estimasi_hari) ?>">
                <small class="text-muted">Dalam satuan hari</small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Status</label>
            <div class="col-sm-12 col-md-10">
                <select name="status" class="custom-select col-12" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Aktif" <?= ($layanan->status == 'Aktif') ? 'selected' : '' ?>>Aktif</option>
                    <option value="Tidak Aktif" <?= ($layanan->status == 'Tidak Aktif') ? 'selected' : '' ?>>Tidak Aktif</option>
                </select>
            </div>
        </div>

        <input type="hidden" name="id_layanan" value="<?= htmlspecialchars($layanan->id_layanan) ?>">

        <div class="form-group row">
            <div class="col-md-12 text-right">
                <button type="submit" name="edit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </div>

    </form>
</div>

<!-- Simple Datatable End -->

<script>
    document.getElementById('input-foto-baru').addEventListener('change', function(e) {
        var file = e.target.files[0];
        var previewImg = document.getElementById('preview-foto-edit');
        if (file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                previewImg.src = event.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>

<?php include(__DIR__ . '/../layout/footer.php'); ?>
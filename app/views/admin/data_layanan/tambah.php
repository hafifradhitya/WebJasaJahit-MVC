<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Tambah Data</h4>
            <p class="mb-30">Isi Form untuk menambahkan layanan</p>
        </div>
    </div>

    <form action="<?= base_url('admin/data_layanan/tambah') ?>" method="POST" enctype="multipart/form-data">

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Nama Layanan</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="nama_layanan" placeholder="Masukkan Nama Layanan">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Foto</label>
            <div class="col-sm-12 col-md-10">
                <div class="d-flex align-items-center flex-wrap">
                    <!-- Preview Foto -->
                    <div class="mr-3 mb-2" id="preview-container" style="display: none;">
                        <img
                            id="preview-foto"
                            src=""
                            class="rounded border"
                            style="width: 100px; height: 100px; object-fit: cover;"
                            alt="Preview Foto">
                    </div>

                    <!-- Input File -->
                    <div>
                        <input
                            name="foto"
                            id="input-foto"
                            class="form-control-file form-control"
                            type="file"
                            accept="image/jpeg,image/png,image/jpg" />
                        <small class="form-text text-muted">
                            Format JPG/PNG/JPEG, maksimal 10MB
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- KATEGORI (RELASI) -->
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Kategori</label>
            <div class="col-sm-12 col-md-10">
                <select name="id_kategori" class="custom-select col-12" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach($kategoris as $k) : ?>
                        <option value="<?= $k->id_kategori; ?>">
                            <?= $k->nama_kategori ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>  
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Deskripsi</label>
            <div class="col-sm-12 col-md-10">
                <textarea name="deskripsi" class="form-control"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Harga</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="number" name="harga_mulai" placeholder="Masukkan Harga">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Estimasi Hari</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="number" name="estimasi_hari" min="1" placeholder="Contoh: 3">
                <small class="text-muted">Dalam satuan hari</small>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Status</label>
            <div class="col-sm-12 col-md-10">
                <select name="status" class="custom-select col-12" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12 text-right">
                <button type="submit" name="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </div>

    </form>
</div>
<!-- Simple Datatable End -->

<script>
    document.getElementById('input-foto').addEventListener('change', function(e) {
        var file = e.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('preview-foto').src = event.target.result;
                document.getElementById('preview-container').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('preview-container').style.display = 'none';
            document.getElementById('preview-foto').src = '';
        }
    });
</script>

<?php include(__DIR__ . '/../layout/footer.php'); ?>
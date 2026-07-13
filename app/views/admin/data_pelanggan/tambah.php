<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Tambah Data</h4>
            <p class="mb-30">Isi Form untuk menambahkan user</p>
        </div>
    </div>
    <form action="<?= base_url('admin/data_pelanggan/tambah') ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-12 col-md-10">
                <input
                    name="nama_lengkap"
                    class="form-control"
                    type="text"
                    placeholder="Masukkan Nama Lengkap" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Foto</label>
            <div class="col-sm-12 col-md-10">
                <input
                    name="foto"
                    class="form-control-file form-control height-auto"
                    type="file" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Email</label>
            <div class="col-sm-12 col-md-10">
                <input
                    name="email"
                    class="form-control"
                    placeholder="Masukkan Email"
                    type="email" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Role</label>
            <div class="col-sm-12 col-md-10">
                <select name="role" class="custom-select col-12">
                    <option selected="">-- Pilih --</option>
                    <option value="Admin">Admin</option>
                    <option value="Pelanggan">Pelanggan</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">No. Telepon</label>
            <div class="col-sm-12 col-md-10">
                <input
                    name="no_telepon"
                    class="form-control"
                    type="number"
                    placeholder="Masukkan Nomor Telepon" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Status</label>
            <div class="col-sm-12 col-md-10">
                <select name="status" class="custom-select col-12">
                    <option selected="">-- Pilih --</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary" name="submit">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>
<!-- Default Basic Forms End -->
<?php include(__DIR__ . '/../layout/footer.php'); ?>

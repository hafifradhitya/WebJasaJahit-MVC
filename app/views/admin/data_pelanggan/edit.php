<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Edit Data</h4>
            <p class="mb-30">Isi Form untuk mengedit user</p>
        </div>
    </div>  
    <form action="<?= base_url('admin/data_pelanggan/edit') ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-12 col-md-10">
                <input
                    name="nama_lengkap"
                    class="form-control"
                    type="text"
                    value="<?= $user->nama_lengkap ?? '' ?>" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Foto</label>
            <div class="col-sm-12 col-md-10">
                <input
                    type="hidden" value="<?= $user->foto ?? '' ?>" name="foto_lama" />
                <input type="file" class="form-control-file form-control height-auto" name="foto_baru">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Email</label>
            <div class="col-sm-12 col-md-10">
                <input
                    name="email"
                    class="form-control"
                    value="<?= $user->email ?? '' ?>"
                    type="email" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Role</label>
            <div class="col-sm-12 col-md-10">
                <select name="role" class="custom-select col-12">
                    <option value="">-- Pilih --</option>
                    <option <?= (isset($user->role) && strtolower($user->role) == 'admin') ? 'selected' : '' ?> value="admin">Admin</option>
                    <option <?= (isset($user->role) && strtolower($user->role) == 'pelanggan') ? 'selected' : '' ?> value="pelanggan">Pelanggan</option>
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
                    value="<?= $user->no_telepon ?? '' ?>" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Status</label>
            <div class="col-sm-12 col-md-10">
                <select name="status" class="custom-select col-12">
                    <option value="">-- Pilih --</option>
                    <option <?= (isset($user->status) && $user->status == 'Aktif') ? 'selected' : '' ?> value="Aktif">Aktif</option>
                    <option <?= (isset($user->status) && $user->status == 'Tidak Aktif') ? 'selected' : '' ?> value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
        </div>
        <input type="hidden" value="<?= $user->kode_user ?? '' ?>" name="kode_user">
        <input type="hidden" value="<?= $user->password ?? '' ?>" name="password_lama">
        <input type="hidden" name="method" value="edit">

        <div class="form-group row">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>
<!-- Default Basic Forms End -->
<?php include(__DIR__ . '/../layout/footer.php'); ?>

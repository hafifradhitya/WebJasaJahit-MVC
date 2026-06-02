<?php include(__DIR__ . '/../layout/header.php'); ?>

<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Edit Data</h4>
            <p class="mb-30">Isi Form untuk mengedit user</p>
        </div>
    </div>
    <form action="<?= base_url('admin/data_kategori/edit') ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="" class="col-sm-12 col-md-2 col-form-label">Nama Kategori</label>
            <div class="col-sm-12 col-md-10">
                <input 
                    name="nama_kategori"
                    class="form-control"
                    type="text"
                    value="<?= $kategori->nama_kategori ?>" />
            </div> 
        </div>

        <input type="hidden" name="id_kategori" value="<?= $kategori->id_kategori ?>">
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
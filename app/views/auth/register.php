<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOXICONS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('public/css/style-login.css') ?>">

    <title>Register | Jasa Jahit</title>
</head>

<body>

    <div class="wrapper">
        <div class="form-header">
            <div class="titles">
                <div class="title-login">Register</div>
            </div>
        </div>

        <!-- REGISTER FORM -->
        <form action="" method="POST" class="login-form" autocomplete="off">

            <div class="input-box">
                <input type="text" class="input-field" name="nama_lengkap" required>
                <label class="label">Nama Lengkap</label>
                <i class='bx bx-user icon'></i>
            </div>

            <div class="input-box">
                <input type="email" class="input-field" name="email" required>
                <label class="label">Email</label>
                <i class='bx bx-envelope icon'></i>
            </div>


            <div class="input-box">
                <input type="text" class="input-field" name="no_telepon" required>
                <label class="label">Nomor Telepon</label>
                <i class='bx bx-phone icon'></i>
            </div>

            <div class="input-box">
                <input type="password" class="input-field" name="password" required>
                <label class="label">Password</label>
                <i class='bx bx-lock-alt icon'></i>
            </div>

            <div class="input-box">
                <button type="submit" name="register" class="btn-submit">
                    Register <i class='bx bx-user-plus'></i>
                </button>
            </div>

            <div class="switch-form">
                <span>Sudah punya akun? <a href="<?= base_url('auth/login') ?>">Login</a></span>
            </div>

        </form>
    </div>

    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if(isset($_SESSION["gagal"])) { ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "<?= $_SESSION["gagal"] ?>",
            });
        </script>
        <?php unset($_SESSION["gagal"]); ?>
    <?php } ?>
</body>

</html>

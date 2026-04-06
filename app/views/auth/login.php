<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('public/css/style-login.css') ?>">
    <title>Login | Jasa Jahit</title>
</head>

<body>
    <div class="wrapper">
        <div class="form-header">
            <div class="titles">
                <div class="title-login">Login</div>
            </div>
        </div>

        <!-- LOGIN FORM -->
        <form action="" method="POST" class="login-form" autocomplete="off">
            <div class="input-box">
                <!-- Using type text to allow both email and phone numbers -->
                <input type="text" class="input-field" name="identitas" id="log-identitas" required>
                <label for="log-identitas" class="label">Email / No. Telepon</label>
                <i class='bx bx-envelope icon'></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name="password" id="log-pass" required>
                <label for="log-pass" class="label">Password</label>
                <i class='bx bx-lock-alt icon'></i>
            </div>
            <div class="form-cols">
                <div class="col-1"></div>
                <div class="col-2">
                    <a href="#">Forgot password?</a>
                </div>
            </div>
            <div class="input-box">
                <button type="submit" name="login" class="btn-submit" id="SignInBtn">Sign In <i class='bx bx-log-in'></i></button>
            </div>
            <div class="switch-form">
                <span>Don't have an account? <a href="<?= base_url('auth/register') ?>" onclick="registerFunction()">Register</a></span>
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

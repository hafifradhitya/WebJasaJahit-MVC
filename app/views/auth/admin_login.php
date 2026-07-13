<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('public/css/style-login.css?v=' . time()) ?>">
    <title>Admin Portal | Jasa Jahit</title>
</head>

<body>
    <div class="container" id="container">

        <!-- SIGN IN FORM -->
        <div class="form-container sign-in">
            <form action="<?= base_url($_SESSION['admin_login_token']) ?>" method="POST" autocomplete="off">
                <h1>Admin Portal</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class='bx bxl-google'></i></a>
                    <a href="#" class="icon"><i class='bx bxl-facebook'></i></a>
                    <a href="#" class="icon"><i class='bx bxl-github'></i></a>
                    <a href="#" class="icon"><i class='bx bxl-linkedin'></i></a>
                </div>
                <span>or use your email password</span>
                <div class="input-box">
                    <input type="text" class="input-field" name="identitas" placeholder="Email / No. Telepon" required>
                    <i class='bx bx-envelope icon-input'></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="password" placeholder="Password" required>
                    <i class='bx bx-lock-alt icon-input'></i>
                </div>
                <a href="#">Forget Your Password?</a>
                <button type="submit" name="login" class="btn-submit">Sign In as Admin</button>
            </form>
        </div>

        <!-- TOGGLE CONTAINER -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Administrator!</h1>
                    <p>Enter your personal details to access the administrator dashboard</p>
                </div>
            </div>
        </div>
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

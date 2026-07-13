<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('public/css/style-login.css?v=' . time()) ?>">
    <title>Login & Register | Jasa Jahit</title>
</head>

<body>
    <div class="container" id="container">
        <!-- SIGN UP FORM -->
        <div class="form-container sign-up">
            <form action="<?= base_url('auth/register') ?>" method="POST" autocomplete="off">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class='bx bxl-google'></i></a>
                    <a href="#" class="icon"><i class='bx bxl-facebook'></i></a>
                    <a href="#" class="icon"><i class='bx bxl-github'></i></a>
                    <a href="#" class="icon"><i class='bx bxl-linkedin'></i></a>
                </div>
                <span>or use your email for registration</span>
                <div class="input-box">
                    <input type="text" class="input-field" name="nama_lengkap" placeholder="Nama Lengkap" required>
                    <i class='bx bx-user icon-input'></i>
                </div>
                <div class="input-box">
                    <input type="email" class="input-field" name="email" placeholder="Email" required>
                    <i class='bx bx-envelope icon-input'></i>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" name="no_telepon" placeholder="Nomor Telepon" required>
                    <i class='bx bx-phone icon-input'></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="password" placeholder="Password" required>
                    <i class='bx bx-lock-alt icon-input'></i>
                </div>
                <button type="submit" name="register" class="btn-submit">Sign Up</button>
            </form>
        </div>

        <!-- SIGN IN FORM -->
        <div class="form-container sign-in">
            <form action="<?= base_url('auth/login') ?>" method="POST" autocomplete="off">
                <h1>Sign In</h1>
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
                <button type="submit" name="login" class="btn-submit">Sign In</button>
            </form>
        </div>

        <!-- TOGGLE CONTAINER -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT FOR TOGGLE -->
    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        let isAnimating = false;

        registerBtn.addEventListener('click', () => {
            if (isAnimating) return;
            isAnimating = true;
            container.classList.add("active");
            setTimeout(() => { isAnimating = false; }, 600);
        });

        loginBtn.addEventListener('click', () => {
            if (isAnimating) return;
            isAnimating = true;
            container.classList.remove("active");
            setTimeout(() => { isAnimating = false; }, 600);
        });
    </script>

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

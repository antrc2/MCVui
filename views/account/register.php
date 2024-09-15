<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/user/components/head.php" ?>
    <link rel="stylesheet" href="assets/css/account/register.css">
    <script src="assets/js/account/register.js"></script>
    <title>CheeseMC - Đăng kí</title>
</head>
<body>
    <div>
        <?php require_once "views/user/components/navbar.php" ?>
        <div>
            <h1>Đăng kí</h1>
            <div class="login"> <!-- Sử dụng class 'login' cho consistency -->
                <form action="" method="POST" onsubmit="return valFormRegister()">
                    <div class="data">
                        <label for="">Tài khoản</label>
                        <input type="text" name="username" id="username">
                        <div class="error" id="usernameError"></div>
                    </div>
                    <div class="data">
                        <label for="">Email</label>
                        <input placeholder="Không bắt buộc" type="text" name="email" id="email">
                        <div class="error" id="emailError"></div>
                    </div>
                    <div class="data">
                        <label for="">Mật khẩu</label>
                        <input type="password" name="password" id="password">
                        <div class="error" id="passwordError"></div>
                    </div>
                    <div class="data">
                        <label for="">Nhập lại mật khẩu</label>
                        <input type="password" name="rePassword" id="rePassword">
                        <div class="error" id="rePasswordError"></div>
                    </div>
                    <div class="btn-login"> <!-- Sử dụng class 'btn-login' cho consistency -->
                        <button name="btn_register">Đăng kí</button>
                    </div>
                </form>
                <div>
                    <p>Đã có tài khoản? <a href="/login">Đăng nhập</a></p>
                </div>
            </div>
        </div>
        <?php require_once "views/user/components/footer.php" ?>
    </div>
</body>
</html>

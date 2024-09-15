<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/user/components/head.php" ?>
    <script src="assets/js/account/login.js"></script>
    <title>MCVui - Đăng nhập</title>
</head>
<body>
    <div>
    <?php require_once "views/user/components/navbar.php" ?>
        <div>
            <div class="login">
                <form action="" method="POST" onsubmit="return valFormLogin()">
                    <div class="data">
                        <label for="">Tài khoản</label>
                        <input type="text" name="username" id="username">
                        <div class="error" id="usernameError"></div>
                    </div>
                    <div class="data">
                        <label for="">Mật khẩu</label>
                        <input type="password" name="password" id="password">
                        <div class="error"  id="passwordError"></div>
                    </div>
                    <div class="btn-login">
                        <button name="btn_login">Đăng nhập</button>
                    </div>
                </form>
                <div>
                    <p>Chưa có tài khoản? <a href="/register">Đăng kí</a></p>
                </div>
            </div>
        </div>
        <?php require_once "views/user/components/footer.php" ?>
    </div>
</body>
</html>
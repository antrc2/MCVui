<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/user/components/head.php" ?>
    <script src="assets/js/account/login.js"></script>
    <link rel="stylesheet" href="assets/css/user/account/login.css">
    <title>MCVui - Đăng nhập</title>
</head>
<body>
    <div>
    <?php require_once "views/user/components/navbar.php" ?>
        <div class="main">
            <div class="login">
                <h1>Đăng nhập</h1>
                <form action="" method="POST" onsubmit="return valFormLogin()">
                    <div class="data">
                        <div class="form-group text">
                            <div>
                                <label for="">Tài khoản</label>
                            </div>
                            <div>
                                <input type="text" name="username" id="username">
                            </div>
                        </div>
                        <div class="form-group error">
                            <div class="error" id="usernameError"></div>
                        </div>
                    </div>
                    <div class="data">
                        <div class="form-group text">
                            <div>
                                <label for="">Mật khẩu</label>
                            </div>
                            <div>
                                <input type="password" name="password" id="password">
                            </div>
                        </div>
                        <div class="form-group error">
                            <div class="error"  id="passwordError"></div>
                        </div>
                    </div>
                    <div class="btn-login">
                        <button name="btn_login">Đăng nhập</button>
                    </div>
                </form>
                <div class="other">
                    <p>Chưa có tài khoản? <a href="/register">Đăng kí</a></p>
                </div>
            </div>
        </div>
        <?php require_once "views/user/components/footer.php" ?>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/user/components/head.php" ?>
    <link rel="stylesheet" href="assets/css/user/account/login.css">
    <script src="assets/js/account/register.js"></script>
    <title>MCVui - Đăng kí</title>
</head>
<body>
    <div>
        <?php require_once "views/user/components/navbar.php" ?>
        <div class="main">
            
            <div class="login"> <!-- Sử dụng class 'login' cho consistency -->
                <h1>Đăng kí</h1>
                <form action="" method="POST" onsubmit="return valFormRegister()">
                    <div class="data">
                        <div class="form-group text">
                            <div>
                                <label for="username">Tài khoản</label>
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
                                <label for="email">Email</label>
                            </div>
                            <div>
                                <input placeholder="Không bắt buộc" type="text" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-group error">
                            <div class="error" id="emailError"></div>
                        </div>
                    </div>
                    <div class="data">
                        <div class="form-group text">
                            <div>
                                <label for="password">Mật khẩu</label>
                            </div>
                            <div>
                                <input type="password" name="password" id="password">
                            </div>
                        </div>
                        <div class="form-group error">
                            <div class="error" id="passwordError"></div>
                        </div>
                    </div>
                    <div class="data">
                        <div class="form-group text">
                            <div>
                                <label for="rePassword">Nhập lại mật khẩu</label>
                            </div>
                            <div>
                                <input type="password" name="rePassword" id="rePassword">
                            </div>
                        </div>
                        <div class="form-group error">
                            <div class="error" id="rePasswordError"></div>
                        </div>
                    </div>
                    <div class="btn-login"> <!-- Sử dụng class 'btn-login' cho consistency -->
                        <button name="btn_register">Đăng kí</button>
                    </div>
                </form>
                <div class="other">
                    <p>Đã có tài khoản? <a href="/login">Đăng nhập</a></p>
                </div>
            </div>
        </div>
        <?php require_once "views/user/components/footer.php" ?>
    </div>
</body>
</html>

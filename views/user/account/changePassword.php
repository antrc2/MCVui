<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/user/components/head.php" ?>
    <link rel="stylesheet" href="assets/css/user/account/login.css">
    <script src="assets/js/account/changePassword.js"></script>
    <title>MCVui - Thông tin cá nhân</title>
</head>
<body>
    <div>
        <?php require_once "views/user/components/navbar.php" ?>
        <div class="main">
            <div class="login">
                <h1>Đổi mật khẩu</h1>
                <form action="" method="POST" onsubmit="return valFormChangePassword()">
                    <div class="data">
                        <div class="form-group text">
                            <div>
                                <label for="password">Mật khẩu cũ</label>
                            </div>
                            <div>
                                <input type="password" name="oldPassword" id="oldPassword">
                            </div>
                        </div>
                        <div class="form-group error">
                            <div class="error" id="oldPasswordError"></div>
                        </div>
                    </div>
                    <div class="data">
                        <div class="form-group text">
                            <div>
                                <label for="password">Mật khẩu mới</label>
                            </div>
                            <div>
                                <input type="password" name="newPassword" id="newPassword">
                            </div>
                        </div>
                        <div class="form-group error">
                            <div class="error" id="newPasswordError"></div>
                        </div>
                    </div>
                    <div class="data">
                        <div class="form-group text">
                            <div>
                                <label for="rePassword">Nhập lại mật khẩu mới</label>
                            </div>
                            <div>
                                <input type="password" name="reNewPassword" id="reNewPassword">
                            </div>
                        </div>
                        <div class="form-group error">
                            <div class="error" id="reNewPasswordError"></div>
                        </div>
                    </div>
                    <div class="btn-login"> <!-- Sử dụng class 'btn-login' cho consistency -->
                        <button name="btn_changePassword">Đổi mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
        <?php require_once "views/user/components/footer.php" ?>
    </div>
</body>
</html>
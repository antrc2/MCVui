<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/admin/components/head.php" ?>
    <title>MCVui - Tài khoản</title>
</head>
<body>
    <div>
        <?php require_once "views/admin/components/navbar.php" ?>
        <div>
            <div>
                <h1>Sửa thông tin</h1>
                <div>
                    <?php if ($status): ?>
                    <form action="" method="POST">
                        <table>
                            <tr>
                                <th>Username</th>
                                <td><?= $username?></td>
                            </tr>
                            <tr>
                                <th>Quyền</th>
                                <td>
                                    <select name="role">
                                        <option value="<?= $account['id']?>"><?= $account["name"]?></option>
                                        <?php foreach ($roles as $value): ?>
                                            <?php if ($value['id'] !== $account['role']) :?>
                                                <option value="<?= $value['id']?>"><?= $value['name']?></option>
                                            <?php endif ?>
                                        <?php endforeach?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Đặt lại mật khẩu</th>
                                <td><input type="text" name="password"></td>
                            </tr>
                        </table>
                        <button name="btn_updateAccount">Sửa</button>
                    </form>
                    <?php else:?>
                    <h2>Không tìm thấy người chơi</h2>
                    <?php endif?>
                </div>
            </div>
        </div>
        <?php require_once "views/admin/components/footer.php" ?>
    </div>
</body>
</html>
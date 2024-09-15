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
            <h1>Quản lí tài khoản</h1>
            <form action="" method="POST">
                <div>
                    <label for="">Username</label>
                    <input type="text" name="username" value="<?= isset($username) ? $username : ""?>">
                </div>
                <div>
                    <button name="btn_searchUsername">Tìm kiếm</button>
                </div>
            </form>
            <div>
                <table border="1">
                    <tr>
                        <th>Username</th>
                        <th>Ngày đăng kí</th>
                        <th>Lần đăng nhập cuối</th>
                        <th>Quyền</th>
                        <th>Lịch sử nạp thẻ</th>
                        <th>Lịch sử đổi xu</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                    <?php foreach($accounts as $value): ?>
                    <tr>
                        <td><?= $value['realname']?></td>
                        <td><?= epochTimeToDateTime(intval($value['regdate']/1000))?></td>
                        <td><?= epochTimeToDateTime(intval($value['lastlogin']/1000))?></td>
                        <td><?= $value['name']?></td>
                        <td><form action="/donate-history" method="POST"><input type="hidden" name="username" value="<?= htmlspecialchars($value['realname'], ENT_QUOTES) ?>"><button name="btn_filter">Xem</button></form></td>
                        <td><form action="/exchange-history" method="POST"><input type="hidden" name="username" value="<?= htmlspecialchars($value['realname'], ENT_QUOTES) ?>"><button name="btn_searchExchangeHistory">Xem</button></form></td>
                        <td><a href="update-account?&username=<?= $value['realname']?>"><button>Sửa</button></a></td>
                        <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" href="delete-account?&username=<?= $value['realname']?>"><button>Xóa</button></a></td>
                    </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
        <?php require_once "views/admin/components/footer.php" ?>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/user/components/head.php" ?>
    <link rel="stylesheet" href="assets/css/user/account/profile.css">
    <title>MCVui - Thông tin cá nhân</title>
</head>
<body>
    <div>
        <?php require_once "views/user/components/navbar.php" ?>
        <div>
            <div>
                <div class="profile info">
                    <h1>Thông tin cá nhân</h1>
                    <div class="table">
                        <table>
                            <tr>
                                <th>Tên người chơi</th>
                                <td><?= $informationOfUser['realname']?></td>
                            </tr>
                            <tr>
                                <th>Ngày đăng kí</th>
                                <td><?= epochTimeToDateTime(intval(intval($informationOfUser['regdate'])/1000))?></td>
                            </tr>
                            <tr>
                                <th>Lần đăng nhập cuối</th>
                                <td><?= epochTimeToDateTime(intval(intval($informationOfUser['lastlogin'])/1000))?></td>
                            </tr>
                            <tr>
                                <th>Quyền</th>
                                <td><?= $informationOfUser['name']?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="profile exchange">
                    <h1>Lịch sử đổi xu</h1>
                    <div class="table">
                        <table>
                            <tr>
                                <th>Máy chủ</th>
                                <th>Số lượng</th>
                                <th>Thời gian</th>
                            </tr>
                            <?php foreach ($exchangeHistories as $value): ?>
                            <tr>
                                <td><?= $value['server']?></td>
                                <td><?= $value['amount']?></td>
                                <td><?= epochTimeToDateTime(intval(intval($value['time'])/1000))?></td>
                            </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
                <div class="profile donate">
                    <h1>Lịch sử nạp thẻ</h1>
                    <div class="table">
                        <table>
                            <tr>
                                <th>Ngày</th>
                                <th>Nội dung</th>
                                <th>Kiểu nạp</th>
                                <th>Xu đã nhận</th>
                            </tr>
                            <?php foreach ($donateHistories as $value): ?>
                            <tr>
                                <td><?= epochTimeToDateTime(intval(intval($value['date_time'])))?></td>
                                <td><?= $value['message']?></td>
                                <td><?= $value['type'] ? "Bank" : "Card"?></td>
                                <td><?= $value['point']?></td>
                            </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once "views/user/components/footer.php" ?>
    </div>
</body>
</html>
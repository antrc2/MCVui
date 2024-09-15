<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/admin/components/head.php" ?>
    <title>MCVui - Lịch sử chuyển xu</title>
</head>
<body>
    <div>
        <?php require_once "views/admin/components/navbar.php" ?>
        <div>
            <h1>Lịch sử chuyển xu</h1>
            <form action="" method="POST">
                <div>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?= isset($username) ? htmlspecialchars($username, ENT_QUOTES) : "" ?>">
                </div>
                <div>
                    <label for="from_date_time">Từ ngày</label>
                    <input type="datetime-local" id="from_date_time" name="from_date_time" value="<?= isset($fDateTime) ? htmlspecialchars($fDateTime, ENT_QUOTES) : "" ?>">
                </div>
                <div>
                    <label for="to_date_time">Đến ngày</label>
                    <input type="datetime-local" id="to_date_time" name="to_date_time" value="<?= isset($tDateTime) ? htmlspecialchars($tDateTime, ENT_QUOTES) : "" ?>">
                </div>
                <div>
                    <label for="">Từ số xu</label>
                    <input type="number" name="from_points" min="0" step="1" value="<?= isset($fromPoints) ? ($fromPoints) : "" ?>">
                </div>
                <div>
                    <label for="">Đến số xu</label>
                    <input type="number" name="to_points" min="0" step="1" value="<?= isset($toPoints) ? ($toPoints) : "" ?>">
                </div>
                <div>
                    <label for="type">Máy chủ</label>
                    <select id="type" name="server">
                        <option value="">Chọn máy chủ</option>
                        <?php foreach($servers as $value): ?>
                            <option value="<?= $value['server_value']?>" <?= isset($server) && $server !== "" ? "selected" : "" ?>><?= $value['server_name']?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div>
                    <button name="btn_searchExchangeHistory">Tìm kiếm</button>
                </div>
            </form>
            <table>
                <tr>
                    <th>Người chơi</th>
                    <th>Thời gian</th>
                    <th>Máy chủ</th>
                    <th>Số Points</th>
                </tr>
                <?php if (!empty($exchangeHistories)): ?>
                <?php foreach ($exchangeHistories as $value) :?>
                <tr>
                    <td><?= $value['player']?></td>
                    <td><?= epochTimeToDateTime(intval(intval($value['time'])/1000))?></td>
                    <td><?= $value['server']?></td>
                    <td><?= $value['amount']?></td>
                </tr>
                <?php endforeach ?>
                <?php endif ?>
            </table>
        </div>
        <?php require_once "views/admin/components/footer.php" ?>
    </div>
</body>
</html>
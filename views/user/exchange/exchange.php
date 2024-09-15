<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCVui - Chuyển xu</title>
    <?php require_once "views/user/components/head.php" ?>
</head>
<body>
    <div>
        <?php require_once "views/user/components/navbar.php" ?>
        <div>
            <div>
                <h1>Chuyển Xu</h1>
                <div>
                    Số xu: <?= $point?>
                </div>
                <form action="" method="POST">
                    <div>
                        <label for="">Máy chủ</label>
                        <select name="server" id="" required>
                            <option value="">Chọn cụm</option>
                            <?php foreach ($servers as $value): ?>
                                <option value="<?= $value['server_value']?>"><?= $value['server_name']?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div>
                        <label for="">Số xu</label>
                        <input type="number" name="points" min="1" step="1">
                    </div>
                    <div>
                        <button name="btn_exchange">Chuyển</button>
                    </div>
                </form>
            </div>
            <div>
                <h1>Lịch sử chuyển xu</h1>
                <table>
                    <tr>
                        <th>Thời gian</th>
                        <th>Máy chủ</th>
                        <th>Số xu</th>
                    </tr>
                    <?php foreach ($exchangeHistorybyUsername as $value):?>
                        <tr>
                            <td><?= epochTimeToDateTime(intval(intval($value['time'])/1000))?></td>
                            <td><?= $value['server_name']?></td>
                            <td><?= $value['amount']?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
        <?php require_once "views/user/components/footer.php" ?>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCVui - Chuyển xu</title>
    <?php require_once "views/user/components/head.php" ?>
    <link rel="stylesheet" href="assets/css/user/exchange/exchange.css">
</head>
<body>
    <div>
        <?php require_once "views/user/components/navbar.php" ?>
        <div class="main">
            <div class="exchange">
                <div class="title">
                    <h1>Chuyển Xu</h1>
                    <p>
                        Số xu: <?= $point?>
                    </p>
                </div>
                <div class="form">
                    <form id="exchangeForm" action="" method="POST">
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
                            <input type="number" name="points" min="1" step="1" required>
                        </div>
                        <div>
                        <button name="btn_exchange">Chuyển</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php require_once "views/user/components/footer.php" ?>
    </div>
</body>
</html>
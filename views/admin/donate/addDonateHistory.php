<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/admin/components/head.php" ?>
    <title>MCVui - Lịch sử nạp thẻ</title>
</head>
<body>
    <div>
        <?php require_once "views/admin/components/navbar.php" ?>
        <div>
            <h1>Thêm lịch sử nạp thẻ</h1>
            <form action="" method="POST">
                <div>
                    <label for="">Username</label>
                    <input type="username" name="username">
                </div>
                <div>
                    <label for="">Lí do</label>
                    <input type="text" name="message">
                </div>
                <div>
                    <label for="">Số tiền mình nhận</label>
                    <input type="number" min='1000' step="1000" name="money_vnd">
                </div>
                <div>
                    <label for="">Số xu người chơi nhận</label>
                    <input type="number" placeholder="Đã tính cả khuyến mãi" name="points">
                </div>
                <div>
                    <button name="btn_addDonateHistory">Thêm</button>
                </div>
            </form>
        </div>
        <?php require_once "views/admin/components/footer.php" ?>
    </div>
</body>
</html>
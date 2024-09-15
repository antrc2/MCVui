<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/admin/components/head.php" ?>
    <title>MCVui - Sự kiện</title>
</head>
<body>
    <div>
        <?php require_once "views/admin/components/navbar.php" ?>
        <div>
            <h1>Thêm sự kiện</h1>
            <form action="" method="POST">
                <div>
                    <label>Ngày hết hạn</label>
                    <input type="datetime-local" name="expire">
                </div>
                <div>
                    <label>Tỉ lệ</label>
                    <input type="number" name="rate" min="1" max="200" step="1">
                </div>
                <div>
                    <button name="btn_addEvent">Thêm sự kiện</button>
                </div>
            </form>
        </div>
        <?php require_once "views/admin/components/footer.php" ?>
    </div>
</body>
</html>
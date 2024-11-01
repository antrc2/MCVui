<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/admin/components/head.php" ?>
    <title>MCVui - Máy chủ</title>
</head>
<body>
    <div>
        <?php require_once "views/admin/components/navbar.php" ?>
        <div>
            <h1>Thêm server</h1>
            <div>
                <form action="" method="POST">
                    <div>
                        <label>Server Value</label>
                        <input type="text" name="serverValue">
                    </div>
                    <div>
                        <label for="">Server Name</label>
                        <input type="text" name="serverName">
                    </div>
                    <div>
                        <button name="btn_addServer">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
        <?php require_once "views/admin/components/footer.php" ?>
    </div>
</body>
</html>
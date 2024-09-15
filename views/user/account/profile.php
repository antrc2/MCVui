<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/user/components/head.php" ?>
    <title>MCVui - Thông tin cá nhân</title>
</head>
<body>
    <div>
        <?php require_once "views/user/components/navbar.php" ?>
        <div>
            <div>
                <h1>Xin chào <?= $_SESSION['username']?></h1>
            </div>
        </div>
        <?php require_once "views/user/components/footer.php" ?>
    </div>
</body>
</html>
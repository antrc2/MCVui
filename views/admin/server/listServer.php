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
            <h1>Danh sách Máy chủ (Dành cho AnTrc2)</h1>
            <a href="/add-server"><button>Thêm máy chủ</button></a>
            <table>
                <tr>
                    <th>Server Value</th>
                    <th>Server Name</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                <?php foreach ($servers as $server): ?>
                <tr>
                    <td><?= $server['server_value']?></td>
                    <td><?= $server['server_name']?></td>
                    <td><a href="/update-server?id=<?= $server['id']?>"><button>Sửa</button></a></td>
                    <td><a onclick="confirm('Bạn có chắc chắn muốn xóa không?')" href="/delete-server?id=<?= $server['id']?>"><button>Xóa</button></a></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
        <?php require_once "views/admin/components/footer.php" ?>
    </div>
</body>
</html>
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
            <h1>Danh sách sự kiện</h1>
            <a href="/add-event"><button>Thêm sự kiện</button></a>
            <table>
                <tr>
                    <th>Trạng thái</th>
                    <th>Ngày hết hạn</th>
                    <th>Còn lại</th>
                    <th>Phần trăm</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                <?php foreach ($events as $value): ?>
                <tr>
                    <td>
                        <?= (time() > $value['expire']) ? "Hết hạn" : "Còn hạn" ?>
                    </td>
                    <td><?= epochTimeToDateTime($value['expire'])?></td>
                    <td><?=(time() > $value['expire']) ? "00:00:00" : sprintf('%02d:%02d:%02d', floor(($value['expire'] - time()) / 3600), floor((($value['expire'] - time()) % 3600) / 60), ($value['expire'] - time()) % 60)?></td>
                    <td><?= $value['rate']?></td>
                    <td><a href="/update-event?id=<?= $value['id']?>"><button>Sửa</button></a></td>
                    <td><a onclick="return confirm('Bạn có chắc chắn không?')" href="/delete-event?id=<?= $value['id']?>"><button>Xóa</button></a></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
        <?php require_once "views/admin/components/footer.php" ?>
    </div>
</body>
</html>
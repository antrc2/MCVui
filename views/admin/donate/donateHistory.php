<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/admin/components/head.php" ?>
    <title>MCVui - Lịch sử nạp thẻ</title>
    <style>
        .card{
            width: 100%;
        }
        table{
            width: 100%;
        }
        .donate{
            display: flex;
        }
        h2{
            text-align: center;
        }
        @media screen and (max-width: 700px) {
            .card,.bank{
            width: 100%;
            }
            .donate{
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div>
        <?php require_once "views/admin/components/navbar.php" ?>
        <div>
            <h1>Lịch sử nạp thẻ</h1>
            <a href="/add-event"><button>Thêm sự kiện</button></a>
            <div class="filter">
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
                    <label for="serial">Serial</label>
                    <input type="text" id="serial" name="serial" value="<?= isset($serial) ? htmlspecialchars($serial, ENT_QUOTES) : "" ?>">
                </div>
                <div>
                    <label for="code">Code</label>
                    <input type="text" id="code" name="code" value="<?= isset($code) ? htmlspecialchars($code, ENT_QUOTES) : "" ?>">
                </div>
                <div>
                    <label for="type">Kiểu nạp</label>
                    <select id="type" name="type">
                        <option value="">Chọn kiểu nạp</option>
                        <option value="0" <?= isset($type) && $type == "0" ? "selected" : "" ?>>Card</option>
                        <option value="1" <?= isset($type) && $type == "1" ? "selected" : "" ?>>Bank</option>
                    </select>
                </div>
                <div>
                    <button type="submit" name="btn_filter">Lọc</button>
                </div>
            </form>
            <?php if ($role['name'] === "owner"): ?>
            <a href="add-donate-history"><button>Thêm lịch sử nạp thẻ</button></a>
            <?php endif ?>
            <div class='money'>
                <?php 
                $total =0;
                foreach ($donateHistories as $value){
                    $total +=$value['money_vnd'];
                } ?>
                <div class="money">Tổng số tiền mình nhận: <?= $total?></div>
            </div>
            </div>
            <div class="donate">
                <div class="card">
                    <h2>Lịch sử nạp thẻ</h2>
                    <table border="1">
                        <tr>
                            <th>Username</th>
                            <th>Trạng thái</th>
                            <th>Nội dung</th>
                            <th>Ngày</th>
                            <th>Mệnh giá thẻ</th>
                            <th>Số tiền mình nhận</th>
                            <th>Loại thẻ</th>
                            <th>Kiểu nạp</th>
                            <th>Serial</th>
                            <th>Code</th>
                            <th>Point</th>
                        </tr>
                        <?php if(!empty($donateHistories)): ?>
                        <?php $total = 0 ?>
                        <?php foreach($donateHistories as $value): ?>
                        <tr>
                            <td><?= $value['username']?></td>
                            <td><?= $value['status']?></td>
                            <td><?= $value['message']?></td>
                            <td><?= epochTimeToDateTime($value['date_time'])?></td>
                            <td><?= $value['card_amount']?></td>
                            <td class='moneyVND'><?= $value['money_vnd']?></td>
                            <td><?= $value['card_type']?></td>
                            <td><?= $value['type'] ? "Bank" : "Card" ?></td>
                            <td><?= $value['serial']?></td>
                            <td><?= $value['code']?></td>
                            <td><?= $value['point']?></td>
                        </tr>
                        <?php $total += $value['money_vnd'] ?>
                        <?php endforeach ?>
                        <?php endif ?>
                    </table>
                </div>
            </div>
        </div>
        <?php require_once "views/admin/components/footer.php" ?>
    </div>
</body>
</html>
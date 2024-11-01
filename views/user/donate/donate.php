<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "views/user/components/head.php" ?>
    <link rel="stylesheet" href="assets/css/user/donate/donate.css">
    <title>MCVui - Nạp thẻ</title>
</head>
<body>
    <div class="container">
        <?php require_once "views/user/components/navbar.php" ?>
            <div class="dnt event-section">
                <h1>Khuyến mãi nạp thẻ</h1>
                <?php if (isset($event['expire']) && $event['expire'] > time()): ?>
                    <p><img src="assets/image/hot.gif" alt="Khuyến mãi">Khuyến mãi <strong><?= $event['rate']?>%</strong> đến hết <strong><?= epochTimeToDateTime($event['expire'])?></strong></p>
                <?php endif ?>
                <p><strong>Chủ nhật</strong> hàng tuần khuyến mãi <strong>10%</strong></p>
                <p>Nạp thẻ qua <strong>Ngân hàng</strong> khuyến mãi <strong>20%</strong></p>
            </div>
        <!-- Card Recharge Section -->
        <div class="dnt card-section">
            <h1>Thẻ cào</h1>
            <form action="" method="POST" class="card-form">
                <!-- Card Type -->
                <div class="form-group card-type">
                    <div class="label-wrapper">
                        <label for="cardType">Loại thẻ</label>
                    </div>
                    <div class="input-wrapper">
                        <select name="card_type" id="cardType" class="card-type-select">
                            <option value="">Chọn loại thẻ</option>
                            <option value="Viettel">Viettel</option>
                            <option value="Vinaphone">Vinaphone</option>
                            <option value="Mobifone">Mobifone</option>
                            <option value="Vietnamobile">Vietnamobile</option>
                            <option value="Vcoin">Vcoin</option>
                            <option value="Zing">Zing</option>
                            <option value="Gate">Gate</option>
                            <option value="Garena">Garena</option>
                        </select>
                    </div> 
                </div>
                <div id="cardTypeError" class="error"></div>

                <!-- Card Amount -->
                <div class="form-group card-amount">
                    <div class="label-wrapper">
                        <label for="cardAmount">Mệnh giá</label>
                    </div>
                    <div class="input-wrapper">
                        <select name="card_amount" id="cardAmount" class="card-amount-select">
                            <option value="">Chọn mệnh giá</option>
                            <option value="10000">10.000</option>
                            <option value="20000">20.000</option>
                            <option value="30000">30.000</option>
                            <option value="50000">50.000</option>
                            <option value="100000">100.000</option>
                            <option value="200000">200.000</option>
                            <option value="300000">300.000</option>
                            <option value="500000">500.000</option>
                            <option value="1000000">1.000.000</option>
                        </select>
                    </div>
                </div>
                <div id="cardAmountError" class="error"></div>

                <!-- Serial Number -->
                <div class="form-group serial-number">
                    <div class="label-wrapper">
                        <label for="serial">Số Serial</label>
                    </div>
                    <div class="input-wrapper">
                        <input type="text" id="serial" name="serial" class="serial-input">
                    </div>
                </div>
                <div id="serialError" class="error"></div>

                <!-- Card Code -->
                <div class="form-group card-code">
                    <div class="label-wrapper">
                        <label for="code">Mã thẻ</label>
                    </div>
                    <div class="input-wrapper">
                        <input id="code" type="text" name="code" class="code-input">
                    </div>
                </div>
                <div id="codeError" class="error"></div>

                <!-- Submit Button -->
                <div class="form-group submit-button">
                    <button name="btn_sendCard" class="btn-submit">Nạp thẻ</button>
                </div>
            </form>
        </div>

        <!-- Bank Payment Section -->
        <div class="dnt bank-section">
            <h1>Ngân hàng</h1>
            <?php if (!$qrCodeStatus): ?>
            <form action="" method="POST" class="bank-form">
                <div class="form-group submit-button">
                    <button name="btn_getQR" class="btn-getQR">Lấy mã</button>
                </div>
            </form>
            <?php else: ?>
            <div class="qr-code-section">
                <img src="<?= $qrCode ?>" alt="QR Code" class="qr-code-img">
                <div class="warn">
                    <div>
                        <p>Lưu ý: Chỉ sử dụng các ứng dụng ngân hàng để chuyển khoản. Không sử dụng các ứng dụng khác ví dụ như Momo, Viettel Money, ...</p>
                        <p>Sau 30 giây chưa nhận được xu vui lòng báo với STAFF để được hỗ trợ</p>
                    </div>
                </div>
                <div>
                    <table border="1">
                        <tr>
                            <th>Ngân hàng</th>
                            <td><img src="assets/image/Logo_MB_new.png" align="center" alt="Logo MBBank"></td>
                        </tr>
                        <tr>
                            <th>Số tài khoản</th>
                            <td>3210130112005</td>
                        </tr>
                        <tr>
                            <th>Chủ tài khoản</th>
                            <td>LUU ANH VY</td>
                        </tr>
                        <tr>
                            <th>Nội dung</th>
                            <td><?= $_SESSION['username']?></td>
                        </tr>
                    </table>
                </div>
                
            </div>
            <?php endif ?>
        </div>

        <?php require_once "views/user/components/footer.php" ?>
    </div>
</body>
</html>

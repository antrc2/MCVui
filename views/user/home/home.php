<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCVui - Trang chủ</title>
    <meta name="description" content="MCVui là máy chủ Minecraft hàng đầu Việt Nam. Kết nối và khám phá thế giới Minecraft đa dạng với chúng tôi. Tham gia ngay để chơi cùng bạn bè!">
    <meta name="keywords" content="Minecraft, Minecraft server, máy chủ Minecraft, MCVui, Minecraft Việt Nam, Minecraft PE, Minecraft PC">
    <meta name="robots" content="index, follow">
    <?php require_once "views/user/components/head.php" ?>
    <link rel="canonical" href="https://mcvui.net/">
    <link rel="stylesheet" href="assets/css/user/home/home.css">
    <script src="assets/js/user/home/copyText.js"></script>
</head>
<body>
    <div>
        <?php require_once "views/user/components/navbar.php" ?>
        <div class="bg">
            <div class="main1">
                <img class="main1_logo" src="assets/image/mcvui.png" alt="MCVui Minecraft Server Logo">
                <div class="main1_button">
                    <div class="main1_ipcopier_div">
                        <button class="main1_ipcopier" onclick="copyText('pc.mcvui.net')" type="button">
                            <span class="main1_ipcopier_text1">PC.MCVui.Net</span>
                            <br>
                            <span class="main1_ipcopier_text2">Nhấn để sao chép</span>
                        </button>
                    </div>
                    <div class="main1_ipcopier_div">
                        <button class="main1_ipcopier" onclick="copyText('pe.mcvui.net')" type="button">
                            <span class="main1_ipcopier_text1">PE.MCVui.Net</span>
                            <br>
                            <span class="main1_ipcopier_text2">Nhấn để sao chép</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="socialmedia">
                <div>
                    <a target="_blank" href="https://www.facebook.com/play.mcvui.net">
                        <button>
                            <span><img src="assets/image/facebook.png" alt="Facebook Group Icon"></span>
                            <span>Facebook</span>
                        </button>
                    </a>
                </div>
                <div>
                    <a href="#">
                        <button>
                            <span><img src="assets/image/Crafting_Table_JE4_BE3.webp" alt="Crafting Table Minecraft Icon"></span>
                            <span><p><strong><?=$online?></strong> trực tuyến</p></span>
                        </button>
                    </a>
                </div>
                <div>
                    <a target="_blank" href="<?= $discordInviteLink?>">
                        <button>
                            <span><img src="assets/image/Discord-Logo.png" alt="Discord Logo Icon"></span>
                            <span>Discord</span>
                        </button>
                    </a>
                </div>
            </div> 
        </div>
        <?php require_once "views/user/components/footer.php" ?>
    </div>
  </body>
</html>

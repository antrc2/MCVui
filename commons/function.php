<?php
require_once "RCon.php";
require_once "MinecraftPingException.php";
require_once "MinecraftPing.php";

use Thedudeguy\Rcon;
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;
function getInformationOfNameDatabase($name){
    try {
        $conn = new PDO("mysql:host=localhost;dbname=mcvuinet_admin","mcvuinet_admin","Sqrtfl0@t01");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT * FROM list_of_database WHERE name=:name");
        $stmt->execute([':name' => $name]);
        $result = $stmt->fetch();

        if ($result) {
            $host = $result['host'];
            $dbname = $result['dbname'];
            $user = $result['user'];
            $pass = $result['pass'];

            return new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        } else {
            return false; // Trả về false nếu không tìm thấy cơ sở dữ liệu
        }
    } catch (PDOException $e) {
        return false; // Trả về false nếu có lỗi xảy ra
    }
}

function database($name = "admin"){
    return getInformationOfNameDatabase($name);
}
function SweetAlert2($icon, $message){
    echo "<script src='assets/sweetalert2/sweetalert2.js'></script>";
    echo '<link rel="stylesheet" href="assets/sweetalert2/sweetalert2.css">';
    return '<script>Swal.fire({
        icon: "' . $icon . '",
        text: "' . $message . '",
    });</script>';
}
function getInformationOfRconServer($server){
    try {
        $conn = new PDO("mysql:host=localhost;dbname=mcvuinet_admin","mcvuinet_admin","Sqrtfl0@t01");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT * FROM list_of_rcon WHERE name=:name");
        $stmt->execute([':name' => $server]);
        $result = $stmt->fetch();
        if ($result) {
            $host = $result['host'];
            $port = $result['port'];
            $pass = $result['pass'];
            
            $timeout = 5;
            return new Rcon($host, $port, $pass, $timeout);
        } else {
            return false; // Trả về false nếu không tìm thấy cơ sở dữ liệu
        }
    } catch (PDOException $e) {
        return false; // Trả về false nếu có lỗi xảy ra
    }
}
function rcon($server = "lobby"){
    return getInformationOfRconServer($server);
}
function epochTimeToDateTime($epochTime, $format = "H:i:s d-m-Y"){
    return date($format,$epochTime);
}
function timestampToEpoch($time) {
    // Kiểm tra xem $time có phải là chuỗi rỗng không
    if (empty($time)) {
        return null; // Hoặc một giá trị mặc định nếu cần
    }

    // Nếu không phải chuỗi rỗng, chuyển đổi thành timestamp
    $dateTime = new DateTime($time);
    $expire = $dateTime->getTimestamp();
    return $expire;
}
function epochToTimestamp($epochTime){
    // Kiểm tra nếu $epochTime không phải là số, ép kiểu về số
    if (!is_numeric($epochTime)) {
        $epochTime = (int)$epochTime;
    }

    // Tạo đối tượng DateTime với epoch time
    $dateTime = new DateTime("@$epochTime");
    $dateTime->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
    $expire = $dateTime->format('Y-m-d\TH:i');
    
    return $expire;
}
function serverInfo($host,$port){
    try {
        $ping = new MinecraftPing($host, $port);
        return $ping->Query();
    } catch (\Throwable $th) {
        return "fail";
    }
}
function calculatePointsAfterDiscount($points, $discountPercentage) {
    $bonusAmount = ($discountPercentage / 100) * $points;
    $finalPoints = $points + $bonusAmount;
    return $finalPoints;
}
function convertMinecraftMessageToHTML($message) {
    $colors = array(
        '0' => '#000000', // Black
        '1' => '#0000AA', // Dark Blue
        '2' => '#00AA00', // Dark Green
        '3' => '#00AAAA', // Dark Aqua
        '4' => '#AA0000', // Dark Red
        '5' => '#AA00AA', // Dark Purple
        '6' => '#FFAA00', // Gold
        '7' => '#AAAAAA', // Gray
        '8' => '#555555', // Dark Gray
        '9' => '#5555FF', // Blue
        'a' => '#55FF55', // Green
        'b' => '#55FFFF', // Aqua
        'c' => '#FF5555', // Red
        'd' => '#FF55FF', // Light Purple
        'e' => '#FFFF55', // Yellow
        'f' => '#FFFFFF'  // White
    );

    $patterns = array(
        '/&l(.+?)&r/' => '<span style="font-weight: bold;">$1</span>',
        '/&n(.+?)&r/' => '<span style="text-decoration: underline;">$1</span>',
        '/&o(.+?)&r/' => '<span style="font-style: italic;">$1</span>',
        '/&k(.+?)&r/' => '<span style="text-decoration: obfuscated;">$1</span>',
        '/&m(.+?)&r/' => '<span style="text-decoration: line-through;">$1</span>',
        '/&r(.+?)&r/' => '$1',
        '/&([0-9a-f])/' => function ($matches) use ($colors) {
            return '<span style="color: ' . $colors[$matches[1]] . ';">';
        },
        '/&#([0-9a-fA-F]{6})/' => '<span style="color: #$1;">',
        '/&x&([0-9a-fA-F])&([0-9a-fA-F])&([0-9a-fA-F])&([0-9a-fA-F])&([0-9a-fA-F])&([0-9a-fA-F])/' => '<span style="color: rgba($1$1, $2$2, $3$3, $4$4 / 255);">',
        '/§l(.+?)§r/' => '<span style="font-weight: bold;">$1</span>',
        '/§n(.+?)§r/' => '<span style="text-decoration: underline;">$1</span>',
        '/§o(.+?)§r/' => '<span style="font-style: italic;">$1</span>',
        '/§k(.+?)§r/' => '<span style="text-decoration: obfuscated;">$1</span>',
        '/§m(.+?)§r/' => '<span style="text-decoration: line-through;">$1</span>',
        '/§r(.+?)§r/' => '$1',
        '/§([0-9a-f])/' => function ($matches) use ($colors) {
            return '<span style="color: ' . $colors[$matches[1]] . ';">';
        },
        '/§#([0-9a-fA-F]{6})/' => '<span style="color: #$1;">',
        '/§x§([0-9a-fA-F])§([0-9a-fA-F])§([0-9a-fA-F])§([0-9a-fA-F])§([0-9a-fA-F])§([0-9a-fA-F])/' => '<span style="color: rgba($1$1, $2$2, $3$3, $4$4 / 255);">'
    );

    // Replace patterns
    $html = $message;
    foreach ($patterns as $pattern => $replacement) {
        // Chỉ định rõ hàm callback cho các trường hợp cần thiết
        if (is_callable($replacement)) {
            $html = preg_replace_callback($pattern, $replacement, $html);
        } else {
            $html = preg_replace($pattern, $replacement, $html);
        }
    }

    // Đóng tất cả các thẻ <span> mở
    $html .= '</span>';

    // Trả về kết quả HTML
    return $html;
}
?>

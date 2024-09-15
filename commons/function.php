<?php
require_once "RCon.php";
require_once "MinecraftPingException.php";
require_once "MinecraftPing.php";

use Thedudeguy\Rcon;
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;
function getInformationOfNameDatabase($name){
    try {
        $conn = new PDO("mysql:host=localhost;dbname=mcvui_admin","mcvui_admin","Sqrtfl0@t01");
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
        $conn = new PDO("mysql:host=localhost;dbname=mcvui_admin","mcvui_admin","Sqrtfl0@t01");
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
?>

<?php
require_once "../../../../commons/function.php";

// Kiểm tra nếu yêu cầu là POST
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $json_data = file_get_contents('php://input');
    
    // Giải mã JSON thành mảng PHP
    $data = json_decode($json_data, true);

    // Kiểm tra địa chỉ IP
    if ($data['token'] === "Sqrtfl0@t01bfkskvqfayl0AnChimToAn18cm") {
        $conn = database("lobby");
        $point = intval($data['creditAmount']);
        $point = intval($point/1000);
        if (date("w") == 0){
            $khuyenMai =25;
        } else {
            $khuyenMai = 15;
        }
        $point = calculatePointsAfterDiscount($point,$khuyenMai);
        $eventResult = $conn->prepare("SELECT * FROM donate_event ORDER BY id DESC")->fetch();
		if ($eventResult){
			if ($eventResult['expire'] > time()){
				$event =0;
			} else {
				$event = $eventResult['rate'];
			}
		}
		$point = calculatePointsAfterDiscount($point,$event);
        $conn->prepare("UPDATE donate_history SET point=$point WHERE sign='$sign'")->execute();
		$rcon = rcon();
        $descrtibe = explode(" ", $data['addDescription']);
        $user = $descrtibe[0];
        $rcon = rcon("lobby");

        if ($rcon->connect()){
            
            $rcon->sendCommand("playerpoints:p give {$user} {$point}");
        } else {
            $lobby = database("lobby");
            $sql = "UPDATE playerpoints_points ppp JOIN playerpoints_username_cache puc ON ppp.uuid = puc.uuid SET ppp.points = ppp.points + ? WHERE puc.username = ?";
            $stmt = $lobby->prepare($sql);
            $stmt->bind_param('is', $point, $user);
            if ($stmt->execute()){
                $status = TRUE;
                $msg = "Give {$point} to {$user} success";
            } else {
                $status = FALSE;
                $msg = "Loi ket noi database";
            }
            $response = [
                "status" => $status,
                "message" => $msg
            ];
        }
    } else {
        $response = [
            "status" => false,
            "message" => "Sai token roaiiiii"
        ];
    }
} else {
   $response = [
    "status"=>false,
    "message"=>"Method khong hop le"
   ];
}
echo json_encode($response);
?>

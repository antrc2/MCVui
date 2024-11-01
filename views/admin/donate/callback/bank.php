<?php
require_once "../../../../commons/function.php";
$response = [
    "status" => false,
    "message" => "Không có phản hồi"
];
// Kiểm tra nếu yêu cầu là POST
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $json_data = file_get_contents('php://input');
    
    // Giải mã JSON thành mảng PHP
    $data = json_decode($json_data, true);

    if ($data['token'] === "Sqrtfl0@t01bfkskvqfayl0AnChimToAn18cm") {
        $conn = database("donateHistory");
        $date = $data['transactionDate'];
        $timestamp = strtotime(str_replace('/', '-', $date));
        $point = intval($data['creditAmount']);
        $moneyVND = $point;
        $point = intval($point/1000);
        if (date("w") == 0){
            $khuyenMai = 30;
        } else {
            $khuyenMai = 20;
        }
        $point = calculatePointsAfterDiscount($point,$khuyenMai);
        $eventResult = $conn->query("SELECT * FROM donate_event ORDER BY id DESC")->fetch();
        $event =0;
		if ($eventResult){
			if ($eventResult['expire'] > time()){
				$event =0;
			} else {
				$event = $eventResult['rate'];
			}
		} else {
            $event =0;
        }
		$point = calculatePointsAfterDiscount($point,$event);
        $point = intval($point);
		$rcon = rcon();
        $descrtibe = explode(" ", $data['addDescription']);
        // $user = $descrtibe[0];
        $authme = database("authme");
        $rcon = rcon("lobby");
        $lobby = database("lobby");
        foreach ($descrtibe as $user){
            
            $checkUser = $authme->query("SELECT * FROM authme WHERE realname='$user'")->fetch();
            if ($checkUser !== FALSE){
                
    
                if ($rcon->connect()){
                    
                    $rcon->sendCommand("playerpoints:p give $user $point");
                    $status = TRUE;
                    $msg = "Give {$point} to {$user} success";
                } else {
                    
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
                    
                }
                $time = $timestamp;
                $message = "Chuyển khoản thành công";
                $type =1;
                $conn->prepare("INSERT INTO donate_history(username,money_vnd,date_time, message, type, point) VALUES('$user',$moneyVND,$time, '$message', $type,$point)")->execute();
                $response = [
                    "status" => $status,
                    "message" => $msg
                ];
                break;
            } else {
                $response = [
                    "status" => FALSE,
                    "message" => "Không tìm thấy user"
                ];
            }
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

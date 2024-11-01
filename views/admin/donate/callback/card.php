<?php
	require_once "../../../../commons/function.php";
    if ($_SERVER['REQUEST_METHOD'] === "POST"){
		$conn = database("donateHistory");
		$status = $_POST['status'];
		$serial = $_POST['serial'];
		$code = $_POST['pin'];
		$cardtype = $_POST['card_type'];
		// $moneyVND = $_POST['receive_amount'];
		$sign = $_POST['content'];
		$message = $_POST['noidung'];
		$moneyVND = $_POST['real_amount'];
		$point = intval(intval($_POST['receive_amount'])/1000);
		
		if ($status === "thanhcong"){
			$status =1;
		} elseif ($status === "saimenhgia"){
			$status =2;
		} else {
			$status =3;
		}
		$result = $conn->query("SELECT * FROM donate_history WHERE sign='$sign'")->fetch();
		$conn->prepare("UPDATE donate_history SET status=$status,serial='$serial',code='$code',card_type ='$cardtype',money_vnd = $moneyVND, message='$message' WHERE sign = '$sign'")->execute();
		if (date("w") == 0){
            $khuyenMai =10;
        } else {
            $khuyenMai = 0;
        }
		$point = calculatePointsAfterDiscount($point,$khuyenMai);
		$eventResult = $conn->prepare("SELECT * FROM donate_event ORDER BY id DESC")->fetch();
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
		$conn->prepare("UPDATE donate_history SET point=$point WHERE sign='$sign'")->execute();
		$rcon = rcon();
		if ($rcon->connect()){
			$username = $result['username'];
			$rcon->sendCommand("playerpoints:p give $username $point");
		} else {
			$lobby = database("lobby");
            $sql = "UPDATE playerpoints_points ppp JOIN playerpoints_username_cache puc ON ppp.uuid = puc.uuid SET ppp.points = ppp.points + ? WHERE puc.username = ?";
            $stmt = $lobby->prepare($sql);
            $stmt->bind_param('is', $point, $user);
			$stmt->execute();
		}
	} else {
		echo "a";
	}
?>
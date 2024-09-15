<?php
    class donateModel{
        public $donate;
        function __construct()
        {
            $this->donate = database("donateHistory");
        }
        function getQRCode($content){
            return "https://img.vietqr.io/image/MB-3210130112005-qr_only.png?addInfo=$content";
        }
        function sendCard($code,$serial,$cardType,$cardAmount){
            $content = md5(time() . rand(0, 999999).microtime(true));
            $apikey = "2B513E3FD79CD19BC3084655EF6ABDCB";
            $url = "https://thesieutoc.net/chargingws/v2?APIkey=".$apikey."&mathe=".$code."&seri=".$serial."&type=".$cardType."&menhgia=".$cardAmount."&content=".$content;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch,CURLOPT_CAINFO, __DIR__ .'/curl-ca-bundle.crt');
		    // curl_setopt($ch,CURLOPT_CAPATH, __DIR__ .'/curl-ca-bundle.crt');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = json_decode(curl_exec($ch));
            $username = $_SESSION['username'];
            $time = time();
            $status = $response->status;
            $message = $response->msg;
            $stmt = $this->donate->prepare("INSERT INTO donate_history (username, type, date_time, status, card_amount, message, code, serial, sign, card_type) VALUES (:username, :type, :date_time, :status, :card_amount, :message, :code, :serial, :sign, :card_type)");
            $type = 'card';
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':date_time', $time);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':card_amount', $cardAmount);
            $stmt->bindParam(':message', $message);
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':serial', $serial);
            $stmt->bindParam(':sign', $content);
            $stmt->bindParam(':card_type', $cardType);
            if ($response->status === "00"){
                $stmt->execute();
            }
            return $response;
        }
        function getCardDonateHistory(){
            return $this->donate->query("SELECT * FROM donate_history WHERE type=0")->fetchAll();
        }
        function getBankDonateHistory(){
            return $this->donate->query("SELECT * FROM donate_history WHERE type=1")->fetchAll();
        }
        function getDonateHistoryByUsername($username){
            return $this->donate->query("SELECT * FROM donate_history WHERE username = '$username'")->fetchAll();
        }
        function getLastestEvent(){
            return $this->donate->query("SELECT * FROM donate_event ORDER BY id DESC")->fetch();
        }
        function getListEvent(){
            return $this->donate->query("SELECT * FROM donate_event ORDER BY id DESC")->fetchAll();
        }
        function addEvent($expire,$rate){
            return $this->donate->prepare("INSERT INTO donate_event VALUES(NULL,$expire,$rate)")->execute();
        }
        function getInformationOfEvent($id){
            return $this->donate->query("SELECT * FROM donate_event WHERE id=$id")->fetch();
        }
        function updateEvent($id, $expire, $rate){
            return $this->donate->prepare("UPDATE donate_event SET expire=$expire,rate=$rate WHERE id=$id")->execute();
        }
        function deleteEvent($id){
            return $this->donate->prepare("DELETE FROM donate_event WHERE id=$id")->execute();
        }
        function getDonateHistory($username = null, $fromDateTime = null, $toDateTime = null, $serial = null, $code = null, $type = null) {
            // Xây dựng câu truy vấn cơ bản
            $query = "SELECT * FROM donate_history WHERE 1=1";
            
            // Thêm các điều kiện nếu các tham số có giá trị hợp lệ
            if (!empty($username)) {
                $query .= " AND username = :username";
            }
            if (!is_null($fromDateTime)) {
                $query .= " AND date_time >= :fromDateTime";
            }
            if (!is_null($toDateTime)) {
                $query .= " AND date_time <= :toDateTime";
            }
            if (!empty($serial)) {
                $query .= " AND serial = :serial";
            }
            if (!empty($code)) {
                $query .= " AND code = :code";
            }
            if ($type === "0" || $type === "1") {
                $query .= " AND type = :type";
            }
            
            // Thêm phần sắp xếp
            $query .= " ORDER BY id DESC";
            
            // Chuẩn bị truy vấn
            $stmt = $this->donate->prepare($query);
            
            // Gán giá trị cho các tham số nếu có
            if (!empty($username)) {
                $stmt->bindParam(':username', $username);
            }
            if (!is_null($fromDateTime)) {
                $stmt->bindParam(':fromDateTime', $fromDateTime);
            }
            if (!is_null($toDateTime)) {
                $stmt->bindParam(':toDateTime', $toDateTime);
            }
            if (!empty($serial)) {
                $stmt->bindParam(':serial', $serial);
            }
            if (!empty($code)) {
                $stmt->bindParam(':code', $code);
            }
            if ($type === "0" || $type === "1") {
                $type = intval($type);
                $stmt->bindParam(':type', $type);
            }
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        
        
        
    }
?>
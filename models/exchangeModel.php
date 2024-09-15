<?php
    class exchangeModel{
        public $lobby;
        public $admin;
        function __construct(){
            $this->lobby = database("lobby");
            $this->admin = database("admin");
            $this->rcon = rcon("lobby");
        }
        function getPointByUsername($username,$server = "lobby"){
            return $this->lobby->query("SELECT * FROM playerpoints_points JOIN playerpoints_username_cache ON playerpoints_points.uuid = playerpoints_username_cache.uuid WHERE username='$username'")->fetch();
        }      
        function getListServerToExchange(){
            return $this->lobby->query("SELECT * FROM chuyenxu_server")->fetchAll();
        }
        function getExchangeHistory($player = null, $fromTime = null, $toTime = null, $server = null, $fromPoints = 0, $toPoints = 0) {
            // Xây dựng câu truy vấn cơ bản
            $query = "SELECT * FROM chuyenxu_history JOIN chuyenxu_server ON chuyenxu_history.server = chuyenxu_server.server_value WHERE 1=1";
            
            // Thêm các điều kiện nếu các tham số có giá trị hợp lệ
            if (!empty($player)) {
                $query .= " AND player = :player";
            }
            if (!is_null($fromTime)) {
                $query .= " AND time >= :fromTime";
            }
            if (!is_null($toTime)) {
                $query .= " AND time <= :toTime";
            }
            if (!empty($server)) {
                $query .= " AND server = :server";
            }
            if ($fromPoints > 0) {
                $query .= " AND amount >= :fromPoints";
            }
            if ($toPoints > 0) {
                $query .= " AND amount <= :toPoints";
            }
            
            // Thêm phần sắp xếp (tùy chọn, ở đây sắp xếp theo `time` giảm dần)
            $query .= " ORDER BY time DESC";
            
            // Chuẩn bị truy vấn
            $stmt = $this->lobby->prepare($query);
            
            // Gán giá trị cho các tham số nếu có
            if (!empty($player)) {
                $stmt->bindParam(':player', $player);
            }
            if (!is_null($fromTime)) {
                $stmt->bindParam(':fromTime', $fromTime);
            }
            if (!is_null($toTime)) {
                $stmt->bindParam(':toTime', $toTime);
            }
            if (!empty($server)) {
                $stmt->bindParam(':server', $server);
            }
            if ($fromPoints > 0) {
                $stmt->bindParam(':fromPoints', $fromPoints, PDO::PARAM_INT);
            }
            if ($toPoints > 0) {
                $stmt->bindParam(':toPoints', $toPoints, PDO::PARAM_INT);
            }
            
            // Thực thi câu truy vấn
            $stmt->execute();
            
            // Lấy kết quả
            $result = $stmt->fetchAll();
            return $result;
        }
        function exchangeForUsername($username,$points,$server){
            if ($this->rcon->connect()){
                
                $this->rcon->sendCommand("cxadmin chuyenxu {$username} {$server} {$points}");
                // $this->rcon->sendCommand("playerpoints:p take {$username} {$points}");
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
?>
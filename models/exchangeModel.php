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
            $db = database($server);
            return $db->query("SELECT * FROM playerpoints_points JOIN playerpoints_username_cache ON playerpoints_points.uuid = playerpoints_username_cache.uuid WHERE username='$username'")->fetch();
        }
        function exchangeForUsername($username,$points,$server){
            if ($this->rcon->connect()){
                
                $result = $this->rcon->sendCommand("cxadmin chuyenxu {$username} {$server} {$points}");
                // echo $result;
                $html = convertMinecraftMessageToHTML($result);
                return ['message' => $html];
                // return TRUE;
            } else {
                return FALSE;
            }
        }
        function takePointFromServer($username, $amount, $server) {
            // Lệnh SQL để trừ điểm
            $sql = "UPDATE playerpoints_points JOIN playerpoints_username_cache ON playerpoints_points.uuid = playerpoints_username_cache.uuid SET playerpoints_points.points = playerpoints_points.points - :amount WHERE playerpoints_username_cache.username = :username AND playerpoints_points.points >= :amount";
            
            // Kết nối tới database của server
            $dbServer = database($server);
            
            // Chuẩn bị truy vấn
            $stmt = $dbServer->prepare($sql);
            
            // Gán giá trị cho các tham số truy vấn
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':amount', $amount);
            
            // Thực thi truy vấn
            return $stmt->execute();
        }
        function givePointFromServer($username, $amount, $server) {
            // Lệnh SQL để cộng điểm
            $sql = "UPDATE playerpoints_points JOIN playerpoints_username_cache ON playerpoints_points.uuid = playerpoints_username_cache.uuid SET playerpoints_points.points = playerpoints_points.points + :amount WHERE playerpoints_username_cache.username = :username";
            
            // Kết nối tới database của server
            $dbServer = database($server);
            
            // Chuẩn bị truy vấn
            $stmt = $dbServer->prepare($sql);
            
            // Gán giá trị cho các tham số truy vấn
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':amount', $amount);
            
            // Thực thi truy vấn
            return $stmt->execute();
        }
        function getOneServerToExchange($serverValue){
            return $this->lobby->query("SELECT * FROM chuyenxu_server WHERE server_value = '$serverValue'")->fetch();
        }
        function getExchangeHistory($player = null, $fromTime = null, $toTime = null, $server = null, $fromPoints = 0, $toPoints = 0) {
            // Xây dựng câu truy vấn cơ bản
            $query = "SELECT * FROM chuyenxu_history JOIN chuyenxu_server ON chuyenxu_history.server = chuyenxu_server.server_value WHERE 1=1";
            
            // Thêm các điều kiện nếu các tham số có giá trị hợp lệ
            if (!empty($player)) {
                $query .= " AND player = :player";
            }
            if (!is_null($fromTime)) {
                $fromTime *= 1000; // Nhân với 1000
                $query .= " AND time >= :fromTime";
            }
            if (!is_null($toTime)) {
                $toTime *= 1000; // Nhân với 1000
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
                $stmt->bindParam(':fromTime', $fromTime, PDO::PARAM_INT);
            }
            if (!is_null($toTime)) {
                $stmt->bindParam(':toTime', $toTime, PDO::PARAM_INT);
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
        function addExchangeHistory($username, $point, $server) {
            // Lấy exchange history
            $exchangeHistoryData = $this->getExchangeHistory($username);
            
            // Kiểm tra xem có dữ liệu không
            if (!empty($exchangeHistoryData)) {
                // Nếu có dữ liệu, lấy transaction_id
                $exchangeHistory = $exchangeHistoryData[0]['transaction_id'];
        
                // Sử dụng biểu thức chính quy để lấy số trước ký tự 'r'
                preg_match('/(\d+)r$/', $exchangeHistory, $matches);
                
                // Kiểm tra nếu có kết quả khớp
                if (!empty($matches)) {
                    $number = $matches[1]; // Lấy số đã tìm thấy
                } else {
                    $number = 0; // Nếu không tìm thấy số
                }
            } else {
                // Nếu không có dữ liệu, gán $number = 0
                $number = 0;
            }
        
            // Lấy uuid từ username
            $uuid = $this->getPointByUsername($username)['uuid'];
            $time = time();
            $formattedTime = date('H', $time) . 'h' . date('i', $time) . 'm' . date('s', $time) . 's';

            // Định dạng ngày tháng thành ngày, tháng, năm
            $formattedDate = date('d', $time) . 'd' . date('m', $time) . 'm' . date('Y', $time) . 'y';

            // Giả sử bạn có một biến $amount để lưu số điểm
            $number++;

            // Tạo transaction_id theo định dạng yêu cầu
            $transactionId = "{$uuid}_{$formattedTime}_{$formattedDate}_{$number}r";
            $time = $time*1000;
            return $this->lobby->prepare("INSERT INTO chuyenxu_history VALUES('$transactionId', '$uuid', '$username', '$server', $point, $time)")->execute();
        }
        
        function processExchange($username, $points, $server, $serverName) {
            $result = $this->givePointFromServer($username, $points, $server);
            
            if ($result) {
                $this->addExchangeHistory($username, $points, $server);
                return ['status' => "success", "msg" => "Đổi $points đến $serverName thành công"];
            } else {
                return ['status' => "error", "msg" => "Bạn không đủ xu để đổi"];
            }
        }
        // function exchangeTypeServer($username, $points, $server){
        //     if ($this->rcon->connect()){
        //         $response = $this->rcon->sendCommand("cxadmin chuyenxu ${username} ${server} ${points}")
        //     }
            
        // }
        function exchange($username, $points, $server) {
            $serverName = $this->getOneServerToExchange($server)['server_name'];
        
            // Kiểm tra xem người dùng có điểm không
            if (!$this->getPointByUsername($username, $server)) {
                return ['status' => "error", "msg" => "Không tìm thấy thông tin của $username ở máy chủ $serverName"];
            }
        
            // Kiểm tra kết nối với server
            if ($this->rcon->connect()) {
                // Gửi lệnh lấy điểm từ server
                $responseFromServer = $this->rcon->sendCommand("playerpoints:p take $username $points");
        
                // Nếu thành công, xử lý đổi điểm
                if ($responseFromServer) {
                    return $this->processExchange($username, $points, $server, $serverName);
                }
            } else {
                // Nếu không kết nối được đến server, xử lý điểm ở lobby
                $this->takePointFromServer($username, $points, "lobby");
                return $this->processExchange($username, $points, $server, $serverName);
            }
        
            // Nếu không thực hiện được lệnh, trả về thông báo lỗi
            return ['status' => "error", "msg" => "Không thể kết nối đến server"];
        }
        function getListServerToExchange(){
            return $this->lobby->query("SELECT * FROM chuyenxu_server")->fetchAll();
        }
        function getListServer(){
            return $this->lobby->query("SELECT * FROM chuyenxu_server")->fetchAll();
        }
        
        
        
        function addServer($serverValue, $serverName){
            return $this->lobby->prepare("INSERT INTO chuyenxu_server VALUES(NULL, '$serverValue','$serverName')")->execute();
        }
        function getOneServerById($id){
            return $this->lobby->query("SELECT * FROM chuyenxu_server WHERE id=$id")->fetch();
        }
        function updateServer($id,$serverValue, $serverName){
            return $this->lobby->prepare("UPDATE chuyenxu_server SET server_value='$serverValue', server_name='$serverName' WHERE id=$id")->execute();
        }
        function deleteServer($id){
            return $this->lobby->prepare("DELETE FROM chuyenxu_server WHERE id=$id")->execute();
        }
    }
?>
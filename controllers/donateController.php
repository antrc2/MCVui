<?php
    class donateController{
        public $donate;
        function __construct()
        {
            $this->donate = new donateModel;
        }
        function donate(){
            $qrCodeStatus = FALSE;
            $qrCode = "";
            $event = $this->donate->getLastestEvent();
            if ($_SERVER['REQUEST_METHOD'] === "POST"){
                if (isset($_SESSION['username'])){
                    if (isset($_POST['btn_sendCard'])){
                        $cardType = $_POST['card_type'];
                        $cardAmount = $_POST['card_amount'];
                        $serial = $_POST['serial'];
                        $code = $_POST['code'];
                        $result = $this->donate->sendCard($code,$serial,$cardType,$cardAmount);
                        if ($result->status === "00"){
                            require_once "views/user/donate/donate.php";
                            echo SweetAlert2("success", $result->msg);
                            exit;
                        } else {
                            require_once "views/user/donate/donate.php";
                            echo SweetAlert2("error", $result->msg);
                            exit;
                        }
                    } elseif (isset($_POST['btn_getQR'])){
                        $content= $_SESSION['username'];
                        $qrCode = $this->donate->getQRCode($content);
                        $qrCodeStatus = TRUE;
                    }
                } else {
                    header("Location: /login");
                }
            }
            require_once "views/user/donate/donate.php";
        }
        function donateHistory(){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $acc = new accountModel;
                $role = $acc->getInformationOfUser($_SESSION['username']);
                if ($role['name'] === "admin" || $role['name'] === "owner"){
                    if (isset($_POST['btn_filter'])){
                        $username = trim($_POST['username']);
                        $fromDateTime = $_POST['from_date_time'];
                        $fDateTime = $fromDateTime;
                        $fromDateTime = timestampToEpoch($fromDateTime);
                        $toDateTime = $_POST['to_date_time'];
                        $tDateTime = $toDateTime;
                        $toDateTime = timestampToEpoch($toDateTime);
                        $serial = trim($_POST['serial']);
                        $code = trim($_POST['code']);
                        $type = $_POST['type'];
                        $donateHistories = $this->donate->getDonateHistory($username,$fromDateTime,$toDateTime,$serial,$code,$type);
                    } else {
                        $donateHistories = $this->donate->getDonateHistory();
                    }
                    require_once "views/admin/donate/donateHistory.php";
                } else {
                    header("Location: /forbidden");
                }
            }
            
        }
        function listEvent(){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $acc = new accountModel;
                $role = $acc->getInformationOfUser($_SESSION['username']);
                if ($role['name'] === "owner"){
                    $events = $this->donate->getListEvent();
                    require_once "views/admin/donate/listEvent.php";
                } else {
                    header("Location: /forbidden");
                }
            }
        }
        function addEvent(){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $acc = new accountModel;
                $role = $acc->getInformationOfUser($_SESSION['username']);
                if ($role['name'] === "owner"){
                    if (isset($_POST['btn_addEvent'])){
                        $time = $_POST['expire'];
                        $rate = $_POST['rate'];
                        $expire = timestampToEpoch($time);
                        if ($this->donate->addEvent($expire,$rate)){
                            header("Location: /list-event");
                        } else {
                            echo "Lỗi";
                        }
                    }
                    require_once "views/admin/donate/addEvent.php";
                } else {
                    header("Location: /forbidden");
                }
            }
        }
        function updateEvent($id){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $acc = new accountModel;
                $role = $acc->getInformationOfUser($_SESSION['username']);
                if ($role['name'] === "owner"){
                    $event = $this->donate->getInformationOfEvent($id);
                    $rate = $event['rate'];
                    $expire = epochToTimestamp($event['expire']);
                    if (isset($_POST['btn_updateEvent'])){
                        $time = $_POST['expire'];
                        $rate = $_POST['rate'];
                        $dateTime = new DateTime($time);
                        $expire = $dateTime->getTimestamp();
                        if ($this->donate->updateEvent($id, $expire, $rate)){
                            header("Location: /list-event");
                        } else {
                            echo "Lỗi";
                        }
                    }
                    require_once "views/admin/donate/updateEvent.php";
                } else {
                    header("Location: /forbidden");
                }
            }
        }
        function deleteEvent($id) {
            // Kiểm tra nếu người dùng chưa đăng nhập
            if (!isset($_SESSION['username'])) {
                header("Location: /login");
            }
            
            // Khởi tạo đối tượng và lấy thông tin người dùng
            $acc = new accountModel;
            $role = $acc->getInformationOfUser($_SESSION['username']);
            
            // Kiểm tra quyền của người dùng
            if ($role['name'] !== "owner" && $role['name'] !== "admin") {
                header("Location: /forbidden");
            }
            
            // Khởi tạo đối tượng để quản lý sự kiện
            $event = $this->donate->getInformationOfEvent($id);
            
            // Kiểm tra nếu sự kiện không tồn tại
            if (empty($event)) {
                $message = "Không tìm thấy sự kiện";
                require_once "views/admin/donate/deleteEvent.php";
            }
            
            // Xóa sự kiện nếu có quyền
            if ($this->donate->deleteEvent($id)) {
                header("Location: /list-event"); // Chuyển hướng đến danh sách sự kiện sau khi xóa thành công
            } else {
                $message = "Lỗi khi xóa sự kiện";
                require_once "views/admin/donate/deleteEvent.php";
            }
        }
        
        
    }
?>
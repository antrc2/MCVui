<?php
    class exchangeController{
        public $exchange;
        function __construct(){
            $this->exchange = new exchangeModel;
        }
        // function exchange(){
        //     if (!isset($_SESSION['username'])){
        //         header("Location: /login");
        //     } else {
        //         $point = ($this->exchange->getPointByUsername($_SESSION['username']))['points'];
        //         $servers = $this->exchange->getListServerToExchange();
                
        //         if (isset($_POST['btn_exchange'])){
        //             $server = $_POST['server'];
        //             $points = $_POST['points'];
        //             if ($points <= $point){
                        
        //                 $result = $this->exchange->exchangeForUsername($_SESSION['username'],$points,$server);
        //                 if ($result){ 
        //                     foreach ($servers as $value){
        //                         if ($server = $value['server_value']){
        //                             $serverName = $value['server_name'];
        //                             break;
        //                         }
        //                     }
        //                     // $point = ($this->exchange->getPointByUsername($_SESSION['username']))['points'];
        //                     $point = $point - $points;
        //                     require_once "views/user/exchange/exchange.php";
        //                     echo SweetAlert2("success",$result);
        //                 } else {
        //                     require_once "views/user/exchange/exchange.php";
        //                     echo SweetAlert2("error","Mất kết nối đến máy chủ {$serverName}");
        //                 }
        //             } else {
        //                 require_once "views/user/exchange/exchange.php";
        //                 echo SweetAlert2("error","Không đủ xu");
        //             }
        //         } else {
        //             require_once "views/user/exchange/exchange.php";
        //         }
        //     }
            
        // }
        function exchange(){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $point = ($this->exchange->getPointByUsername($_SESSION['username']))['points'];
                $servers = $this->exchange->getListServerToExchange();
                if (isset($_POST['btn_exchange'])){
                    $server = $_POST['server'];
                    $points = $_POST['points'];
                    if ($points > $point){
                        $msg = "Không đủ xu";
                        $status = "error";
                    } else {
                        $result = $this->exchange->exchange($_SESSION['username'], $points, $server);
                        $msg = $result['msg'];
                        $status = $result['status'];
                        if ($status){
                            $point = $point - $points;
                        }
                        
                    }
                    require_once "views/user/exchange/exchange.php";
                    echo SweetAlert2($status,$msg);
                }
                require_once "views/user/exchange/exchange.php";
            }
        }
        function exchangeHistory(){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $acc = new accountModel;
                $role = $acc->getInformationOfUser($_SESSION['username']);
                if ($role['name'] === "admin" || $role['name'] === "owner"){
                    $servers = $this->exchange->getListServerToExchange();
                    if (isset($_POST['btn_searchExchangeHistory'])) {
                        $username = trim($_POST['username']);
                        $fromDateTime = $_POST['from_date_time'];
                        $fDateTime = $fromDateTime;
                        $fromDateTime = timestampToEpoch($fromDateTime);
                        $toDateTime = $_POST['to_date_time'];
                        $tDateTime = $toDateTime;
                        $toDateTime = timestampToEpoch($toDateTime);
                        $fromPoints = $_POST['from_points'];
                        $toPoints = $_POST['to_points'];
                        $server = $_POST['server'];
                        $exchangeHistories = $this->exchange->getExchangeHistory($username, $fromDateTime, $toDateTime,$server, $fromPoints, $toPoints);
                    } else {
                        $exchangeHistories = $this->exchange->getExchangeHistory();
                    }
                    require_once "views/admin/exchange/exchangeHistory.php";
                } else {
                    header("Location: /forbidden");
                }
            }
        }
        function listServer(){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $acc = new accountModel;
                $role = $acc->getInformationOfUser($_SESSION['username']);
                if ($role['name'] === "owner"){
                    $servers = $this->exchange->getListServer();
                    require_once "views/admin/server/listServer.php";
                } else {
                    header("Location: /forbidden");
                }
            }
        }
        function addServer(){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $acc = new accountModel;
                $role = $acc->getInformationOfUser($_SESSION['username']);
                if ($role['name'] === "owner"){
                    if (isset($_POST['btn_addServer'])){
                        $serverValue = $_POST['serverValue'];
                        $serverName = $_POST['serverName'];
                        $result = $this->exchange->addServer($serverValue, $serverName);
                        var_dump($result);
                        if ($result){
                            header("Location: /servers");
                        } else {
                            echo "Lỗi";
                        }
                    } else {
                        require_once "views/admin/server/addServer.php";
                    }
                    
                } else {
                    header("Location: /forbidden");
                }
            }
        }
        function updateServer($id){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $acc = new accountModel;
                $role = $acc->getInformationOfUser($_SESSION['username']);
                if ($role['name'] === "owner"){
                    if (isset($_POST['btn_updateServer'])){
                        $serverValue = $_POST['serverValue'];
                        $serverName = $_POST['serverName'];
                        $result = $this->exchange->updateServer($id,$serverValue, $serverName);
                        if ($result){
                            header("Location: /servers");
                        } else {
                            echo "Lỗi";
                        }
                    } else {
                        $oneServer = $this->exchange->getOneServerById($id);
                        require_once "views/admin/server/updateServer.php";
                    }
                    
                } else {
                    header("Location: /forbidden");
                }
            }
        }
        function deleteServer($id){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $acc = new accountModel;
                $role = $acc->getInformationOfUser($_SESSION['username']);
                if ($role['name'] === "owner"){
                    $result = $this->exchange->deleteServer($id);
                    if ($result){
                        header("Location: /servers");
                    } else {
                        echo "Lỗi";
                    }
                } else {
                    header("Location: /forbidden");
                }
            }
        }
    }
?>
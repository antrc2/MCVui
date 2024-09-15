<?php
    class exchangeController{
        public $exchange;
        function __construct(){
            $this->exchange = new exchangeModel;
        }
        function exchange(){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $point = ($this->exchange->getPointByUsername($_SESSION['username']))['points'];
                $servers = $this->exchange->getListServerToExchange();
                $exchangeHistorybyUsername = $this->exchange->getExchangeHistory($_SESSION['username']);
                
                if (isset($_POST['btn_exchange'])){
                    $server = $_POST['server'];
                    $points = $_POST['points'];
                    if ($points <= $point){
                        
                        $result = $this->exchange->exchangeForUsername($_SESSION['username'],$points,$server);
                        if ($result){ 
                            // $point = ($this->exchange->getPointByUsername($_SESSION['username']))['points'];
                            $point = $point - $points;
                            require_once "views/user/exchange/exchange.php";
                            echo SweetAlert2("success","Chuyển {$points} đến máy chủ {$server} thành công");
                        } else {
                            require_once "views/user/exchange/exchange.php";
                            echo SweetAlert2("error","Mất kết nối đến máy chủ {$server}");
                        }
                    } else {
                        require_once "views/user/exchange/exchange.php";
                        echo SweetAlert2("error","Không đủ xu");
                    }
                } else {
                    require_once "views/user/exchange/exchange.php";
                }
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
    }
?>
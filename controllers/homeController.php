<?php
    class homeController{
        public $home;
        function __construct(){
            $this->home = new homeModel;
        }
        function home(){
            $server = $this->home->getInformationOfServer("mcvui.net");
            // $server = "fail";
            if($server === "fail" || $server === false){
                $classStatus = "offline";
                $status = "Ngoại tuyến";
                $online = 0;
            } else {
                
                $classStatus = "online";
                $status = "Trực tuyến";
                $online = $server['players']['online'];
            }
            require_once "views/user/home/home.php";
        }
    }
?>
<?php
    class homeModel{
        public $home;
        function __construct(){
            $this->home = database("home");
        }
        function getInformationOfServer($ip,$port = 25565){
            return serverInfo($ip,$port);
        }
    }
?>
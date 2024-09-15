<?php
    class dashboardController{
        public $dashboard;
        function __construct(){
            $this->dashboard = new dashboardModel;
        }
        function dashboard(){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $acc = new accountModel;
                $role = $acc->getInformationOfUser($_SESSION['username']);
                if ($role['name'] === "admin" || $role['name'] === "owner"){
                    require_once "views/admin/dashboard/dashboard.php";
                } else {
                    header("Location: /forbidden");
                }
            }
            
        }
    }
?>
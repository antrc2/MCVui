<?php
    class dashboardModel{
        public $dashboard;
        function __construct(){
            $this->dashboard = database("admin");
        }
    }
?>
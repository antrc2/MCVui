<?php
    class errorController{
        public $error;
        function __construct()
        {
            $this->error = new errorModel;
        }
        function notFound(){
            http_response_code(404);
            require_once "views/user/error/404.php";
        }
        function forbidden(){
            http_response_code(403);
            require_once  "views/user/error/403.php";
        }
    }
?>
<?php
    class errorModel{
        public $error;
        function __construct()
        {
            $this->error = database();
        }
    }
?>
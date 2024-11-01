<?php
    class accountController{
        public $acc;
        function __construct(){
            $this->acc = new accountModel;
        }
        function login(){
            if (isset($_SESSION['username'])){
                header("Location: /");
            } else {
                if (isset($_POST['btn_login'])){
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $result = $this->acc->login($username,$password);
                    if ($result['status']){
                        $_SESSION['username'] = $username;
                        header("Location: /");
                    } else {
                        require_once "views/account/login.php";
                        echo SweetAlert2("error",$result['message']);
                        exit();
                    }
                }
                require_once "views/account/login.php";
            }
        }
        function register(){
            if (isset($_POST['btn_register'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $rePassword = $_POST['rePassword'];
                if ($password !== $rePassword){
                    require_once "views/account/register.php";
                    echo SweetAlert2("error","Mật khẩu không trùng khớp");
                } else {
                    $result = $this->acc->register($username,$email,$password);
                    if ($result['status']){
                        $_SESSION['username'] = $username;
                        header("Location: /");
                    } else {
                        require_once "views/account/register.php";
                        echo SweetAlert2("error",$result['message']);
                        exit();
                    }
                }
            }
            require_once "views/account/register.php";
        }
        function logout(){
            if ($this->acc->logout()){
                header("Location: /");
            } else {
                header("Location: /login");
            }
        }
        function account(){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $acc = new accountModel;
                $role = $acc->getInformationOfUser($_SESSION['username']);
                if ($role['name'] === "owner"){
                    
                    if (isset($_POST['btn_searchUsername'])){
                        $username = trim($_POST['username']);
                        if ($username == ""){
                            $accounts = $this->acc->getAllInformationOfUser();
                        } else {
                            $accounts = $this->acc->getAllInformationOfUser($username);
                        }
                        
                    } else {
                        $accounts = $this->acc->getAllInformationOfUser();
                    }
                    require_once "views/admin/account/account.php";
                } else {
                    header("Location: /forbidden");
                }
            }
            
        }
        function updateAccount($username){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $acc = new accountModel;
                $role = $acc->getInformationOfUser($_SESSION['username']);
                if ($role['name'] === "admin" || $role['name'] === "owner"){
                    $account = $this->acc->getInformationOfUser($username);
                    $roles = $this->acc->getAllRole();
                    if (!empty($account)){
                        $status = TRUE;
                    } else {
                        $status = FALSE;
                    }
                    if (isset($_POST['btn_updateAccount'])){
                        $role = $_POST['role'];
                        $password = $_POST['password'];
                        $result = $this->acc->updateAccount($username,$role,$password);
                        if ($result){
                            header("Location: /account");
                        } else {
                            echo "Lỗi";
                        }
                    }
                    require_once "views/admin/account/updateAccount.php";
                } else {
                    header("Location: /forbidden");
                }
            }
            
        }
        function deleteAccount($username) {
            if (!isset($_SESSION['username'])) {
                header("Location: /login");  
            }
            $acc = new accountModel;
            $currentUser = $acc->getInformationOfUser($_SESSION['username']);
            if ($currentUser['name'] !== "owner") {
                header("Location: /forbidden");
            }
            $actor = $acc->getInformationOfUser($username);
            if (empty($actor)) {
                $message = "Không tìm thấy người chơi";
                require_once "views/admin/account/deleteAccount.php";
               
            }
            
            // Xóa tài khoản nếu có quyền
            if ($currentUser['name'] === "owner" || $currentUser['name'] === "admin") {
                if ($acc->deleteAccount($username)) {
                    header("Location: /account");
                    
                } else {
                    echo "Lỗi";
                   
                }
            } else {
                header("Location: /forbidden");
            
            }
        }
        
        function profile(){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                $informationOfUser = $this->acc->getInformationOfUser($_SESSION['username']);
                $donate = new donateModel;
                $donateHistories = $donate->getDonateHistoryByUsername($_SESSION['username']);
                $exchange = new exchangeModel;
                $exchangeHistories = $exchange->getExchangeHistory($_SESSION['username']);
                require_once "views/user/account/profile.php";
            }
        }
        function changePassword(){
            if (!isset($_SESSION['username'])){
                header("Location: /login");
            } else {
                if (isset($_POST['btn_changePassword'])){
                    $oldPassword = $_POST['oldPassword'];
                    $newPassword = $_POST['newPassword'];
                    $reNewPassword = $_POST['reNewPassword'];
                    if ($newPassword !== $reNewPassword){
                        require_once "views/user/account/changePassword.php";
                        echo SweetAlert2("error","Mật khẩu không trùng khớp");
                    } else {
                        $account = $this->acc->getInformationOfUser($_SESSION['username']);
                        $checkedPassword = $this->acc->comparePassword($oldPassword,$account['password']);
                        if ($checkedPassword){
                            $changePassword = $this->acc->changePassword($_SESSION['username'],$newPassword);
                            if ($changePassword){
                                require_once "views/user/account/changePassword.php";
                                echo SweetAlert2("success","Đổi mật khẩu thành công");
                            }
                        } else {
                            require_once "views/user/account/changePassword.php";
                            echo SweetAlert2("error","Sai mật khẩu");
                        }
                    }
                }
                require_once "views/user/account/changePassword.php";
            }
        }
    }
?>
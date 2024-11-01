<?php
    class accountModel{
        public $acc;
        function __construct(){
            $this->acc = database("authme");
        }
        function computeHash($password, $salt ){
            // Băm mật khẩu bằng SHA-256
            $firstHash = hash('sha256', $password);
            
            // Nối kết quả băm với muối
            $combined = $firstHash . $salt;
            
            // Băm kết quả kết hợp với muối bằng SHA-256 lần nữa
            $secondHash = hash('sha256', $combined);
            
            // Định dạng kết quả cuối cùng
            $finalHash = "\$SHA\$" . $salt . "$" . $secondHash;
            
            return $finalHash;
        }
        
        //Kiểm tra mật khẩu
        function comparePassword($password, $hashedPassword) {
            $parts = explode('$', $hashedPassword);
            if (count($parts) === 4) {
                $salt = $parts[2];
                $computedHash = $this->computeHash($password, $salt);
                return hash_equals($hashedPassword, $computedHash);
            }
            return false;
        }
        function getInformationOfUser($username) {
            $user = strtolower($username);
            $stmt = $this->acc->prepare("SELECT * FROM authme JOIN role ON authme.role = role.id WHERE username = :username");
            $stmt->bindParam(':username', $user, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }
        
        function getAllRole() {
            $stmt = $this->acc->query("SELECT * FROM role");
            return $stmt->fetchAll();
        }
        
        function getAllInformationOfUser($username = "") {
            if ($username == ""){
                $stmt = $this->acc->query("SELECT * FROM authme JOIN role ON authme.role = role.id ORDER BY realname ASC");
                return $stmt->fetchAll();
            } else {
                return $this->acc->query("SELECT * FROM authme JOIN role ON authme.role = role.id WHERE realname LIKE '%$username%' ORDER BY realname ASC")->fetchAll();
            }
        }
        
        function login($username,$password){
            $informationOfUsername = $this->getInformationOfUser($username);
            if (empty($informationOfUsername)){
                return ['status' => FALSE, "message" => "Người dùng không tồn tại"];
            } else {
                $hashedPassword = $informationOfUsername['password'];
                $result = $this->comparePassword($password,$hashedPassword);
                if ($result){
                    return ['status' => TRUE, "message" => "Đăng nhập thành công"];
                } else {
                    return ['status' => FALSE, "message" => "Sai mật khẩu"];
                }
            }
        }
        function checkIssetEmail($email){
            return $this->acc->query("SELECT * FROM authme WHERE email='$email'")->fetch();
        }
        function register($username,$email,$password){


            $ip = $_SERVER['REMOTE_ADDR'];
            $regDate = time();
            // Kiểm tra nếu username đã tồn tại
            if ($this->getInformationOfUser($username) !== FALSE) {
                return ['status' => FALSE, "message" => "Tài khoản đã tồn tại"];
            }
        
            // Kiểm tra nếu email đã tồn tại nếu email không phải là chuỗi rỗng
            if ($email !== "" && $this->checkIssetEmail($email) !== FALSE) {
                return ['status' => FALSE, "message" => "Email đã tồn tại"];
            }
        
            // Mã hóa mật khẩu
            $hashedPassword = $this->computeHash($password, bin2hex(random_bytes(8)));
            $user = strtolower($username);
        
            // Sử dụng prepared statements để tránh lỗi và tăng bảo mật
            $stmt = $this->acc->prepare("INSERT INTO authme (username, realname, password, regdate, regip, email) VALUES (:username, :realname, :password, :regdate, :regip, :email)");
        
            $stmt->bindParam(':username', $user);
            $stmt->bindParam(':realname', $username);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':regdate',$regDate);
            $stmt->bindParam(':regip', $ip); 
            
            // Xử lý trường hợp email là chuỗi rỗng
            if ($email == "") {
                $stmt->bindValue(':email', NULL, PDO::PARAM_NULL);
            } else {
                $stmt->bindParam(':email', $email);
            }
        
            if ($stmt->execute()) {
                return ['status' => TRUE, "message" => "Đăng ký thành công"];
            } else {
                return ['status' => FALSE, "message" => "Đã có lỗi xảy ra"];
            }
        }
        function changePassword($username,$password){
            $hashedPassword = $this->computeHash($password, bin2hex(random_bytes(8)));
            return $this->acc->prepare("UPDATE authme SET password = '$hashedPassword' WHERE realname='$username'")->execute();
        }
        function logout(){
            try {
                unset($_SESSION['username']);
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }
        function updateAccount($username, $role, $password) {
            // Bắt đầu xây dựng câu lệnh SQL
            $sql = "UPDATE authme SET role = :role";
        
            // Nếu password không phải là chuỗi rỗng, thêm vào câu lệnh SQL
            if ($password !== "") {
                $sql .= ", password = :password";
            }
            
            // Hoàn thành câu lệnh SQL với điều kiện WHERE để cập nhật đúng tài khoản
            $sql .= " WHERE realname = :username";
            
            // Chuẩn bị câu lệnh SQL
            $stmt = $this->acc->prepare($sql);
            
            // Liên kết các tham số
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            
            // Nếu password không phải là chuỗi rỗng, liên kết tham số password
            if ($password !== "") {
                $hashedPassword = $this->computeHash($password, bin2hex(random_bytes(8)));
                $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            }
            
            // Thực thi câu lệnh
            return $stmt->execute();
        }
        
        function deleteAccount($username) {
            // Chuẩn bị câu lệnh SQL
            $stmt = $this->acc->prepare("DELETE FROM authme WHERE realname = :username");
            
            // Liên kết tham số
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            
            // Thực thi câu lệnh
            return $stmt->execute();
        }
        
    }
?>
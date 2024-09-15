function valFormLogin(){
    var allowedNicknameCharacters = /^[a-zA-Z0-9_]*$/;
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var usernameError = document.getElementById("usernameError");
    var passwordError = document.getElementById("passwordError");
    var error =0;
    if (username == "" ){
        usernameError.innerText = "Bạn phải nhập tài khoản";
        error ++;
    } else {
        if (!allowedNicknameCharacters.test(username)){
            usernameError.innerText = "Tài khoản không xác định";
            error++;
        } else {
            usernameError.innerText = '';
        }
    }
    if (password == ""){
        passwordError.innerText = "Bạn phải nhập mật khẩu";
        error ++;
    } else {
        passwordError.innerText = '';
    }
    if (error ===0){
        return true;
    } else {
        return false;
    }
}
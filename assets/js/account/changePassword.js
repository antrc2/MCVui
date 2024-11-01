function valFormChangePassword() {
    var passwordRegex = /^[!-~]*$/;
    var oldPassword = document.getElementById("oldPassword").value;
    var newPassword = document.getElementById("newPassword").value;
    var reNewPassword = document.getElementById("reNewPassword").value;

    var oldPasswordError = document.getElementById("oldPasswordError");
    var newPasswordError = document.getElementById("newPasswordError");
    var reNewPasswordError = document.getElementById("reNewPasswordError");

    var error = 0;

    // Validate old password
    if (oldPassword === "") {
        oldPasswordError.innerText = "Bạn phải nhập mật khẩu cũ";
        error++;
    } else {
        oldPasswordError.innerText = "";
    }

    // Validate new password
    if (newPassword === "") {
        newPasswordError.innerText = "Bạn phải nhập mật khẩu mới";
        error++;
    } else if (newPassword.includes(" ")) {
        newPasswordError.innerText = "Mật khẩu không được chứa dấu cách";
        error++;
    } else if (!passwordRegex.test(newPassword)) {
        newPasswordError.innerText = "Mật khẩu không hợp lệ";
        error++;
    } else if (newPassword.length < 4) {
        newPasswordError.innerText = "Mật khẩu quá ngắn";
        error++;
    } else if (newPassword.length > 31) {
        newPasswordError.innerText = "Mật khẩu quá dài";
        error++;
    } else {
        newPasswordError.innerText = "";
    }

    // Validate re-entered password
    if (reNewPassword === "") {
        reNewPasswordError.innerText = "Bạn phải nhập lại mật khẩu mới";
        error++;
    } else if (reNewPassword !== newPassword) {
        reNewPasswordError.innerText = "Mật khẩu không trùng khớp";
        error++;
    } else {
        reNewPasswordError.innerText = "";
    }

    // Return validation result
    if (error === 0) {
        return true;
    } else {
        return false;
    }
}

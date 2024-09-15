function copyText(text) {
    // Tạo một textarea ẩn
    var textarea = document.createElement("textarea");
    textarea.value = text;

    // Thêm textarea vào document để có thể sao chép nội dung của nó
    document.body.appendChild(textarea);

    // Chọn văn bản trong textarea
    textarea.select();
    textarea.setSelectionRange(0, 99999); // Đối với trình duyệt di động

    // Sao chép văn bản đã chọn vào clipboard
    document.execCommand("copy");

    // Xóa textarea sau khi sao chép
    document.body.removeChild(textarea);
}

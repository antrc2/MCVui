document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('toggleButton');
    const menu = document.getElementById('menu');

    // Thêm sự kiện click cho thẻ i
    toggleButton.addEventListener('click', () => {
        // Thay đổi lớp 'show' để hiển thị hoặc ẩn menu
        menu.classList.toggle('show');
    });
    const menuItems = document.querySelectorAll('.menus li');

    // Lấy phần tử có id là "menus"
    const targetMenu = document.getElementById('menus');

    // Xóa nội dung hiện tại của phần tử mục tiêu
    targetMenu.innerHTML = '';

    // Sao chép tất cả các thẻ <li> vào phần tử mục tiêu
    menuItems.forEach(item => {
        targetMenu.appendChild(item.cloneNode(true));
    });

    // Lấy tất cả các phần tử có class 'user' và 'username' trong cả hai phần tử 'pc' và 'pe'
    var userElements = document.querySelectorAll('.pc .user, .pe .user');
    var usernameElements = document.querySelectorAll('.pc .username, .pe .username');

    // Lấy tất cả các phần tử có class 'users' và 'usernames' trong cả hai phần tử 'pc' và 'pe'
    var usersElements = document.querySelectorAll('.pc .users, .pe .users');
    var usernamesElements = document.querySelectorAll('.pc .usernames, .pe .usernames');

    // Thêm sự kiện click cho tất cả các phần tử có class 'user'
    userElements.forEach(function (userElement) {
        userElement.addEventListener('click', function () {
            // Ẩn tất cả các phần tử 'usernames'


            // Hiển thị hoặc ẩn các phần tử 'users'
            usersElements.forEach(function (usersElement) {
                usersElement.classList.toggle('show');
            });
        });
    });

    // Thêm sự kiện click cho tất cả các phần tử có class 'username'
    usernameElements.forEach(function (usernameElement) {
        usernameElement.addEventListener('click', function () {
            // Ẩn tất cả các phần tử 'users'


            // Hiển thị hoặc ẩn các phần tử 'usernames'
            usernamesElements.forEach(function (usernamesElement) {
                usernamesElement.classList.toggle('show');
            });
        });
    });
});

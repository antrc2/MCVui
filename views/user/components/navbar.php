<header>
    <div class="pe nav">
        <div id="header">
            <a class="logos" href="/"><img class="logo" src="assets/image/favicon.png" alt="Favicon"></a>
            <div id="toggleButton"><i class="fa-solid fa-bars"></i></div>
        </div>
        <div id="menu" class="navbar">
            <nav>
                <ul id="menus"></ul>
            </nav>
        </div>
    </div>
    <div class="pc nav">
        <div class="navbar">
            <nav class="menus">
                <ul>
                    <a  class="logos" href="/"><img class="logo" src="assets/image/favicon.png" alt=""></a>
                    <li>
                        <a href="/">
                            <button class="btn">
                                <span><i class="fa-solid fa-house"></i></span>
                                <span>Trang chủ</span>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href="/donate">
                            <button class="btn">
                                <span><i class="fa-solid fa-circle-dollar-to-slot"></i></span>
                                <span>Nạp thẻ</span>
                            </button>
                        </a>
                    </li>
                    <?php
                        if (isset($_SESSION['username'])){
                            $acc = new accountModel;
                            $role = $acc->getInformationOfUser($_SESSION['username']);
                            if ($role['name'] === "admin" || $role['name'] === "owner"){
                                
                    ?>
                    <li>
                        <a href="/dashboard">
                            <button>
                                <span><i class="fa-solid fa-user-tie"></i></span>
                                <span>Trang quản trị</span>
                            </button>
                        </a>
                    </li>
                    <?php
                       }
                    }
                    ?>
                         
                    
                </ul>
            </nav>
        </div>
        <div class="navbar">
            <nav class="menus">
                <ul class="subMenuu">
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="username">
                        <button class="btn">
                            <span><img class="headUser" src="https://cravatar.eu/helmavatar/<?= $_SESSION['username']?>/25" alt=""></span>
                            <span><?= $_SESSION['username']?></span>
                        </button>
                    </li>
                    <ul class="subMenuUser">
                        <li class="usernames">
                            <a href="/profile">
                                <button>
                                    <span><i class="fa-regular fa-user"></i></span>
                                    <span>Thông tin cá nhân</span>
                                </button>
                            </a>
                        </li>
                        <li class="usernames">
                            <a href="/chuyenxu">
                                <button>
                                    <span><i class="fa-solid fa-coins"></i></span>
                                    <span>Đổi xu</span>
                                </button>
                            </a>
                        </li>
                        <li class="usernames">
                            <a href="/change-password">
                                <button>
                                    <span><i class="fa-solid fa-key"></i></span>
                                    <span>Đổi mật khẩu</span>
                                </button>
                            </a>
                        </li>
                        <li class="usernames">
                            <a href="/logout">
                                <button class="btn">
                                    <span><i class="fa-solid fa-user"></i></span>
                                    <span>Đăng xuất</span>
                                </button>
                            </a>
                        </li>
                    </ul>
                <?php else: ?>
                    <li class="user">
                        <button class="btn">
                            <span><i class="fa-solid fa-user"></i></span>
                            <span>Tài khoản</span>
                        </button>
                    </li>   
                    <ul class="subMenuUser">
                        <li id="login" class="users">
                            <a href="/login">
                                <button class="btn">
                                    <span><i class="fa-solid fa-right-to-bracket"></i></span>
                                    <span>Đăng nhập</span>
                                </button>
                            </a>
                        </li>
                        <li class="users">
                            <a href="/register">
                                <button class="btn">
                                    <span><i class="fa-solid fa-user-plus"></i></span>
                                    <span>Đăng kí</span>
                                </button>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</header>
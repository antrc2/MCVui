<header>
    <nav>
        <ul>
            <li><a href="/"><button>Trang chủ</button></a></li>
            <li><a href="/dashboard"><button>Trang quản trị</button></a></li>
            <?php if ($role['name'] === "admin" || $role['name'] === "owner"): ?>
            <li><a href="/donate-history"><button>Lịch sử nạp thẻ</button></a></li>
            <li><a href="/exchange-history"><button>Lịch sử đổi xu</button></a></li>
            <?php endif; ?>
            <?php if ($role['name'] === "owner"): ?>
            <li><a href="/account"><button>Tài khoản</button></a></li>
            <li><a href="/list-event"><button>Sự kiện nạp thẻ</button></a></li>
            <li><a href="/servers"><button>Danh sách máy chủ</button></a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
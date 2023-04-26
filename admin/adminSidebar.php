<?php
if (isset($_SESSION['role']) && $_SESSION['role'] == 0) {
?>
    <div id="admin-sidebar-container">
        <div class="sidebar">
            <div class="sidebar-user">
                <div class="icon">
                    <i class="fa-solid fa-circle-user fa-4x"></i>
                </div>
                <div class="info">
                    <div class="welcome">Welcome,</div>
                    <div class="name"><?php echo cutName($_SESSION['name']); ?></div>
                </div>
            </div>
            <ul class="sidebar-list">
                <a href="/faion/index.php/admin/products/">
                    <li class="<?php echo addHeaderActive("products"); ?>">
                        <i class="fa-solid fa-box fa-fw fa-lg" style="color: #AD13C2;"></i>
                        <span class="sidebar-item">Sản phẩm</span>
                    </li>
                </a>
                <a href="/faion/index.php/admin/orders/">
                    <li class="<?php echo addHeaderActive("orders"); ?>">
                        <i class="fa-solid fa-scroll fa-fw fa-lg" style="color: #FB6340;"></i>
                        <span class="sidebar-item">Đơn hàng</span>
                    </li>
                </a>
                <a href="/faion/index.php/admin/customers/">
                    <li class="<?php echo addHeaderActive("customers"); ?>">
                        <i class="fa-solid fa-users fa-fw fa-lg" style="color: #29C9F0;"></i>
                        <span class="sidebar-item">Khách hàng</span>
                    </li>
                </a>
                <a href="/faion/index.php/admin/users/">
                    <li class="<?php echo addHeaderActive("users"); ?>">
                        <i class="fa-solid fa-user fa-fw fa-lg" style="color: #FDD700;"></i>
                        <span class="sidebar-item">Người dùng</span>
                    </li>
                </a>
                <a href="/faion/index.php/admin/theme/">
                    <li class="<?php echo addHeaderActive("theme"); ?>">
                        <i class="fa-solid fa-palette fa-fw fa-lg" style="color: #F4A5B5;"></i>
                        <span class="sidebar-item">Giao diện</span>
                    </li>
                </a>
            </ul>
        </div>
    </div>
<?php
} else if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
?>
    <div id="admin-sidebar-container">
        <div class="sidebar">
            <div class="sidebar-user">
                <div class="icon">
                    <i class="fa-solid fa-circle-user fa-4x"></i>
                </div>
                <div class="info">
                    <div class="welcome">Welcome,</div>
                    <div class="name"><?php echo cutName($_SESSION['name']); ?></div>
                </div>
            </div>
            <ul class="sidebar-list">
                <a href="/faion/index.php/admin/customers/">
                    <li class="<?php echo addHeaderActive("customers"); ?>">
                        <i class="fa-solid fa-users fa-fw fa-lg" style="color: #29C9F0;"></i>
                        <span class="sidebar-item">Khách hàng</span>
                    </li>
                </a>
                <a href="/faion/index.php/admin/users/">
                    <li class="<?php echo addHeaderActive("users"); ?>">
                        <i class="fa-solid fa-user fa-fw fa-lg" style="color: #FDD700;"></i>
                        <span class="sidebar-item">Người dùng</span>
                    </li>
                </a>
            </ul>
        </div>
    </div>
<?php
} else if (isset($_SESSION['role']) && $_SESSION['role'] == 2) {
?>
    <div id="admin-sidebar-container">
        <div class="sidebar">
            <div class="sidebar-user">
                <div class="icon">
                    <i class="fa-solid fa-circle-user fa-4x"></i>
                </div>
                <div class="info">
                    <div class="welcome">Welcome,</div>
                    <div class="name"><?php echo cutName($_SESSION['name']); ?></div>
                </div>
            </div>
            <ul class="sidebar-list">
                <a href="/faion/index.php/admin/products/">
                    <li class="<?php echo addHeaderActive("products"); ?>">
                        <i class="fa-solid fa-box fa-fw fa-lg" style="color: #5E72E4;"></i>
                        <span class="sidebar-item">Sản phẩm</span>
                    </li>
                </a>
                <a href="/faion/index.php/admin/orders/">
                    <li class="<?php echo addHeaderActive("orders"); ?>">
                        <i class="fa-solid fa-scroll fa-fw fa-lg" style="color: #AD13C2;"></i>
                        <span class="sidebar-item">Đơn hàng</span>
                    </li>
                </a>
                <a href="/faion/index.php/user/account/">
                    <li class="<?php echo addHeaderActive("account"); ?>">
                        <i class="fa-solid fa-key fa-fw fa-lg" style="color: #FB6340;"></i>
                        <span class="sidebar-item">Tài khoản</span>
                    </li>
                </a>
            </ul>
        </div>
    </div>

<?php
} else if (isset($_SESSION['role']) && $_SESSION['role'] == 3) {
?>
    <div id="admin-sidebar-container">
        <div class="sidebar">
            <div class="sidebar-user">
                <div class="icon">
                    <i class="fa-solid fa-circle-user fa-4x"></i>
                </div>
                <div class="info">
                    <div class="welcome">Welcome,</div>
                    <div class="name"><?php echo cutName($_SESSION['name']); ?></div>
                </div>
            </div>
            <ul class="sidebar-list">
                <a href="/faion/index.php/user/info/">
                    <li class="<?php echo addHeaderActive("info"); ?>">
                        <i class="fa-solid fa-address-card fa-fw fa-lg" style="color: #5E72E4;"></i>
                        <span class="sidebar-item">Thông tin cá nhân</span>
                    </li>
                </a>
                <a href="/faion/index.php/user/account/">
                    <li class="<?php echo addHeaderActive("account"); ?>">
                        <i class="fa-solid fa-key fa-fw fa-lg" style="color: #FB6340;"></i>
                        <span class="sidebar-item">Tài khoản</span>
                    </li>
                </a>
                <li id="darkmode-container" onclick="changeTheme()">
                    <i id="darkmode-btn" class="fa-solid fa-circle-half-stroke fa-fw fa-lg"></i>
                    <span class="sidebar-item">Darkmode</span>
                </li>
            </ul>
        </div>
    </div>


<?php
}
?>
<div id="sidebar-container">
    <div id="sidebar">
        <div id="turnoff-container">
            <div id="sidebar-darkmode">
                <i id="sidebar-darkmode-btn" class="fa-solid fa-circle-half-stroke fa-lg" onclick="changeTheme()"></i>
            </div>
            <button id="turnoff-btn">
                <i class="fa-solid fa-xmark fa-2x"></i>
            </button>
        </div>
        <div id="sidebar-logo">
            <img src="/faion/img/Logo/Faion_icon.png" alt="">
        </div>
        <div class="sidebar-search-container">
            <input type="search" id="sidebar-search" placeholder="Tìm kiếm..." value="">
            <button id="sidebar-search-btn" onclick="search_product_sidebar();"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>
        </div>
        <ul id="sidebar-list">
            <a href="/faion/index.php/">
                <li class="<?php echo addHeaderActive("main"); ?>">
                    <i class="fa-solid fa-house fa-fw"></i>
                    <span class="sidebar-item">Trang chủ</span>
                </li>
            </a>
            <a href="/faion/index.php/products?category=all&page=1">
                <li class="<?php echo addHeaderActive("products"); ?>">
                    <i class="fa-solid fa-shirt fa-fw"></i>
                    <span class="sidebar-item">Sản phẩm</span>
                </li>
            </a>
            <a href="/faion/index.php/sizeguide/">
                <li class="<?php echo addHeaderActive("sizeguide"); ?>">
                    <i class="fa-solid fa-ruler fa-fw"></i>
                    <span class="sidebar-item">Size guide</span>
                </li>
            </a>
            <a href="/faion/index.php/contact/">
                <li class="<?php echo addHeaderActive("contact"); ?>">
                    <i class="fa-solid fa-envelope fa-fw"></i>
                    <span class="sidebar-item">Liên hệ</span>
                </li>
            </a>
            <a href="/faion/index.php/login/">
                <li class="<?php echo addHeaderActive("login"); ?>">
                    <i class="fa-solid fa-right-to-bracket fa-fw"></i>
                    <span class="sidebar-item">Đăng nhập</span>
                </li>
            </a>
        </ul>
    </div>
</div>
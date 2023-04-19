<footer>
    <div id="footer">
        <div id="top-footer">
            <div class="top-footer-menu">
                <img id="top-footer-menu-img" src="/FAION/img/Logo/Faion_remove_background.png" alt="Faion">
                <p><i class="fa-solid fa-location-dot fa-fw top-footer-icon"></i>Địa chỉ: 273 An Dương Vương, P3,
                    Quận 5, TP.HCM</p>
                <p><i class="fa-regular fa-envelope fa-fw top-footer-icon"></i>Email: <a href="mailto:nthnam.a1.c3tqcap@gmail.com">nthnam.a1.c3tqcap@gmail.com</a></p>
                <p><i class="fa-solid fa-phone fa-fw top-footer-icon"></i>Điện thoại: 038 2358 823</p>
            </div>
            <div class="top-footer-menu">
                <h3>Danh mục</h3>
                <a href="#">Tìm kiếm</a>
                <a href="/faion/index.php/sizeguide/">Kiểm tra size áo</a>
                <a href="/faion/index.php/contact/">Liên hệ</a>
            </div>
            <div class="top-footer-menu" id="top-footer-menu-category">
                <?php
                echo "<h3>Sản phẩm</h3>";
                for ($i = 0; $i < count($categoryList); $i++) {
                    echo "<a href='/FAION/index.php/products?category=" . strtolower($categoryList[$i]) . "&page=1'>" .  $categoryList[$i] . "</a>";
                } 
                $db->disconnect();            
                ?>
            </div>
            <div class="top-footer-menu">
                <h3>Đăng ký nhận tin</h3>
                <form action="">
                    <div id="top-footer-menu-input">
                        <input type="email" value="" id="top-footer-email" placeholder="Nhập email của bạn...">
                        <button id="top-footer-email-btn" type="submit">Gửi</button>
                    </div>
                </form>
                <p>Đăng ký với chúng tôi để nhận email về sản phẩm mới,
                    khuyến mại đặc biệt và các sự kiện độc đáo.</p>
            </div>
        </div>
        <div id="bottom-footer">
            <a href="https://www.facebook.com/">
                <div class="bottom-footer-icon"><i class="fa-brands fa-facebook"></i></div>
            </a>
            <a href="https://www.instagram.com/">
                <div class="bottom-footer-icon"><i class="fa-brands fa-instagram"></i></div>
            </a>
            <a href="https://twitter.com/">
                <div class="bottom-footer-icon"><i class="fa-brands fa-twitter"></i></div>
            </a>
            <p>Copyright &#169; 2023 FAION.</p>
        </div>
    </div>
</footer>

<div id="backtotop">
    <a href="#header">
        <i class="fa-solid fa-angle-up fa-lg"></i>
    </a>
</div>
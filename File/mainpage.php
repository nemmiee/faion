<?php
if (isset($_SESSION['firstLogin'])) {
    // Hiển thị alert thông báo đăng nhập thành công
    echo "<script src=\"/faion/js/script.js\"></script>";
    echo "<script> alertMessage('success', 'Đăng nhập thành công'); </script>";
    unset($_SESSION['firstLogin']);
}

/* Slider */
include('../faion/template/slider.php');
include('../faion/file/featureProducts.php');
?>

<main>
    <div id="content">
        <div id="top-shopnow-container">
            <div class="shopnow-inner">
                <h2>BLOW THEM AWAY</h2>
                <h4>WITH A GIFT FOR EVERYONE ON YOUR LIST</h4>
            </div>
            <div class="shopnow-inner">
                <a href="/file/products.html">
                    <button>
                        SHOP NOW
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div id="main-content">
        <div class="main-content-inner">
            <a href="/faion/index.php/products?category=shirt&page=1">
                <div class="content-img-container">
                    <img src="/faion/img/slider/shirt.jpg" alt="">
                </div>
                <div class="content-inner-category">SHIRT</div>
            </a>
        </div>
        <div class="main-content-inner">
            <a href="/faion/index.php/products?category=hoodie&page=1">
                <div class="content-img-container">
                    <img src="/faion/img/slider/hoodie.jpg" alt="">
                </div>
                <div class="content-inner-category">HOODIE</div>
            </a>
        </div>
        <div class="main-content-inner">
            <a href="/faion/index.php/products?category=sweater&page=1">
                <div class="content-img-container">
                    <img src="/faion/img/slider/sweater.jpg" alt="">
                </div>
                <div class="content-inner-category">SWEATER</div>
            </a>
        </div>
        <div class="main-content-inner">
            <a href="/faion/index.php/products?category=jacket&page=1">
                <div class="content-img-container">
                    <img src="/faion/img/slider/jacket.jpg" alt="">
                </div>
                <div class="content-inner-category">JACKET</div>
            </a>
        </div>
        <div id="bottom-shopnow-container">
            <div class="shopnow-inner">
                <h2>BLOW THEM AWAY</h2>
                <h4>WITH A GIFT FOR EVERYONE ON YOUR LIST</h4>
            </div>
            <div class="shopnow-inner">
                <a href="/file/products.html">
                    <button>
                        SHOP NOW
                    </button>
                </a>
            </div>
        </div>
    </div>
</main>
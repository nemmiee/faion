<?php
/* Slider */
include('../FAION/template/slider.php');
?>
<main>
    <div id="product-search-content">
        <div id="product-search">
            <div class="product-search-text">
                <input type="search" name="search-area" id="search" value="" placeholder="Tìm kiếm nè...." onkeyup="search_product();">
                <div id="button-search" onclick="Search(0)">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div class="xmark" onclick="clock()">
                    <i class="fa-solid fa-xmark fa-lg"></i>
                </div>
                <div id="filter" onclick="Show_choose()">
                    <i class="fa-solid fa-filter"></i>
                    <div id="filter_choose">
                        <ul>
                            <li onclick="cheap()">Rẻ Nhất</li>
                            <li onclick="expensive()">Cao nhất</li>
                            <li onclick="U500()"> <span>
                                    < </span> 500.000đ</li>
                            <li onclick="H500()"><span>>=</span> 500.000đ</li>
                            <li onclick="ALL()">Tất cả</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="product-search-result">
            </div>
            <div id="Numpage">
            </div>
        </div>
    </div>
    <div id="content">
        <div id="top-shopnow-container">
            <div class="shopnow-inner">
                <h2>BLOW THEM AWAY</h2>
                <h4>WITH A GIFT FOR EVERYONE ON YOUR LIST</h4>
            </div>
            <div class="shopnow-inner">
                <a href="/File/products.html">
                    <button>
                        SHOP NOW
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div id="main-content">
        <div class="main-content-inner">
            <a href="/File/products.html?shirt&0">
                <div class="content-img-container">
                    <img src="/FAION/img/slider/shirt.jpg" alt="">
                </div>
                <div class="content-inner-category">SHIRT</div>
            </a>
        </div>
        <div class="main-content-inner">
            <a href="/File/products.html?hoodie&0">
                <div class="content-img-container">
                    <img src="/FAION/img/slider/hoodie.jpg" alt="">
                </div>
                <div class="content-inner-category">HOODIE</div>
            </a>
        </div>
        <div class="main-content-inner">
            <a href="/File/products.html?sweater&0">
                <div class="content-img-container">
                    <img src="/FAION/img/slider/sweater.jpg" alt="">
                </div>
                <div class="content-inner-category">SWEATER</div>
            </a>
        </div>
        <div class="main-content-inner">
            <a href="/File/products.html?jacket&0">
                <div class="content-img-container">
                    <img src="/FAION/img/slider/jacket.jpg" alt="">
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
                <a href="/File/products.html">
                    <button>
                        SHOP NOW
                    </button>
                </a>
            </div>
        </div>
    </div>

    <!-- Product info -->
    <div class="" id="product-info-container">
        <div id="product-info">
            <button type="button" id="close-product-info-btn" onclick="closeProductInfo()">
                <i class="fa-solid fa-xmark fa-2x"></i>
            </button>
            <div class="product-info-left">
                <img id="product-info-img" alt="Image">
            </div>
            <div class="product-info-right">
                <h2 id="product-name"></h2>
                <h3 id="product-price"></h3>
                <h4>SIZE</h4>
                <div id="check-size-container">
                    <div class="check-size-wrapper">
                        <label class="radio-check" id="sizeM"><input type="radio" name="size-option" class="size-option" value="M" onclick="choose('M')" />M</label>
                    </div>
                    <div class="check-size-wrapper">
                        <label class="radio-check" id="sizeL"><input type="radio" name="size-option" class="size-option" value="L" onclick="choose('L')" />L</label>
                    </div>
                    <div class="check-size-wrapper">
                        <label class="radio-check" id="sizeXL"><input type="radio" name="size-option" class="size-option" value="XL" onclick="choose('XL')" />XL</label>
                    </div>
                </div>
                <h4>Số lượng</h4>
                <button class="minusQuantity" onclick="quantityDown()">−</button>
                <input type="text" id="quantity" value="">
                <button class="plusQuantity" onclick="quantityUp()">+</button>
                <button class="addToCart-btn">
                    <i class="fa fa-cart-shopping fa-lg"></i>
                    Thêm vào giỏ hàng
                </button>
            </div>
        </div>
    </div>
</main>
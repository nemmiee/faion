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
            <a href="/file/products.html?shirt&0">
                <div class="content-img-container">
                    <img src="/FAION/img/slider/shirt.jpg" alt="">
                </div>
                <div class="content-inner-category">SHIRT</div>
            </a>
        </div>
        <div class="main-content-inner">
            <a href="/file/products.html?hoodie&0">
                <div class="content-img-container">
                    <img src="/FAION/img/slider/hoodie.jpg" alt="">
                </div>
                <div class="content-inner-category">HOODIE</div>
            </a>
        </div>
        <div class="main-content-inner">
            <a href="/file/products.html?sweater&0">
                <div class="content-img-container">
                    <img src="/FAION/img/slider/sweater.jpg" alt="">
                </div>
                <div class="content-inner-category">SWEATER</div>
            </a>
        </div>
        <div class="main-content-inner">
            <a href="/file/products.html?jacket&0">
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
                <a href="/file/products.html">
                    <button>
                        SHOP NOW
                    </button>
                </a>
            </div>
        </div>
    </div>    
</main>
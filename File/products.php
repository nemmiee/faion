<!-- Shop breadcrumb -->
<div class="shop-page-title-container">
    <div class="shop-page-title-inner">
        <h1 class="page-title">Cửa hàng</h1>
        <div class="breadrcumb-container">
            <nav class="breadcrumb">
                <span class="back-home-page">
                    <a href="/faion/index.php/"><i class="fa-solid fa-house fa-xs"></i> Trang chủ</a>
                </span>
                <span class="divider"> / </span>
                <span id="breadcrumb-inner-title">Sản phẩm</span>
            </nav>
        </div>
    </div>
</div>

<?php
include('../faion/template/sidebar.php');
?>

<main id="main">
    <div id="product-search-content">
        <div id="product-search">
            <div class="product-search-text">
                <input type="search" name="search-area" id="search" value="" placeholder="Tìm kiếm nè...." onkeyup="search_product();">
                <div id="button-search" onclick="Search(0)">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <div id="filter" onclick="Show_choose()">
                    <i class="fa-solid fa-filter fa-lg"></i>
                    <div id="filter_choose">
                        <ul>
                            <li value="cheap" onclick="cheap()">Rẻ Nhất</li>
                            <li value="exp" onclick="expensive()">Cao nhất</li>
                            <li value="U500" onclick="U500()"><span>
                                    < </span> 500.000đ</li>
                            <li value="H500" onclick="H500()"><span> >= </span> 500.000đ</li>
                            <li value="all" onclick="ALL()">Tất cả</li>
                        </ul>
                    </div>
                </div>
                <div class="xmark" onclick="clock()">
                    <i class="fa-solid fa-xmark fa-lg"></i>
                </div>
            </div>
            <div id="product-search-result">
            </div>
            <div id="Numpage">
            </div>
        </div>
    </div>

    <!-- Menu -->
    <div id="menu-container">
        <div id="shop-sidebar">
            <div id="nav_left-menu">
                <div class="shop-sidebar-title">Danh mục sản phẩm</div>
                <div class="small_divider"></div>
            </div>
            <ul id="menu-items">
                <?php
                echo "<li><a href=\"/faion/index.php/products?category=all&page=1\" class=\"menu-value\">Tất cả</a></li>";
                for ($i = 0; $i < count($menuList); $i++) {
                    echo "<li><a href='/faion/index.php/products?category=" . strtolower($menuList[$i]) . "&page=1' class=\"menu-value\">" .  $menuList[$i] . "</a></li>";
                }
                // Kích hoạt class active  
                $temp = explode("?", $uri);
                $temp = explode("&", $temp[1]);
                $temp = explode("=", $temp[0])[1];
                if ($temp == "all") {
                    echo "<script>document.getElementsByClassName('menu-value')[0].classList.add('active'); </script>";
                } else {
                    echo "<script>document.getElementsByClassName('menu-value')[0].classList.remove('active'); </script>";
                    for ($i = 0; $i < count($menuList); $i++) {
                        if ($temp == strtolower($menuList[$i])) {
                            echo "<script>document.getElementsByClassName('menu-value')[" . $i + 1 . "].classList.add('active'); </script>";
                        } else {
                            echo "<script>document.getElementsByClassName('menu-value')[" . $i + 1 . "].classList.remove('active'); </script>";
                        }
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <!-- Content -->
    <div class="content-container" id="maincontent">
        <div id="products">
            <?php
            showProducts();
            ?>
        </div>
        <!-- Product Detail Information -->
        <div id="product-info-container">
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
        <div id="page"></div>
    </div>
</main>

<?php
function showProducts()
{
    include('../faion/object/Product.php');
    include('../faion/object/Category.php');
    $db = new Database();
    mysqli_query($db->getConnection(), "set names 'utf8'");
    $kq = mysqli_query($db->getConnection(), "SELECT * FROM product");
    $productList = array();
    while ($row = mysqli_fetch_array($kq)) {
        $product = new Product(
            $row['id'],
            $row['category_id'],
            $row['name'],
            $row['description'],
            $row['price'],
            $row['image'],
            $row['discount'],
            $row['quantity'],
            $row['sold'],
            $row['status'],
            $row['featured'],
            $row['created_at']
        );
        $productList[] = $product;
    }

    $uri = $_SERVER['REQUEST_URI'];
    //$temp = explode("?", $uri)[1];
    //$category = explode("=", explode("&", explode("?", $uri)[1])[0])[1];
    $category = $_GET['category'];
    $position = explode("=", explode("&", explode("?", $uri)[1])[1])[1];
    $pageAmount = $count = 0;

    if ($category == "all") {
        for ($i = ($position - 1) * 8; $i < count($productList); $i++) {
            echo "<div class=\"card\" onClick=\"showProductInfo(" . $productList[$i]->getId() . ")\"><div class=\"image-container\">
                <img src=\"" . $productList[$i]->getImage() . "\" alt=\"Image\"></div><div class=\"container\"><h4>" . $productList[$i]->getName()
                . "</h4><h5>Giá: " . $productList[$i]->getPrice() . "đ</h5></div><div class=\"addToCart-container\"><button class=\"addToCart-btn\" onclick=\"checkUser()\">Mua ngay</button></div></div>";
            ++$count;
            if ($count == 8) {
                break;
            }
        }
        $pageAmount = ceil(count($productList) / 8);
        $pageNumberLink = "'";
        for ($i = 1; $i <= $pageAmount; $i++) {
            $position = $i;
            $pageNumberLink .= "<a href=\"/faion/index.php/products?category=all&page=" . $position
                . "\"><button class=\"page-number\">" . $i . "</button></a>";
        }
        $pageNumberLink .= "'";
        echo "<script>window.onload = function () {document.getElementById(\"page\").innerHTML = " . $pageNumberLink . ";
            document.getElementsByClassName(\"page-number\")[" . $_GET['page'] - 1 . "].classList.add(\"active\"); }; </script>";
    } else {
        $categoryArr = array();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM category");
        while ($row = mysqli_fetch_array($kq)) {
            $temp = new Category(
                $row['id'],
                $row['name'],
                $row['parent_id'],
                $row['description'],
                $row['status'],
                $row['created_at']
            );
            $categoryArr[] = $temp;
        }
        $flag = 0;
        for ($i = ($position - 1) * 8; $i < count($productList); $i++) {
            for ($j = 0; $j < count($categoryArr); $j++) {
                if ($productList[$i]->getCategoryId() == $categoryArr[$j]->getId() && $category == strtolower($categoryArr[$j]->getName())) {
                    echo "<div class=\"card\" onClick=\"showProductInfo(" . $productList[$i]->getId() . ")\"><div class=\"image-container\">
                    <img src=\"" . $productList[$i]->getImage() . "\" alt=\"Image\"></div><div class=\"container\"><h4>" . $productList[$i]->getName()
                        . "</h4><h5>Giá: " . $productList[$i]->getPrice() . "đ</h5></div><div class=\"addToCart-container\"><button class=\"addToCart-btn\">Mua ngay</button></div></div>";
                    ++$count;
                    if ($count == 8) {
                        $flag = 1;
                        break;
                    }
                }
            }            
            if ($flag == 1) {
                break;
            }
        }
        $tempArr = array();
        for ($i = 0; $i < count($productList); $i++) {
            for ($j = 0; $j < count($categoryArr); $j++) {
                if ($productList[$i]->getCategoryId() == $categoryArr[$j]->getId() && $category == strtolower($categoryArr[$j]->getName())) {
                    $tempArr[] = $productList[$i];
                }
            }
        }
        $pageAmount = ceil(count($tempArr) / 8);
        $pageNumberLink = "'";
        for ($i = 1; $i <= $pageAmount; $i++) {
            $position = $i;
            $pageNumberLink .= "<a href=\"/faion/index.php/products?category=" . $category . "&page=" . $position
                . "\"><button class=\"page-number\">" . $i . "</button></a>";
        }
        $pageNumberLink .= "'";
        echo "<script>window.onload = function () {document.getElementById(\"page\").innerHTML = " . $pageNumberLink . ";
            document.getElementsByClassName(\"page-number\")[" . $_GET['page'] - 1 . "].classList.add(\"active\"); }; </script>";
    }
}
?>
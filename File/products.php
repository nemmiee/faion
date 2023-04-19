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
                <span id="breadcrumb-inner-title"><a href="/faion/index.php/products?category=all&page=1">Sản phẩm</a></span>
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
                for ($i = 0; $i < count($categoryList); $i++) {
                    echo "<li><a href='/faion/index.php/products?category=" . strtolower($categoryList[$i]) . "&page=1' class=\"menu-value\">" .  $categoryList[$i] . "</a></li>";
                }
                // Kích hoạt class active  
                $temp = explode("?", $uri);
                $temp = explode("&", $temp[1]);
                $temp = explode("=", $temp[0])[1];
                if ($temp == "all") {
                    echo "<script>document.getElementsByClassName('menu-value')[0].classList.add('active'); </script>";
                } else {
                    echo "<script>document.getElementsByClassName('menu-value')[0].classList.remove('active'); </script>";
                    for ($i = 0; $i < count($categoryList); $i++) {
                        if ($temp == strtolower($categoryList[$i])) {
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
            showProducts(12, 8);
            ?>
        </div>
        <!-- Product Detail Information -->
        <div id="page"></div>
    </div>
</main>

<?php
function showProducts($main, $sub)
{    
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
            $row['created_at']
        );
        $productList[] = $product;
    }

    $uri = $_SERVER['REQUEST_URI'];
    $category = $_GET['category'];
    $position = explode("=", explode("&", explode("?", $uri)[1])[1])[1];
    $pageAmount = $count = 0;

    if ($category == "all") {
        for ($i = ($position - 1) * $main; $i < count($productList); $i++) {
            echo "<div class=\"card\"><a href=\"/faion/index.php/products?info=" . $productList[$i]->getId() . "\"><div class=\"image-container\">
                <img src=\"" . $productList[$i]->getImage() . "\" alt=\"Image\"></div><div class=\"container\"><h4>" . $productList[$i]->getName()
                . "</h4><h5>Giá: " . changeMoney($productList[$i]->getPrice()) . "₫</h5></div><div class=\"addToCart-container\"><button class=\"addToCart-btn\">Mua ngay</button></div></a></div>";
            ++$count;
            if ($count == $main) {
                break;
            }
        }
        $pageAmount = ceil(count($productList) / $main);
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
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM category WHERE id <> 0");
        while ($row = mysqli_fetch_array($kq)) {
            $temp = new Category(
                $row['id'],
                $row['name'],
            );
            $categoryArr[] = $temp;
        }
        $flag = 0;
        for ($i = ($position - 1) * $sub; $i < count($productList); $i++) {
            for ($j = 0; $j < count($categoryArr); $j++) {
                if ($productList[$i]->getCategoryId() == $categoryArr[$j]->getId() && $category == strtolower($categoryArr[$j]->getName())) {
                    echo "<div class=\"card\"><a href=\"/faion/index.php/products?info=" . $productList[$i]->getId() . "\"><div class=\"image-container\">
                    <img src=\"" . $productList[$i]->getImage() . "\" alt=\"Image\"></div><div class=\"container\"><h4>" . $productList[$i]->getName()
                        . "</h4><h5>Giá: " . changeMoney($productList[$i]->getPrice()) . "₫</h5></div><div class=\"addToCart-container\"><button class=\"addToCart-btn\">Mua ngay</button></div></a></div>";
                    ++$count;
                    if ($count == $sub) {
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
        $pageAmount = ceil(count($tempArr) / $sub);
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
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

<main id="main">
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
        <!-- <div id="loading"></div> -->
        <div id="products"><?php showProducts(12, 8); ?></div>
        <div id="page"></div>
    </div>
</main>

<?php
function showProducts($main, $sub)
{
    $db = new Database();
    $temp = getProductList();
    $productList = array();
    for ($i = 0; $i < count($temp); $i++) {
        if ($temp[$i]->getStatus() == 1) {
            $productList[] = $temp[$i];
        }
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
        $pageNumberLink = '"';
        for ($i = 1; $i <= $pageAmount; $i++) {
            $position = $i;
            $pageNumberLink .= '<a><button class=\"page-number\" onclick=\"pageDivideAjax(\'' . $category . '\',' . $position . ')\">' . $i . '</button></a>';
        }
        $pageNumberLink .= '"';
        echo "<script>window.onload = function () {document.getElementById(\"page\").innerHTML = " . $pageNumberLink . "
            document.getElementsByClassName(\"page-number\")[" . $_GET['page'] - 1 . "].classList.add(\"active\");} </script>";
    } else {
        $categoryArr = array();
        $kq = mysqli_query($db->getConnection(), "SELECT * FROM category WHERE id <> 0");
        while ($row = mysqli_fetch_assoc($kq)) {
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
        $pageNumberLink = '"';
        for ($i = 1; $i <= $pageAmount; $i++) {
            $position = $i;
            $pageNumberLink .= '<a><button class=\"page-number\" onclick=\"pageDivideAjax(\'' . $category . '\',' . $position . ')\">' . $i . '</button></a>';
        }
        $pageNumberLink .= '"';
        echo "<script>window.onload = function () {document.getElementById(\"page\").innerHTML = " . $pageNumberLink . ";
            document.getElementsByClassName(\"page-number\")[" . $_GET['page'] - 1 . "].classList.add(\"active\"); }; </script>";
    }
}
?>
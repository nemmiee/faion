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

<script>
    // $(document).ready(function() {
    //     function load() {            
    //         var url = document.location.href;
    //         url = url.split("?")[1];
    //         var category = url.split("&")[0];
    //         var page = url.split("&")[1];
    //         category = category.split("=")[1];
    //         page = page.split("=")[1];
    //         phantrang(category, page);
    //     }

    //     load();
    //     function phantrang(category, page) {
    //         $("#loading").html("<img src='/faion/img/default/loading.gif'/>").fadeIn("fast");
    //         $.ajax({
    //             type: "get",
    //             url: "/faion/action/actionPageDivide.php",
    //             data: {
    //                 category: category,
    //                 page: page
    //             },
    //             success: function(data) {
    //                 $("#loading").fadeOut("fast");
    //                 $("#maincontent").append(data);
    //             }
    //         });
    //     }
    // });

    // $(document).ready(function() {
    //     function load() {            
    //         phantrang("all", 1);
    //     }

    //     load();
    //     function phantrang(category, page) {
    //         $("#loading").html("<img src='/faion/img/default/loading.gif'/>").fadeIn("fast");
    //         $.ajax({
    //             type: "get",
    //             url: "/faion/action/actionPageDivide.php",
    //             data: {
    //                 category: category,
    //                 page: page
    //             },
    //             success: function(data) {
    //                 $("#loading").fadeOut("fast");
    //                 $("#maincontent").append(data);
    //             }
    //         });
    //     }
    //     $("#maincontent a button.page-number").on("click", function() {
    //         var temp = $(this).val();
    //         var category = temp.split("-")[0];
    //         var page = temp.split("-")[1];
    //         phantrang(category, page);
    //     });
    // });


    // function pageDivideAjax(category, page, keyword, minPrice, maxPrice) {
    //     var request = "";
    //     console.log(keyword);
    //     if (keyword != null) {
    //         request += "keyword=" + keyword + "&page=" + page +
    //             "category=" + category;
    //         if (minPrice != null && maxPrice != null)
    //             request += "&minPrice=" + minPrice + "&maxPrice=" + maxPrice;
    //         else if (minPrice != null && maxPrice == null)
    //             request += "&minPrice=" + minPrice;
    //         else if (minPrice == null && maxPrice != null)
    //             request += "&maxPrice=" + maxPrice;
    //     } else {
    //         request += "category=" + category + "&page=" + page;
    //     }

    //     var url = '/faion/index.php/products?' + request;
    //     var xml = new XMLHttpRequest();
    //     xml.open("GET", "/faion/action/actionPageDivide.php?" + request, true);
    //     xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //     xml.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             document.getElementById("maincontent").innerHTML = url;
    //             // document.getElementById("maincontent").innerHTML = this.responseText;
    //             // history.pushState(null, '', url);
    //         }
    //     };
    //     xml.send();
    // }
</script>

<?php
function showProducts($main, $sub)
{
    $db = new Database();
    $productList = getProductList();

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
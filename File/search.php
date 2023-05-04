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
                <span id="breadcrumb-inner-title">Tìm kiếm sản phẩm</span>
            </nav>
        </div>
    </div>
</div>

<?php
include('../faion/template/sidebar.php');
?>

<main id="main">
    <!-- Menu -->
    <div id="menu-container">
        <div id="shop-sidebar">
            <div id="nav_left-menu">
                <div class="shop-sidebar-title">Tìm kiếm sản phẩm</div>
                <div class="small_divider"></div>
            </div>
        </div>
    </div>
    <div class="search-container">
        <div class="inner">
            <label for="pname">Tên sản phẩm:</label>
            <input type="text" name="name" id="pname" value="<?php
                                                                if (isset($_GET['keyword']) && !empty($_GET['keyword']))
                                                                    echo $_GET['keyword'];
                                                                ?>">
        </div>
        <div class="inner">
            <label for="pcategory">Thể loại:</label>
            <select name="category" id="pcategory">
                <?php
                displayCategoryFilterOption();
                ?>
            </select>
        </div>
        <div class="inner">
            <label for="price-filter">Khoảng giá:</label>
            <div class="price" id="price-filter">
                <input type="text" name="from" id="from" placeholder="₫ TỪ" onkeyup="checkNumber(this)">
                <input type="text" name="to" id="to" placeholder="₫ ĐẾN" onkeyup="checkNumber(this)">
            </div>
        </div>
        <div class="inner">
            <input type="button" value="Áp dụng" id="search-submit" onclick="checkSearch(event)">
        </div>
    </div>

    <!-- Content -->
    <div class="content-container" id="maincontent">        
    </div>
</main>

<script>
    function pageDivideAjax(category, page) {
        var request = "category=" + category + "&page=" + page;
        var url = '/faion/index.php/products?' + request;
        var xml = new XMLHttpRequest();
        xml.open("GET", "/faion/action/actionPageDivide.php?" + request, true);
        xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("maincontent").innerHTML = this.responseText;
                history.pushState(null, '', url);
            }
        };
        xml.send();
    }

    function checkNumber(input) {
        var price = input.value;
        var request = "/faion/action/checkSearch.php?price=" + price;
        var xml = new XMLHttpRequest();
        xml.open("GET", request, true);
        xml.onload = function() {
            input.value = this.responseText;
        }
        xml.send();
    }

    function checkSearch(e) {
        var name = document.getElementById("pname").value.trim();
        var category = document.getElementById("pcategory").value;
        var minPrice = changeMoneyToNum(document.getElementById("from").value);
        var maxPrice = changeMoneyToNum(document.getElementById("to").value);

        if (name == "") {
            e.preventDefault();
            alertMessage("info", "Bạn cần phải nhập tên");            
        } else {
            if ((minPrice != "" && maxPrice != "") && (minPrice > maxPrice)) {
                e.preventDefault();
                alertMessage("warning", "Vui lòng điền khoảng giá phù hợp");
                return;
            }
            var request = "/faion/action/searchProduct.php?keyword=" + name + "&page=1";
            var url = "/faion/index.php/search?keyword=" + name + "&page=1";
            if (category != "") {
                request += "&category=" + category;
                url += "&category=" + category;
            }
            if (minPrice != "") {
                request += "&minPrice=" + minPrice;
                url += "&minPrice=" + minPrice;
            }
            if (maxPrice != "") {
                request += "&maxPrice=" + maxPrice;
                url += "&maxPrice=" + maxPrice;
            }
            
            var xml = new XMLHttpRequest();
            xml.open("GET", request, true);
            xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xml.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("maincontent").innerHTML = this.responseText;
                    history.pushState(null, '', url);
                }
            };
            xml.send();
        }
    }
</script>

<?php
function displayCategoryFilterOption()
{
    echo "<option value=\"all\" selected>Mặc định</option>";
    $categoryList = getCategoryList();
    for ($i = 1; $i < count($categoryList); $i++) {
        echo "<option value=\"" . $categoryList[$i]->getName() . "\">" . $categoryList[$i]->getName() . "</option>";
    }
}
?>
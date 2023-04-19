<?php
$temp = explode("/", $uri);
$page = $temp[count($temp) - 2];
$productRegEx = "/products?[a-zA-Z0-9=&]{1,}/";
$adminRegEx = '/\badmin\b/';
if (!preg_match($adminRegEx, $uri)) {
    if (preg_match($productRegEx, $temp[count($temp) - 1])) {
        if (isset($_GET['category']) && isset($_GET['page'])) {
            include('../faion/file/products.php');
        } else {
            include('../faion/file/productInfo.php');
        }
    } else {
        switch ($page) {
            case "index.php":
                include('../faion/file/mainpage.php');
                break;
            case "sizeguide":
                include('../faion/file/sizeguide.php');
                break;
            case "contact":
                include('../faion/file/contact.php');
                break;
            case "login":
                include('../faion/file/login.php');
                break;
            case "signup":
                include('../faion/file/signup.php');
                break;
            case "cart":
                echo "Cart";
                break;
        }
    }
} else {
    echo "<main id='main'>";
    include('../faion/admin/adminSidebar.php');
    if (preg_match($productRegEx, $temp[count($temp) - 1])) {
        echo "<div class='right-content-container' style='height: auto;'>
        <div id=\"top-sub-header\"></div>";
        
        include('../faion/admin/productDetail.php');
    } else {
        switch ($page) {
            case "products":
                echo "<div class='right-content-container' style='height: auto;'>
                <div id=\"top-sub-header\"></div>";
                include('../faion/admin/productsAdmin.php');
                break;
            case "orders":
                echo "<div class='right-content-container' style='height: 700px;'>
                <div id=\"top-sub-header\"></div>";
                //include ('../faion/admin/orderAdmin.php');
                break;
            case "customers":
                echo "<div class='right-content-container' style='height: 700px;'>
                <div id=\"top-sub-header\"></div>";
                //include ('../faion/admin/customerAdmin.php');
                break;
            case "users":
                echo "<div class='right-content-container' style='height: 700px;'>
                <div id=\"top-sub-header\"></div>";
                //include ('../faion/admin/userAmin.php');
                break;
            case "theme":
                echo "<div class='right-content-container' style='height: 700px;'>
                <div id=\"top-sub-header\"></div>";
                //include ('../faion/admin/themeAdmin.php');
                break;
        }
        echo "</div>
        <div id=\"add-category-container\">
            <div class=\"container\">
                <div class=\"close-container\">
                    <i class=\"fa-solid fa-xmark fa-2x\" onclick=\"displayAndHideCategoryForm()\"></i>
                </div>
                <form action=\"/faion/action/actionProduct.php\" method=\"post\">
                    <div class=\"title\">Thêm thể loại</div>
                    <div class=\"name\">
                        <label for=\"category-name\">Tên thể loại:</label>
                        <input type=\"text\" name=\"name\" id=\"category-name\">
                    </div>
                    <div class=\"button-container\">
                        <input type=\"submit\" name=\"category-submit\" value=\"THÊM\">
                    </div>
                </form>
            </div>
        </div>
        <div id=\"delete-container\"></div>
        </main>";
    }
}
?>
<script>
    function displayAndHideCategoryForm() {
        document.getElementById("add-category-container").classList.toggle("active");
        document.getElementById("category-name").focus();
    }

    function displayDelete(type, amount, id) {
        if (type == "product") {
            if (amount == "single") {
                var container = document.getElementById("delete-container");
                container.classList.add("active");
                container.innerHTML = "" +
                    "<div class=\"container\">" +
                    "<form action=\"/faion/action/actionProduct.php\" method=\"post\">" +
                    "<div class=\"delete-product-icon\"><div class=\"alert-icon\"><i class=\"fa-solid fa-exclamation\" style=\"color: #F8BB86;\"></i></div></div>" +
                    "<div class=\"message\">Bạn có chắc chắn muốn xóa sản phẩm này không?</div>" +
                    "<div class=\"btn-container\">" +
                    "<input type=\"text\" name=\"productId\" value=\"" + id + "\">" +
                    "<div class=\"left\">" +
                    "<input type=\"submit\" name=\"delete-product-submit\" value=\"Xóa\">" +
                    "</div>" +
                    "<div class=\"right\">" +
                    "<input type=\"button\" onclick=\"closeDeleteContainer(event);\" value=\"Trở lại\">" +
                    "</div>" +
                    "</div>" +
                    "</form>" +
                    "</div>";
            } else {
                var arr = document.querySelectorAll(".checkbox-check");
                var idArr = "";
                var count = 0;
                for (var i = 0; i < arr.length; i++) {
                    if (arr[i].checked) {
                        ++count;
                        if (count == 1) {
                            idArr += arr[i].value;
                        } else {
                            idArr += "-" + arr[i].value;
                        }
                    }
                }
                if (idArr != "") {
                    var container = document.getElementById("delete-container");
                    container.classList.add("active");
                    container.innerHTML = "" +
                        "<div class=\"container\">" +
                        "<form action=\"/faion/action/actionProduct.php\" method=\"post\">" +
                        "<div class=\"delete-product-icon\"><div class=\"alert-icon\"><i class=\"fa-solid fa-exclamation\" style=\"color: #F8BB86;\"></i></div></div>" +
                        "<div class=\"message\">Bạn có chắc chắn muốn xóa những sản phẩm này không?</div>" +
                        "<div class=\"btn-container\">" +
                        "<input type=\"text\" name=\"productId\" value=\"" + idArr + "\">" +
                        "<div class=\"left\">" +
                        "<input type=\"submit\" name=\"delete-product-submit\" value=\"Xóa\">" +
                        "</div>" +
                        "<div class=\"right\">" +
                        "<input type=\"button\" onclick=\"closeDeleteContainer(event);\" value=\"Trở lại\">" +
                        "</div>" +
                        "</div>" +
                        "</form>" +
                        "</div>";
                } else {
                    alertMessage("fail", "Bạn chưa chọn sản phẩm nào!");
                }
            }
        } else {
            var container = document.getElementById("delete-container");
            container.classList.add("active");
            container.innerHTML = "" +
                "<div class=\"container\">" +
                "<form action=\"/faion/action/actionProduct.php\" method=\"post\">" +
                "<div class=\"delete-product-icon\"><div class=\"alert-icon\"><i class=\"fa-solid fa-exclamation\" style=\"color: #F8BB86;\"></i></div></div>" +
                "<div class=\"message\">Bạn có chắc chắn muốn xóa thể loại này không?</div>" +
                "<div class=\"btn-container\">" +
                "<input type=\"text\" name=\"categoryId\" value=\"" + id + "\">" +
                "<div class=\"left\">" +
                "<input type=\"submit\" name=\"delete-category-submit\" value=\"Xóa\">" +
                "</div>" +
                "<div class=\"right\">" +
                "<input type=\"button\" onclick=\"closeDeleteContainer(event);\" value=\"Trở lại\">" +
                "</div>" +
                "</div>" +
                "</form>" +
                "</div>";
        }
    }

    function closeDeleteContainer(e) {
        e.preventDefault();
        document.getElementById("delete-container").classList.remove("active");
    }
</script>
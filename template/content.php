<?php
$temp = explode("/", $uri);
$page = $temp[count($temp) - 2];
$productRegEx = "/products?[a-zA-Z0-9=&]{1,}/";
$customerRegEx = "/customers?[a-zA-Z0-9=&]{1,}/";
$userRegEx = "/users?[a-zA-Z0-9=&]{1,}/";
$adminRegEx = '/\badmin\b/';

if (!preg_match($adminRegEx, $uri)) {
    if (preg_match($productRegEx, $temp[count($temp) - 1])) {
        if (isset($_GET['category']) && isset($_GET['page'])) {
            include('../faion/file/product.php');
        } else {
            include('../faion/file/productInfo.php');
        }
    } else if (preg_match("/search?/", $temp[count($temp) - 1])) {
        include ('../faion/file/search.php');
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
            case "info":
                include('../faion/file/userInfo.php');
                break;
            case "account":
                include('../faion/file/userInfo.php');
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
        echo "<div class='right-content-container' style='height: auto;'>";
        include('../faion/admin/productDetail.php');
    } else if (preg_match($customerRegEx, $temp[count($temp) - 1])) {
        echo "<div class='right-content-container' style='height: auto;'>";
        include('../faion/admin/customerDetail.php');
        echo "</div>";
    } else if (preg_match($userRegEx, $temp[count($temp) - 1])) {
        echo "<div class='right-content-container' style='height: auto;'>";
        include('../faion/admin/userDetail.php');
        echo "</div>";
    } else {
        switch ($page) {
            case "products":
                echo "<div class='right-content-container' style='height: auto;'>";                
                include('../faion/admin/productsAdmin.php');
                break;
            case "orders":
                echo "<div class='right-content-container' style='height: auto;'>";
                include ('../faion/admin/orderAdmin.php');
                break;
            case "customers":
                echo "<div class='right-content-container' style='height: auto;'>";
                include('../faion/admin/customerAdmin.php');
                break;
            case "users":
                echo "<div class='right-content-container' style='height: auto;'>";
                include('../faion/admin/userAdmin.php');
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
        <div id=\"confirm-container\"></div>
        </main>";
    }
}
?>
<script>
    // Hiển thị và ẩn form thêm mới thể loại
    function displayAndHideCategoryForm() {
        document.getElementById("add-category-container").classList.toggle("active");
        document.getElementById("category-name").focus();
    }

    /*
        Hiển thị alert kiểm tra có muốn xóa product hoặc category không
        $type (String): Loại dữ liệu cần xóa gồm "product" và "category"
        $amount (String): Loại số lượng cần xóa dùng cho nút xóa các sản phẩm đã chọn
        $id (int): ID của product hoặc category. 
    */
    function displayDelete(type, amount, id) {
        if (type == "product") { // Xóa product
            if (amount == "single") { // Xóa một product
                var container = document.getElementById("confirm-container");
                container.classList.add("active");
                container.innerHTML = "\
                    <div class=\"container\">\
                        <form action=\"/faion/action/actionProduct.php\" method=\"post\">\
                            <div class=\"confirm-icon-container\">\
                                <div class=\"alert-icon\">\
                                    <i class=\"fa-solid fa-exclamation\" style=\"color: #F8BB86;\"></i>\
                                </div>\
                            </div>\
                            <div class=\"message\">Bạn có chắc chắn muốn xóa sản phẩm này không?</div>\
                            <div class=\"btn-container\">\
                                <input type=\"text\" name=\"productId\" value=\"" + id + "\">\
                                <div class=\"left\">\
                                    <input type=\"submit\" name=\"delete-product-submit\" value=\"Xóa\">\
                                </div>\
                                <div class=\"right\">\
                                    <input type=\"button\" onclick=\"closeConfirmContainer(event);\" value=\"Trở lại\">\
                                </div>\
                            </div>\
                        </form>\
                    </div>";
            } else { // Xóa nhiều product
                var arr = document.querySelectorAll(".checkbox-check");
                var idArr = "";
                var count = 0;
                // Kiểm tra các checkbox được check hay chưa và nối $id của product vào $idArr
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
                if (idArr != "") { // Nếu đã có chọn product
                    var container = document.getElementById("confirm-container");
                    container.classList.add("active");
                    container.innerHTML = "\
                        <div class=\"container\">\
                            <form action=\"/faion/action/actionProduct.php\" method=\"post\">\
                                <div class=\"confirm-icon-container\">\
                                    <div class=\"alert-icon\">\
                                        <i class=\"fa-solid fa-exclamation\" style=\"color: #F8BB86;\"></i>\
                                    </div>\
                                </div>\
                                <div class=\"message\">Bạn có chắc chắn muốn xóa những sản phẩm này không?</div>\
                                <div class=\"btn-container\">\
                                    <input type=\"text\" name=\"productId\" value=\"" + idArr + "\">\
                                    <div class=\"left\">\
                                        <input type=\"submit\" name=\"delete-product-submit\" value=\"Xóa\">\
                                    </div>\
                                    <div class=\"right\">\
                                        <input type=\"button\" onclick=\"closeConfirmContainer(event);\" value=\"Trở lại\">\
                                    </div>\
                                </div>\
                            </form>\
                        </div>";
                } else { // Nếu chưa chọn product nào 
                    alertMessage("fail", "Bạn chưa chọn sản phẩm nào!");
                }
            }
        } else { // Xóa category
            var container = document.getElementById("confirm-container");
            container.classList.add("active");
            container.innerHTML = "\
                <div class=\"container\">\
                    <form action=\"/faion/action/actionProduct.php\" method=\"post\">\
                        <div class=\"confirm-icon-container\">\
                            <div class=\"alert-icon\">\
                                <i class=\"fa-solid fa-exclamation\" style=\"color: #F8BB86;\"></i>\
                            </div>\
                        </div>\
                        <div class=\"message\">Bạn có chắc chắn muốn xóa thể loại này không?</div>\
                        <div class=\"btn-container\">\
                            <input type=\"text\" name=\"categoryId\" value=\"" + id + "\">\
                            <div class=\"left\">\
                                <input type=\"submit\" name=\"delete-category-submit\" value=\"Xóa\">\
                            </div>\
                            <div class=\"right\">\
                                <input type=\"button\" onclick=\"closeConfirmContainer(event);\" value=\"Trở lại\">\
                            </div>\
                        </div>\
                    </form>\
                </div>";
        }
    }

    /*
        Hiển thị alert kiểm tra có muốn khóa hoặc mở khóa cho người dùng không
        $amount (String): Số lượng người dùng
            + "single": Có thể khóa và mở khóa
            + "many": Chỉ có thể khóa
        $id (int): ID của account
        $status (int): Tình trạng của account gồm: 
            + 0 - Ngưng hoạt động
            + 1 - Hoạt động
    */
    function displayLock(amount, id, status) {
        if (amount == "single") {
            var message = "";
            var confirm = "";
            if (status == 0) {
                message = "Bạn có chắc chắn muốn mở khóa người dùng này không?";
                confirm = "Mở khóa";
            } else {
                message = "Bạn có chắc chắn muốn khóa người dùng này không?";
                confirm = "Khóa";
            }
            var container = document.getElementById("confirm-container");
            container.classList.add("active");
            container.innerHTML = "\
                <div class=\"container\">\
                    <form action=\"/faion/action/actionUser.php\" method=\"post\">\
                        <div class=\"confirm-icon-container\">\
                            <div class=\"alert-icon\">\
                                <i class=\"fa-solid fa-exclamation\" style=\"color: #F8BB86;\"></i>\
                            </div>\
                        </div>\
                        <div class=\"message\">" + message + "</div>\
                        <div class=\"btn-container\">\
                            <input type=\"text\" name=\"id\" value=\"" + id + "\">\
                            <div class=\"left\">\
                                <input type=\"submit\" name=\"user-lock-unlock-submit\" value=\"" + confirm + "\">\
                            </div>\
                            <div class=\"right\">\
                                <input type=\"button\" onclick=\"closeConfirmContainer(event);\" value=\"Trở lại\">\
                            </div>\
                        </div>\
                    </form>\
                </div>";
        } else {
            var arr = document.querySelectorAll(".account-checkbox");
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
                var container = document.getElementById("confirm-container");
                container.classList.add("active");
                container.innerHTML = "\
                    <div class=\"container\">\
                        <form action=\"/faion/action/actionUser.php\" method=\"post\">\
                            <div class=\"confirm-icon-container\">\
                                <div class=\"alert-icon\">\
                                    <i class=\"fa-solid fa-exclamation\" style=\"color: #F8BB86;\"></i>\
                                </div>\
                            </div>\
                            <div class=\"message\">Bạn có chắc chắn muốn khóa những người dúng này không?</div>\
                            <div class=\"btn-container\">\
                                <input type=\"text\" name=\"id\" value=\"" + idArr + "\">\
                                <div class=\"left\">\
                                    <input type=\"submit\" name=\"user-lock-submit\" value=\"Khóa\">\
                                </div>\
                                <div class=\"right\">\
                                    <input type=\"button\" onclick=\"closeConfirmContainer(event);\" value=\"Trở lại\">\
                                </div>\
                            </div>\
                        </form>\
                    </div>";
            } else {
                alertMessage("fail", "Bạn chưa chọn người dùng nào!");
            }
        }
    }

    function closeConfirmContainer(e) {
        e.preventDefault();
        document.getElementById("confirm-container").classList.remove("active");
    }

    
</script>
<?php
if ($_GET['choice'] == "product") {
    if (!isset($_GET['id'])) {
        echo "
    <div class=\"content-container\">
    <div class=\"content\">
        <form action=\"/faion/action/actionProduct.php\" method=\"post\" id=\"addProductForm\" enctype=\"multipart/form-data\" onsubmit=\"return checkNewProduct(event)\">
            <div class=\"title\">
                <div class=\"left\">Thêm sản phẩm</div>
                <div class=\"right\"></div>
            </div>
            <div class=\"top\">
                <div class=\"left\">
                    <div class=\"name-container\">
                        <label for=\"pname\">Tên sản phẩm:</label>
                        <input type=\"text\" name=\"name\" id=\"pname\" value=\"\">
                    </div>
                    <div class=\"description-container\">
                        <div id=\"descriptLabel\">
                            <label for=\"pdescription\">Mô tả:</label>
                            <div class=\"note\">\\t: 1 tab, \\2s: 2 khoảng trắng, \\4s: 4 khoảng trắng, \\n: xuống dòng</div>
                        </div>
                        <textarea name=\"description\" id=\"pdescription\" cols=\"50\" rows=\"13\" value=\"\"></textarea>
                    </div>
                    <div class=\"category-container\">
                        <label for=\"pcategory\">Loại áo:</label>
                        <select name=\"category\" id=\"pcategory\">";
        displayCategoryOption(null);
        echo "</select>
                    </div>
                    <div class=\"price-container\">
                        <label for=\"pprice\">Giá:</label>
                        <input type=\"text\" name=\"price\" id=\"pprice\" value=\"\">
                    </div>
                    <div class=\"status-container\">
                        <label for=\"pstatus\">Tình trạng:</label>
                        <select name=\"status\" id=\"pstatus\">
                            <option value=\"1\" selected>Kích hoạt</option>
                            <option value=\"0\">Ngừng kinh doanh</option>
                        </select>
                    </div>
                    <div class=\"quantity-container\">
                        <label for=\"pquantity\">Số lượng:</label>
                        <input type=\"text\" name=\"quantity\" id=\"pquantity\" value=\"\">
                    </div>
                </div>
                <div class=\"right\">
                    <div class=\"image-container\">
                        <img src=\"/faion/img/default/addimg.png\" alt=\"Có lẽ là ảnh về một cái áo\" id=\"pimage\">
                    </div>
                    <div class=\"change-image-container\">
                        <input type=\"file\" name=\"image\" id=\"imageInput\" style=\"display: none;\" onchange=\"previewImage();\">
                        <input type=\"button\" value=\"THÊM ẢNH\" onclick=\"document.getElementById('imageInput').click();\">
                    </div>
                    <div class=\"feature-container\">
                        <label for=\"pfeature\">Sản phẩm nổi bật:</label>
                        <select name=\"feature\" id=\"pfeature\">
                            <option value=\"0\" selected>Không</option>
                            <option value=\"1\">Có</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class=\"bottom\">
                <input type=\"submit\" name=\"add-product-submit\" value=\"THÊM SẢN PHẨM\">
            </div>
        </form>
    </div>
</div>
</div>";
    } else {
        $id = $_GET['id'];
        $arr = array();
        $arr = getProductList();

        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i]->getId() == $id) {
                $product = $arr[$i];
                break;
            }
        }
        echo "
            <div class=\"content-container\">
            <div class=\"content\">
                <form action=\"/faion/action/actionProduct.php\" method=\"post\" id=\"addProductForm\" enctype=\"multipart/form-data\" onsubmit=\"return checkProduct(event)\">
                    <div class=\"title\">
                        <div class=\"left\">Chỉnh sửa sản phẩm</div>
                        <div class=\"right\">
                        <a href=\"/faion/index.php/products?info=$id\">
                            <i class=\"fa-solid fa-shirt\"></i>Đến trang chi tiết sản phẩm
                        </a>
                        </div>
                    </div>
                    <div class=\"top\">
                        <div class=\"left\">
                            <div class=\"name-container\">
                                <label for=\"pname\">Tên sản phẩm:</label>
                                <input type=\"text\" name=\"name\" id=\"pname\" value=\"" . $product->getName() . "\">
                            </div>
                            <div class=\"description-container\">
                                <div id=\"descriptLabel\">
                                    <label for=\"pdescription\">Mô tả:</label>
                                    <div class=\"note\">\\t: 1 tab, \\2s: 2 khoảng trắng, \\4s: 4 khoảng trắng, \\n: xuống dòng</div>
                                </div>
                                <textarea name=\"description\" id=\"pdescription\" cols=\"50\" rows=\"13\">" . $product->getDescription() . "</textarea>
                            </div>
                            <div class=\"category-container\">
                                <label for=\"pcategory\">Loại áo:</label>
                                <select name=\"category\" id=\"pcategory\">";
        displayCategoryOption($product->getCategoryId());
        echo "</select>
                            </div>
                            <div class=\"price-container\">
                                <label for=\"pprice\">Giá:</label>
                                <input type=\"text\" name=\"price\" id=\"pprice\" value=\"" . $product->getPrice() . "\">
                            </div>
                            <div class=\"status-container\">
                                <label for=\"pstatus\">Tình trạng:</label>
                                <select name=\"status\" id=\"pstatus\">
                                    <option value=\"1\" ";
        if ($product->getStatus() == 1) echo "selected";
        echo ">Kích hoạt</option>
                                    <option value=\"0\" ";
        if ($product->getStatus() == 0) echo "selected";
        echo ">Ngừng kinh doanh</option>
                                </select>
                            </div>
                            <div class=\"quantity-container\">
                                <label for=\"pquantity\">Số lượng:</label>
                                <input type=\"text\" name=\"quantity\" id=\"pquantity\" value=\"" . $product->getQuantity() . "\">
                            </div>
                        </div>
                        <div class=\"right\">
                            <div class=\"image-container\">
                                <img src=\"/faion/img/products/" . getImageName($product->getImage()) . "\" alt=\"Có lẽ là ảnh về một cái áo\" id=\"pimage\">
                            </div>
                            <div class=\"change-image-container\">
                                <input type=\"file\" name=\"image\" id=\"imageInput\" style=\"display: none;\" onchange=\"previewImage();\">
                                <input type=\"button\" value=\"ĐỔI ẢNH\" onclick=\"document.getElementById('imageInput').click();\">
                            </div>
                            <div class=\"feature-container\">
                                <label for=\"pfeature\">Sản phẩm nổi bật:</label>
                                <select name=\"feature\" id=\"pfeature\">
                                    <option value=\"1\" ";
            if ($product->getFeature() == 1) echo "selected";
            echo ">Có</option>
                                        <option value=\"0\" ";
            if ($product->getFeature() == 0) echo "selected";
            echo ">Không</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=\"bottom\">
                        <input type=\"text\" name=\"id\" value=\"" . $product->getId() . "\" style=\"display: none;\">
                        <input type=\"submit\" name=\"product-change-submit\" value=\"CHỈNH SỬA SẢN PHẨM\">
                    </div>
                </form>
            </div>
        </div>
        </div>";
    }
}


function getImageName($url)
{
    $name = explode("/", $url);
    $name = $name[count($name) - 1];
    return $name;
}
?>

<script>
    function checkNewProduct(e) {
        var numberRegEx = /^[0-9]+$/;
        var name = document.getElementById("pname");
        var description = document.getElementById("pdescription");
        var price = document.getElementById("pprice");
        var status = document.getElementById("pstatus");
        var quantity = document.getElementById("pquantity");
        var image = document.getElementById("fileInput");

        if (name.value == "" || name.value == undefined || name.value == NaN) {
            alert("Bạn chưa nhập tên sản phẩm!");
            name.focus();
            e.preventDefault();
            return false;
        } else if (price.value == "" || price.value == undefined || price.value == NaN) {
            alert("Bạn chưa nhập giá tiền!");
            price.focus();
            e.preventDefault();
            return false;
        } else if (!numberRegEx.test(price.value) && price.value != "") {
            alert("Giá tiền không hợp lệ!");
            price.focus();
            e.preventDefault();
            return false;
        } else if (quantity.value == "" || quantity.value == undefined || quantity.value == NaN) {
            alert("Bạn chưa nhập số lượng sản phẩm!");
            quantity.focus();
            e.preventDefault();
            return false;
        } else if (!numberRegEx.test(quantity.value) && quantity.value != "") {
            alert("Số lượng sản phẩm không hợp lệ!");
            quantity.focus();
            e.preventDefault();
            return false;
        }
    }

    function previewImage() {
        var imageInput = document.getElementById('imageInput');
        var previewImg = document.getElementById('pimage');
        var file = imageInput.files[0]; // Lấy tệp tin đã chọn

        // Kiểm tra xem người dùng đã chọn tệp tin hay chưa
        if (file) {
            var reader = new FileReader();

            // Đọc dữ liệu hình ảnh từ tệp tin
            reader.onload = function(e) {
                previewImg.src = e.target.result; // Hiển thị hình ảnh
            }

            reader.readAsDataURL(file); // Đọc dữ liệu dưới dạng URL dữ liệu
        } else {
            previewImg.src = '/faion/img/products/no-image1.png'; // Reset hình ảnh nếu không có tệp tin được chọn
        }
    }

    function getImageName(url) {
        var name = str_split(url, "/");
        name = name[name.length - 1];
        return name;
    }
</script>
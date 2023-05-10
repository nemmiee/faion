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
                <span class="breadcrumb-inner-title"><a href="/faion/index.php/products?category=all&page=1">Sản phẩm</a></span>
                <span class="divider"> / </span>
                <span class="breadcrumb-inner-title">
                    <?php
                    // Hiển thị tên sản phẩm trên breadcrumb
                    $kq = mysqli_query($db->getConnection(), "SELECT * FROM product WHERE id=" . $_GET['info']);
                    $product = mysqli_fetch_assoc($kq);
                    echo $product['name'];
                    ?>
                </span>
            </nav>
        </div>
    </div>
</div>

<main>
    <div id="main">
        <div class="left">
            <div class="image-container">
                <img src="<?php echo $product['image']; ?>" alt="">
            </div>
        </div>
        <div class="right">
            <div class="name"><?php echo $product['name']; ?></div>
            <div class="star-rate-sold-container">
                <div class="stars">
                    <form action="">
                        <input class="star star-5" id="star-5" type="radio" name="star" />
                        <label class="star star-5" for="star-5"></label>
                        <input class="star star-4" id="star-4" type="radio" name="star" />
                        <label class="star star-4" for="star-4"></label>
                        <input class="star star-3" id="star-3" type="radio" name="star" />
                        <label class="star star-3" for="star-3"></label>
                        <input class="star star-2" id="star-2" type="radio" name="star" />
                        <label class="star star-2" for="star-2"></label>
                        <input class="star star-1" id="star-1" type="radio" name="star" />
                        <label class="star star-1" for="star-1"></label>
                    </form>
                </div>
                <div class="rate">4.5</div>
                <div class="divide"></div>
                <div class="sold"><?php echo $product['sold']; ?> Đã bán</div>
                <div class="divide"></div>
                <div class="sold"><?php echo $product['quantity']; ?> sản phẩm có sẵn</div>
            </div>
            <div class="price"><?php echo changeMoney($product['price']); ?>₫</div>
            <div class="bottom-info">
                <form method="post" action="/faion/action/actionCart.php" <?php
                                                                    if (!isset($_SESSION['id'])) {
                                                                        echo  "onsubmit=\"return isNotLogin(event)\"";
                                                                    } else
                                                                        echo "onsubmit=\"return checkAddToCartForm(event)\"";
                                                                    ?>>
                    <div class="size-container">
                        <h3>Chọn kích cỡ</h3>
                        <div class="sizeCheck">
                            <label for="sizeS" class="sizeLabel">S
                                <input type="radio" name="size" id="sizeS" value="S" class="pSize" onclick="sizeChoose()">
                            </label>
                        </div>
                        <div class="sizeCheck">
                            <label for="sizeM" class="sizeLabel">M
                                <input type="radio" name="size" id="sizeM" value="M" class="pSize" onclick="sizeChoose()">
                            </label>
                        </div>
                        <div class="sizeCheck">
                            <label for="sizeL" class="sizeLabel">L
                                <input type="radio" name="size" id="sizeL" value="L" class="pSize" onclick="sizeChoose()">
                            </label>
                        </div>
                        <div class="sizeCheck">
                            <label for="sizeXL" class="sizeLabel">XL
                                <input type="radio" name="size" id="sizeXL" value="XL" class="pSize" onclick="sizeChoose()">
                            </label>
                        </div>
                    </div>
                    <div class="color-container">
                        <h3>Chọn màu</h3>
                        <label class="colorLabel">
                            <input type="radio" name="color" id="colorRed" value="red" class="pColor">
                            <div class="colorCheck" id="colorCheckRed"></div>
                        </label>
                        <label class="colorLabel">
                            <input type="radio" name="color" id="colorBlue" value="blue" class="pColor">
                            <div class="colorCheck" id="colorCheckBlue"></div>
                        </label>
                        <label class="colorLabel">
                            <input type="radio" name="color" id="colorYellow" value="yellow" class="pColor">
                            <div class="colorCheck" id="colorCheckYellow"></div>
                        </label>
                        <label class="colorLabel">
                            <input type="radio" name="color" id="colorGreen" value="green" class="pColor">
                            <div class="colorCheck" id="colorCheckGreen"></div>
                        </label>
                    </div>
                    <div class="quantity-container">
                        <button class="quantity" onclick="quantityDown(event)"> − </button>
                        <input type="text" name="quantity" id="pQuantity" value="1" onkeyup="checkQuantity(<?php echo $_GET['info']; ?>, this.value)">
                        <button class="quantity" onclick="quantityUp(event)"> + </button>
                    </div>
                    <input type='hidden' name='id' value= '<?php echo $_GET['info']?>'>
                    <input type='hidden' name='add-cart' value= 'add'>
                    <div class="addToCart-container">
                        <button type="submit" name="addToCart" id="addToCartButton" value="<?php
                                                                                            echo $_GET['info'];
                                                                                            ?>">
                            <i class="fa fa-cart-shopping fa-lg"></i>
                            THÊM VÀO GIỎ
                        </button>
                    </div>
                </form>
                <div class="description-container"><b>Mô tả sản phẩm:</b><br><br>
                    <?php
                    if ($product['description'] != NULL || $product['description'] != "")
                        echo displayDescription($product['description']);
                    //echo $product['description'];
                    else
                        echo "Sản phẩm này không có mô tả.";
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('../faion/file/featureProducts.php');
    ?>
</main>

<script>
    var pQuantity = document.getElementById("pQuantity");

    function checkQuantity(id, value) {
        var xml = new XMLHttpRequest();
        var request = "/faion/action/checkProductQuantity.php?id=" + id + "&quantity=" + value;
        xml.open("GET", request, true);
        xml.onload = function() {
            pQuantity.value = this.responseText;
            pQuantity.innerText = this.responseText;
        }
        xml.send();
    }


    function sizeChoose() {
        var arr = document.getElementsByClassName('size-container')[0].getElementsByClassName('pSize');
        var label = document.querySelectorAll('.sizeLabel');
        for (i = 0; i < arr.length; i++) {
            if (arr[i].checked == true) {
                label[i].classList.add('checked');
            } else {
                label[i].classList.remove('checked');
            }
        }
    }

    function quantityDown(e) {
        e.preventDefault();
        if (document.getElementById("pQuantity").value > 1)
            --document.getElementById("pQuantity").value;
    }

    function quantityUp(e) {
        e.preventDefault();
        ++document.getElementById("pQuantity").value;
    }

    function isNotLogin(e) {
        e.preventDefault();
        alertMessage("warning", "Bạn cần phải đăng nhập để thêm sản phẩm vào giỏ hàng");
    }

    function checkAddToCartForm(e) {
        var quantityRegEx = /^[0-9]+$/;
        var size = document.getElementsByName("size");
        var color = document.getElementsByName("color");
        var quantity = document.getElementById("pQuantity");
        var sizePos = -1;
        for (var i = 0; i < size.length; i++) {
            if (size[i].checked === true) {
                sizePos = i;
            }
        }
        var colorPos = -1;
        for (var i = 0; i < color.length; i++) {
            if (color[i].checked === true) {
                colorPos = i;
            }
        }
        if (sizePos == -1) {
            e.preventDefault();
            alertMessage("warning", "Bạn chưa chọn size");
            return false;
        } else if (colorPos == -1) {
            e.preventDefault();
            alertMessage("warning", "Bạn chưa chọn màu");
            return false;
        } else if (quantity.value <= 0) {
            e.preventDefault();
            alertMessage("warning", "Số lượng sản phẩm phải lớn hơn 0");
            return false;
        } else if (quantity.value == null || quantity.value == undefined) {
            e.preventDefault();
            alertMessage("warning", "Bạn chưa chọn số lượng sản phẩm");
            return false;
        } else if (!quantityRegEx.test(quantity.value)) {
            e.preventDefault();
            alertMessage("warning", "Số lượng sản phẩm không phải là số");
            return false;
        }
    }
</script>
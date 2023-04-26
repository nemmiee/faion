<div id="top-sub-header">    
    <div class="sort-container">
        <label for="sort">Sắp xếp theo</label>
        <select id="sort">
            <option value="default" selected>Ngày thêm</option>
            <option value="priceUp">Giá thấp đến cao</option>
            <option value="priceDown">Giá cao đến thấp</option>
            <option value="quantityUp">Số lượng tăng dần</option>
            <option value="quantityDown">Số lượng giảm dần</option>
        </select>
    </div>
    <div class="sort-container">
        <label for="categoryFilter">Lọc theo thể loại</label>
        <select id="categoryFilter">
            <?php displayCategoryFilterOption();?>
        </select>
    </div>
</div>
<div class="left">
    <div class="table-container">
        <table class="table" cellspacing="0">
            <thead>
                <tr>
                    <th class="checkbox">&nbsp;</th>
                    <th class="product-name">Tên sản phẩm</th>
                    <th class="price">Giá</th>
                    <th class="p-quantity">Số lượng</th>
                    <th class="date">Ngày thêm</th>
                    <th class="trash">&nbsp;</th>
                </tr>
            </thead>
            <tbody id="product-info"> <!-- Hiển thị các hàng thông tin sản phẩm -->
                <?php displayProductTable(); ?>
            </tbody>
        </table>
    </div>
    <a href="/faion/index.php/admin/products?choice=product" class="add-link">
        <div class="button-container">Thêm sản phẩm</div>
    </a>
    <div class="button-container">
        <button class="delete-btn" onclick="displayDelete('product', 'many', 0)">Xóa sản phẩm đã chọn</button>
    </div>
</div>
<div class="right">
    <div class="table-container">
        <table class="table" cellspacing="0">
            <thead>
                <tr>
                    <th class="name">Tên loại áo</th>
                    <th class="trash">&nbsp;</th>
                </tr>
            </thead>
            <tbody id="product-info"> <!-- Hiển thị các hàng tên thể loại -->
                <?php displayCategoryTable(); ?>
            </tbody>
        </table>
    </div>
    <div class="button-container">
        <button class="delete-btn" onclick="displayAndHideCategoryForm()">Thêm thể loại</button>
    </div>
</div>

<script>
    var sort = document.getElementById("sort");
    var category = document.getElementById("categoryFilter");
    sort.addEventListener("change", function() {
        var request = "sortBy=" + sort.value;
        var xml = new XMLHttpRequest();
        xml.open("POST", "/faion/action/actionSortProductAdmin.php", true);
        xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xml.onreadystatechange = function() {
            if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
                category.value = "date";
                document.querySelectorAll("#product-info")[0].innerHTML = this.responseText;
            }
        };
        xml.send(request);
    });

    category.addEventListener("click", function() {
        var request = "category=" + category.value;
        var xml = new XMLHttpRequest();
        xml.open("POST", "/faion/action/actionSortProductAdmin.php", true);
        xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                sort.value = "default";
                document.querySelectorAll("#product-info")[0].innerHTML = this.responseText;
            }
        }
        xml.send(request);
    });
</script>

<?php
// Hàm hiển thị các dòng thông tin product trong table
function displayProductTable()
{
    $productArr = getProductList();
    for ($i = 0; $i < count($productArr); $i++) {
        echo "
        <tr>
            <th class=\"checkbox\">
                <input type=\"checkbox\" class=\"checkbox-check\" value=\""
            . $productArr[$i]->getId() . "\">
            </th>
            <td class=\"name\">
                <a href=\"/faion/index.php/admin/products?choice=product&id="
            . $productArr[$i]->getId() . "\">" . $productArr[$i]->getName() .
            "</a>
            </td>
            <td class=\"price\">" . changeMoney($productArr[$i]->getPrice()) . "₫</td>
            <td class=\"p-quantity\">" . $productArr[$i]->getQuantity() . "</td>
            <td class=\"date\">" . getDMYdate(getDateCreated($productArr[$i]->getCreatedAt())) . "</td>
            <td class=\"trash\">
                <i class=\"fa-solid fa-trash-can fa-fw fa-lg\" 
                onclick=\"displayDelete('product', 'single', " . $productArr[$i]->getId() . ")\">
                </i>
            </td>
        </tr>";
    }
}

function displayCategoryFilterOption() {
    echo "<option value=\"date\" selected>Mặc định</option>";  
    echo "<option value=\"default\">Default</option>";                
    $categoryList = getCategoryList();
    for ($i = 1; $i < count($categoryList); $i++) {
        echo "<option value=\"" . $categoryList[$i]->getId() . "\">" . $categoryList[$i]->getName() . "</option>";
    }
}
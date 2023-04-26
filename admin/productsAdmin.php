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
            <tbody id="product-info">
                <?php displayProductTable() ?>
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
            <tbody id="product-info">
                <?php displayCategoryTable(); ?>
            </tbody>
        </table>
    </div>
    <div class="button-container">
        <button class="delete-btn" onclick="displayAndHideCategoryForm()">Thêm thể loại</button>
    </div>
</div>



<?php
function displayProductTable()
{
    $db = new Database();
    // mysqli_query($db->getConnection(), "set names 'utf-8'");
    $kq = mysqli_query($db->getConnection(), "SELECT * FROM product");
    $productArr = array();
    while ($row = mysqli_fetch_assoc($kq)) {
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
        $productArr[] = $product;
    }
    sort($productArr);
    for ($i = 0; $i < count($productArr); $i++) {
        echo "
        <tr>
            <th class=\"checkbox\"><input type=\"checkbox\" class=\"checkbox-check\" value=\"" . $productArr[$i]->getId() . "\"></th>
            <td class=\"name\"><a href=\"/faion/index.php/admin/products?choice=product&id=" . $productArr[$i]->getId() . "\">" . $productArr[$i]->getName() . "</a></td>
            <td class=\"price\">" . changeMoney($productArr[$i]->getPrice()) . "₫</td>
            <td class=\"p-quantity\">" . $productArr[$i]->getQuantity() . "</td>
            <td class=\"date\">" . getDateCreated($productArr[$i]->getCreatedAt()) . "</td>
            <td class=\"trash\"><i class=\"fa-solid fa-trash-can fa-fw fa-lg\" onclick=\"displayDelete('product', 'single', " . $productArr[$i]->getId() . ")\"></i></td>
        </tr>";
    }
    $db->disconnect();
}

function displayCategoryTable()
{
    $db = new Database();
    // mysqli_query($db->getConnection(), "set names 'utf-8'");
    $kq = mysqli_query($db->getConnection(), "SELECT * FROM category WHERE id <> 0");
    $categoryArr = array();
    while ($row = mysqli_fetch_assoc($kq)) {
        $category = new Category(
            $row['id'],
            $row['name']
        );
        $categoryArr[] = $category;
    }
    sort($categoryArr);
    for ($i = 0; $i < count($categoryArr); $i++) {
        echo "
        <tr>            
            <td class=\"name\"><a href=\"/faion/index.php/admin/products?choice=category&id=" . $categoryArr[$i]->getId() . "\">" . $categoryArr[$i]->getName() . "</a></td>
            <td class=\"trash\"><i class=\"fa-solid fa-trash-can fa-fw fa-lg\" onclick=\"displayDelete('category', 'single', " . $categoryArr[$i]->getId() . ")\"></i></td>
        </tr>";
    }
    $db->disconnect();
}

function getDateCreated($date)
{
    $date = explode(" ", $date);
    return $date[0];
}

?>
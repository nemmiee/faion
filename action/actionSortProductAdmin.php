<?php
include ('../../faion/connection/Database.php');
include ('../../faion/object/Product.php');
include ('../../faion/object/Category.php');
if (isset($_POST['sortBy']) && !empty($_POST['sortBy'])) {    
    $sortBy = $_POST['sortBy'];
    switch ($sortBy) {
        case "default": {
            echo displayProductTable(getProductList());
        } break;
        case "priceUp": {
            echo displayProductTable(sortByPriceUp());
        } break;
        case "priceDown": {
            echo displayProductTable(sortByPriceDown());
        } break;
        case "quantityUp": {
            echo displayProductTable(sortByQuantityUp());
        } break;
        case "quantityDown": {
            echo displayProductTable(sortByQuantityDown());
        } break;
    }
} else if (isset($_POST['category']) && !empty($_POST['category'])) {
    $category = $_POST['category'];
    if ($category == "date") {
        echo displayProductTable(getProductList());
    } else if ($category == "default") {
        echo displayProductTable(getProductFilterByCategory(0));
    } else {
        $categoryList = getCategoryList();
        for ($i = 1; $i < count($categoryList); $i++) {
            if ($categoryList[$i]->getId() == $category) {
                echo displayProductTable(getProductFilterByCategory($category));
                break;
            }
        }
    }
}

// Hàm hiển thị các dòng thông tin product trong table
function displayProductTable($productArr)
{
    $content = "";
    for ($i = 0; $i < count($productArr); $i++) {
        $content .= "
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
    return $content;
}

function sortByPriceUp() {
    $productList = getProductList();
    $min = -1;
    for ($i = 0; $i < count($productList) - 1; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < count($productList); $j++) {
            if ($productList[$min]->getPrice() > $productList[$j]->getPrice()) {
                $min = $j;
            }
        }
        if ($min != $i) {
            $temp = $productList[$i];
            $productList[$i] = $productList[$min];
            $productList[$min] = $temp;
        }
    }
    return $productList;
}

function sortByPriceDown() {
    $productList = getProductList();
    $max = -1;
    for ($i = 0; $i < count($productList) - 1; $i++) {
        $max = $i;
        for ($j = $i + 1; $j < count($productList); $j++) {
            if ($productList[$max]->getPrice() < $productList[$j]->getPrice()) {
                $max = $j;
            }
        }
        if ($max != $i) {
            $temp = $productList[$i];
            $productList[$i] = $productList[$max];
            $productList[$max] = $temp;
        }
    }
    return $productList;
}

function sortByQuantityUp() {
    $productList = getProductList();
    $min = -1;
    for ($i = 0; $i < count($productList) - 1; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < count($productList); $j++) {
            if ($productList[$min]->getQuantity() > $productList[$j]->getQuantity()) {
                $min = $j;
            }
        }
        if ($min != $i) {
            $temp = $productList[$i];
            $productList[$i] = $productList[$min];
            $productList[$min] = $temp;
        }
    }
    return $productList;
}

function sortByQuantityDown() {
    $productList = getProductList();
    $max = -1;
    for ($i = 0; $i < count($productList) - 1; $i++) {
        $max = $i;
        for ($j = $i + 1; $j < count($productList); $j++) {
            if ($productList[$max]->getQuantity() < $productList[$j]->getQuantity()) {
                $max = $j;
            }
        }
        if ($max != $i) {
            $temp = $productList[$i];
            $productList[$i] = $productList[$max];
            $productList[$max] = $temp;
        }
    }
    return $productList;
}

function getProductFilterByCategory($id) {
    $productList = getProductList();
    $list = array();
    for ($i = 0; $i < count($productList); $i++) {
        if ($productList[$i]->getCategoryId() == $id) {
            $list[] = $productList[$i];
        }
    }
    return $list;
}

function getProductList()
{
	$db = new Database();
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
			$row['feature'],
			$row['created_at']
		);
		$productArr[] = $product;
	}
	sort($productArr);
	return $productArr;
}

function getCategoryList()
{
	$db = new Database();
	$kq = mysqli_query($db->getConnection(), "SELECT * FROM category");
	$list = array();
	while ($row = mysqli_fetch_assoc($kq)) {
		$category = new Category($row['id'], $row['name']);
		$list[] = $category;
	}
	$db->disconnect();
	return $list;
}

function changeMoney($moneyIn)
{
	$arr = array();
	$arr = str_split($moneyIn, 1);
	$count = 0;
	$temp = "";
	for ($i = count($arr) - 1; $i >= 0; $i--) {
		++$count;
		if ($count % 3 == 0 && $i > 0) {
			$temp .= $arr[$i];
			$temp .= ".";
			continue;
		}
		$temp .= $arr[$i];
	}
	// Đảo ngược chuỗi
	$moneyOut = "";
	$count = 0;
	$arr = str_split($temp, 1);
	for ($i = count($arr) - 1; $i >= 0; --$i) {
		$moneyOut .= $arr[$i];
		$count++;
	}
	return $moneyOut;
}

function getDMYdate($date)
{
	$arr = explode("-", $date);
	$newArr = array();
	for ($i = count($arr) - 1; $i >= 0; $i--) {
		$newArr[] = $arr[$i];
	}
	$newDate = "";
	for ($i = 0; $i < count($newArr); $i++) {
		$newDate .= $newArr[$i];
		if ($i != count($newArr) - 1)
			$newDate .= "/";
	}
	return $newDate;
}

function getDateCreated($date)
{
    $date = explode(" ", $date);
    return $date[0];
}


?>
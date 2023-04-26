<?php
include ('../faion/connection/Database.php');
include ('../faion/object/Account.php');
include ('../faion/object/Category.php');
include ('../faion/object/Customer.php');
include ('../faion/object/Product.php');

/*
	Hàm chuyển đỗi chuỗi số thành tiền
	VD: 3000000
	Result => 3.000.000
*/
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

// Hiển thị các lựa chọn thể loại trong phần tử option trong trang admin productDetail
function displayCategoryOption($id)
{
	$db = new Database();
	$kq = mysqli_query($db->getConnection(), "SELECT * FROM category");
	$categoryArr = array();
	while ($row = mysqli_fetch_assoc($kq)) {
		$category = new Category(
			$row['id'],
			$row['name']
		);
		$categoryArr[] = $category;
	}
	sort($categoryArr);

	if ($id == null || $id == "") {
		for ($i = 0; $i < count($categoryArr); $i++) {
			if ($categoryArr[$i]->getId() != 0) {
				echo "<option value=\"" . $categoryArr[$i]->getId() .
					"\" class=\"category-option\">" . $categoryArr[$i]->getName() .
					"</option>";
			}
		}
	} else {
		if ($id != 0) { // Trường hợp category của sản phẩm khác Default
			for ($i = 0; $i < count($categoryArr); $i++) {
				if ($categoryArr[$i]->getId() != 0) {
					if ($id == $categoryArr[$i]->getId()) {
						echo "<option value=\"" . $categoryArr[$i]->getId() .
							"\" class=\"category-option\" selected>" . $categoryArr[$i]->getName() .
							"</option>";
					} else {
						echo "<option value=\"" . $categoryArr[$i]->getId() .
							"\" class=\"category-option\">" . $categoryArr[$i]->getName() .
							"</option>";
					}
				}
			}
		} // Trường hợp category của sản phẩm là Default
		else {
			for ($i = 0; $i < count($categoryArr); $i++) {
				if ($id == $categoryArr[$i]->getId()) {
					echo "<option value=\"" . $categoryArr[$i]->getId() .
						"\" class=\"category-option\" selected>" . $categoryArr[$i]->getName() .
						"</option>";
				} else {
					echo "<option value=\"" . $categoryArr[$i]->getId() .
						"\" class=\"category-option\">" . $categoryArr[$i]->getName() .
						"</option>";
				}
			}
		}
	}
	$db->disconnect();
}

// Lấy mảng sản phẩm
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
	$db->disconnect();
	return $productArr;
}

// Lấy mảng thể loại
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

// Lấy mảng khách hàng
function getCustomerList()
{
	$db = new Database();
	$kq = mysqli_query($db->getConnection(), "SELECT * FROM customer");
	$list = array();
	while ($row = mysqli_fetch_assoc($kq)) {
		$customer = new Customer(
			$row['id'],
			$row['name'],
			$row['email'],
			$row['address'],
			$row['phone_number'],
			$row['created_at']
		);
		$list[] = $customer;
	}
	$db->disconnect();
	return $list;
}

// Lấy mảng tài khoản
function getAccountList()
{
//	include('../faion/object/Account.php');
	$db = new Database();
	$kq = mysqli_query($db->getConnection(), "SELECT * FROM account");
	$list = array();
	while ($row = mysqli_fetch_assoc($kq)) {
		$account = new Account(
			$row['id'],
			$row['username'],
			$row['password'],
			$row['status'],
			$row['role']
		);
		$list[] = $account;
	}
	$db->disconnect();
	return $list;
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

/* 
Hàm lấy ngày từ chuỗi. 
VD: 2022-02-01 19:48:25 
Result => 2022-02-01
*/
function getDateCreated($date)
{
    $date = explode(" ", $date);
    return $date[0];
}

// Hàm hiển thị các dòng thể loại trong table
function displayCategoryTable()
{
    $db = new Database();
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
        // echo "
        // <tr>            
        //     <td class=\"name\">
        //         <a href=\"/faion/index.php/admin/products?choice=category&id=" 
        //         . $categoryArr[$i]->getId() . "\">" . $categoryArr[$i]->getName() . 
        //         "</a>
        //     </td>
        //     <td class=\"trash\">
        //         <i class=\"fa-solid fa-trash-can fa-fw fa-lg\" 
        //         onclick=\"displayDelete('category', 'single', " . $categoryArr[$i]->getId() . ")\">
        //         </i>
        //     </td>
        // </tr>";
		echo "
        <tr>            
            <td class=\"name\"><a>" . $categoryArr[$i]->getName() . "</a>
            </td>
            <td class=\"trash\">
                <i class=\"fa-solid fa-trash-can fa-fw fa-lg\" 
                onclick=\"displayDelete('category', 'single', " . $categoryArr[$i]->getId() . ")\">
                </i>
            </td>
        </tr>";
    }
    $db->disconnect();
}

// Hàm hiển thị description ở trang chi tiết sản phẩm
function displayDescription($data) {
    $data = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;", $data); // 1 tab
    $data = str_replace("\n", "<br>", $data); // 1 dòng
    $data = str_replace("\2s", "&ensp;", $data); // 2 khoảng trắng
    $data = str_replace("\4s", "&emsp;", $data); // 4 khoảng trắng
    return $data;
}
?>

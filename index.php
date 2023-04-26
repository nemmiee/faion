<?php
session_start();
ob_start();
?>

<!DOCTYPE html>

<html>

<head>
	<title>Faion - Fashion For Life</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="../faion/img/Logo/Faion_icon.png" type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
	<link rel="stylesheet" href="/faion/css/user/style.css">
	<?php
	$uri = $_SERVER['REQUEST_URI'];
	$temp = explode("/", $uri);
	$page = $temp[count($temp) - 2];
	$productRegEx = "/products?[a-zA-Z0-9=&]{1,}/";
	$adminRegEx = '/\badmin\b/';
	if (!preg_match($adminRegEx, $uri)) {
		if (preg_match($productRegEx, $temp[count($temp) - 1])) {
			if (isset($_GET['category']) && isset($_GET['page'])) {
				// Trang hiển thị trang sản phẩm
				echo "<link rel='stylesheet' href='/faion/css/user/products.css'>";
				echo "<script src='/faion/js/product_js.js' defer></script>";
			} else {
				// Trang thông tin chi tiết sản phẩm
				echo "<link rel='stylesheet' href='/faion/css/user/productInfo.css'>";
			}
		} else {
			switch ($page) {
				case "index.php":
					echo "<link rel='stylesheet' href='/faion/css/user/main.css'>";
					echo "<script src='/faion/js/main.js' defer></script>";
					break;
				case "sizeguide":
					echo "<link rel='stylesheet' href='/faion/css/user/sizeguide.css'>";
					break;
				case "contact":
					echo '<link rel="stylesheet" href="/faion/css/user/contact.css">';
					break;
				case "login":
					echo "<link rel='stylesheet' href='/faion/css/user/login.css'>";
					break;
				case "signup":
					echo "<link rel='stylesheet' href='/faion/css/user/signup.css'>";
					break;
				case "cart":

					break;
			}
		}
	} else {
		echo "<link rel='stylesheet' href='/faion/css/admin/style.css'>";
		if (preg_match($productRegEx, $temp[count($temp) - 1])) {
			echo "<link rel='stylesheet' href='/faion/css/admin/productDetail.css'>";
		} else {
			switch ($page) {
				case "products":
					echo "<link rel='stylesheet' href='/faion/css/admin/product.css'>";
					break;
				case "orders":
					echo "<link rel='stylesheet' href='/faion/css/admin/order.css'>";
					break;
				case "customers":
					// echo "<link rel='stylesheet' href='/faion/css/admin/customer.css'>";
					break;
				case "users":
					// echo "<link rel='stylesheet' href='/faion/css/admin/user.css'>";
					break;
				case "theme":
					// echo "<link rel='stylesheet' href='/faion/css/admin/theme.css'>";
					break;
			}
		}
	}
	?>
</head>

<body>
	<!-- Alert -->
	<div id="alert-theme" onclick="closeAlert()">
		<div id="alert-container">
			<div class="alert-icon-container">
				<div class="alert-icon"></div>
			</div>
			<div class="type-message"></div>
			<div class="message"></div>
			<div class="confirm-container">
				<button id="confirm-btn">OK</button>
			</div>
		</div>
	</div>
	<?php
	include('../faion/object/Product.php');
	include('../faion/object/Category.php');

	/* Header */
	include('../faion/template/header.php');
	/* Sidebar */
	include('../faion/template/sidebar.php');
	/* Content */
	include('../faion/template/content.php');
	/* Footer */
	include('../faion/template/footer.php');
	?>

	<script src="/faion/js/script.js"></script>
	<script src="/faion/js/find.js"></script>
</body>

<?php
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
	// Dao nguoc chuoi
	$moneyOut = "";
	$count = 0;
	$arr = str_split($temp, 1);
	for ($i = count($arr) - 1; $i >= 0; --$i) {
		$moneyOut .= $arr[$i];
		$count++;
	}
	return $moneyOut;
}

function displayCategoryOption($id)
{
	$db = new Database();
	// mysqli_query($db->getConnection(), "set names 'utf-8'");
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
				echo "
				<option value=\"" . $categoryArr[$i]->getId() . "\" class=\"category-option\">"
					. $categoryArr[$i]->getName() . "</option>";
			}
		}
	} else {
		// Trường hợp category của sản phẩm khác Default
		if ($id != 0) {
			for ($i = 0; $i < count($categoryArr); $i++) {
				if ($categoryArr[$i]->getId() != 0) {
					if ($id == $categoryArr[$i]->getId()) {
						echo "<option value=\"" . $categoryArr[$i]->getId() . "\" class=\"category-option\" selected>" . $categoryArr[$i]->getName() . "</option>";
					} else {
						echo "<option value=\"" . $categoryArr[$i]->getId() . "\" class=\"category-option\">" . $categoryArr[$i]->getName() . "</option>";
					}
				}
			}
		} // Trường hợp category của sản phẩm là Default
		else {
			for ($i = 0; $i < count($categoryArr); $i++) {
				if ($id == $categoryArr[$i]->getId()) {
					echo "<option value=\"" . $categoryArr[$i]->getId() . "\" class=\"category-option\" selected>" . $categoryArr[$i]->getName() . "</option>";
				} else {
					echo "<option value=\"" . $categoryArr[$i]->getId() . "\" class=\"category-option\">" . $categoryArr[$i]->getName() . "</option>";
				}
			}
		}
	}
	$db->disconnect();
}


function getProductList()
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
	return $productArr;
}

function getCategoryList() {
	$db = new Database();
	// mysqli_query($db->getConnection(), "set names 'utf-8'");
	$kq = mysqli_query($db->getConnection(), "SELECT * FROM category");
	$list = array();
	while ($row = mysqli_fetch_assoc($kq)) {
		$category = new Category($row['id'], $row['name']);
		$list[] = $category;
	}
	sort($list);
	return $list;
}
?>

</html>
<?php
session_start();
ob_start();
?>

<!DOCTYPE html>

<html>

<head>
	<title>Faion - Fashion For Life</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="/faion/img/Logo/Faion_icon.png" type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="/faion/css/user/style.css">
	<script defer src="/faion/js/script.js"></script>

	<?php
	include('../faion/action/actionFunction.php');
	$uri = $_SERVER['REQUEST_URI'];
	$temp = explode("/", $uri);
	$page = $temp[count($temp) - 2]; // Lấy tên của trang hiện tại trên URL
	// Regex kiểm tra URL của trang đó có sử dụng truy vấn không
	$productRegEx = "/products?[a-zA-Z0-9=&]{1,}/";
	$customerRegEx = "/customers?[a-zA-Z0-9=&]{1,}/";
	$userRegEx = "/users?[a-zA-Z0-9=&]{1,}/";
	// Kiểm tra có chuỗi admin trên URL
	$adminRegEx = '/\badmin\b/';
	if (!preg_match($adminRegEx, $uri)) { // Giao diện khi chưa vào trang admin
		//echo "<script async src=\"/faion/js/script.js\"></script>";
		if (preg_match($productRegEx, $temp[count($temp) - 1])) {
			if (isset($_GET['category']) && isset($_GET['page'])) {
				// Trang hiển thị sản phẩm
				echo "<link rel='stylesheet' href='/faion/css/user/products.css'>";
				echo "<script src='/faion/js/product_js.js' defer></script>";
			} else {
				// Trang thông tin chi tiết sản phẩm
				echo "<link rel='stylesheet' href='/faion/css/user/productInfo.css'>";
				echo "<link rel='stylesheet' href='/faion/css/user/featureProducts.css'>";
			}
		} if (preg_match("/search?/", $temp[count($temp) - 1])) {
				echo "<link rel='stylesheet' href='/faion/css/user/search.css'>";
		} else {
			switch ($page) {
				case "index.php":
					echo "<link rel='stylesheet' href='/faion/css/user/main.css'>";
					echo "<link rel='stylesheet' href='/faion/css/user/featureProducts.css'>";
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
				case "info":
					echo "<link rel='stylesheet' href='/faion/css/user/userInfo.css'>";
					echo "<link rel='stylesheet' href='/faion/css/admin/style.css'>";
					echo "<link rel='stylesheet' href='/faion/css/admin/customerDetail.css'>";
					break;
				case "account":
					echo "<link rel='stylesheet' href='/faion/css/user/userInfo.css'>";
					echo "<link rel='stylesheet' href='/faion/css/admin/style.css'>";
					echo "<link rel='stylesheet' href='/faion/css/admin/userDetail.css'>";
					break;
				case "orders":
					echo "<link rel='stylesheet' href='/faion/css/user/userInfo.css'>";
					echo "<link rel='stylesheet' href='/faion/css/admin/style.css'>";
					echo "<link rel='stylesheet' href='/faion/css/admin/userDetail.css'>";
					echo "<link rel='stylesheet' href='/faion/css/admin/order.css'>";
					break;
			}
		}
	} else { // Giao diện khi vào trang admin
		//echo "<script src=\"/faion/js/script.js\" defer></script>";
		echo "<link rel='stylesheet' href='/faion/css/admin/style.css'>";
		if (preg_match($productRegEx, $temp[count($temp) - 1])) {
			// CSS của trang admin productDetail
			echo "<link rel='stylesheet' href='/faion/css/admin/productDetail.css'>";
		} else if (preg_match($customerRegEx, $temp[count($temp) - 1])) {
			// CSS của trang admin customerDetail
			echo "<link rel='stylesheet' href='/faion/css/admin/customerDetail.css'>";
		} else if (preg_match($userRegEx, $temp[count($temp) - 1])) {
			// CSS của trang admin userDetail
			echo "<link rel='stylesheet' href='/faion/css/admin/userDetail.css'>";
		} else { // 
			switch ($page) {
				case "products":
					echo "<link rel='stylesheet' href='/faion/css/admin/product.css'>";
					break;
				case "orders":
					echo "<link rel='stylesheet' href='/faion/css/admin/order.css'>";
					break;
				case "customers":
					echo "<link rel='stylesheet' href='/faion/css/admin/customer.css'>";
					break;
				case "users":
					echo "<link rel='stylesheet' href='/faion/css/admin/user.css'>";
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
	/* Header */
	include('../faion/template/header.php');
	/* Sidebar */
	include('../faion/template/sidebar.php');
	/* Content */
	include('../faion/template/content.php');
	/* Footer */
	include('../faion/template/footer.php');
	?>
	
</body>


</html>
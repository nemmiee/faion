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
	<link rel="stylesheet" href="/faion/css/style.css">
	<?php

	$uri = $_SERVER['REQUEST_URI'];
	$temp = explode("/", $uri);
	$page = $temp[count($temp) - 2];
	$regEx = "/products?[a-zA-Z0-9=&]{1,}/";
	if (preg_match($regEx, $temp[count($temp) - 1])) {
		echo "<link rel='stylesheet' href='/faion/css/products.css'>";
		echo "<script src='/faion/js/product_js.js' defer></script>";
	} else {
		switch ($page) {
			case "sizeguide":
				echo "<link rel='stylesheet' href='/faion/css/sizeguide.css'>";
				break;
			case "contact":
				echo '<link rel="stylesheet" href="/faion/css/contact.css">';
				break;
			case "login":
				echo "<link rel='stylesheet' href='/faion/css/login.css'>";
				echo "<script src='/faion/js/account.js' defer></script>";
				break;
			case "cart":
				break;
			case "signup":
				echo "<link rel='stylesheet' href='/faion/css/signup.css'>";
				break;
			default:
				echo "<link rel='stylesheet' href='/faion/css/main.css'>";
				echo "<script src='/faion/js/main.js' defer></script>";
		}
	}
	?>
	<script src="/faion/js/script.js" defer></script>
	<script src="/faion/js/find.js" defer></script>
	<script src="/faion/js/cart.js" defer></script>
</head>

<body>
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
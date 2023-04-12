<?php
$temp = explode("/", $uri);
$page = $temp[count($temp) - 2];
//echo "<br><script>window.alert('" . $temp[count($temp) - 2] . "'); </script>";
$regEx = "/products?[a-zA-Z0-9=&]{1,}/";
if (preg_match($regEx, $temp[count($temp) - 1])) {
    include('../faion/File/products.php');
} else {
    switch ($page) {
        case "index.php":
            include('../faion/File/mainpage.php');
            break;
        case "sizeguide":
            include('../faion/File/sizeguide.php');
            break;
        case "contact":
            include('../faion/File/contact.php');
            break;
        case "login":
            include('../faion/File/login.php');
            break;
        case "signup":
            include('../faion/File/signup.php');
            break;
        case "cart":
            echo "Cart";
            break;
        case "admin":
            echo "Admin";
            break;
    }
}

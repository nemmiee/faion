<?php
include ('../../faion/connection/Database.php') ;
include ('../../faion/object/Product.php');

if (isset($_GET['id']) && isset($_GET['quantity'])) {
    $id = $_GET['id'];
    $quantity = $_GET['quantity'];
    $productList = getProductList();
    $pos = -1;
    for ($i = 0; $i < count($productList); $i++) {
        if ($productList[$i]->getId() == $id) {
            $pos = $i;
            break;
        }
    }
    $numberOnlyRegex = "/^[0-9]*$/";
    if (preg_match($numberOnlyRegex, $quantity)) {
        if ($quantity <= 0) {
            echo 1;
        } else if ($quantity > $productList[$pos]->getQuantity()) {
            echo $productList[$pos]->getQuantity();
        } else {
            echo $quantity;
        }
    } else {
        echo 1;
    }
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
	$db->disconnect();
	return $productArr;
}
?>
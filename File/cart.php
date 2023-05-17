<?php
if (isset($_SESSION['id'])) {
?>
	<body onload='changeTotal()'>
		<main id="content">
			<form method="POST" action="/faion/action/actionCart.php">
				<div class="element">
					<div id="cart" class="progress"><span>Giỏ hàng<span></div>
				</div>
				<div id="pcart">
					<div id="sym">
						<table id='cart'>
							<thead>
								<tr>
									<th>Tên sản phẩm</th>
									<th>Kích cỡ</th>
									<th>Số lượng</th>
									<th>Giá</th>
									<th></th>

								</tr>
							</thead>
							<tbody>
								<?php
								if (isset($_SESSION['cart'])) {
									foreach ($_SESSION['cart'] as $key) {
										echo "
			<tr>
							
					<td>" . $key['name'] . "</td>
					<td class=\"size\">" . $key['size'] . "</td>
					<td style = \"text-align:center;\">
						<input class = \"quantity\" min=\"1\" max=\"" . getQuantity($key['product_id']) . "\" 
						onchange=\"changeTotal();\" style =\"text-align:center;width:30%;\"type=\"number\" 
						value =\"" . $key['quantity'] . "\" name=\"quantity[]\">
					</td>
					<td class=\"price\" style=\"text-align: center;\">" . $key['price'] . "</td>
					<td><input type=\"submit\" name=\"delete\" class =\"button\" value=\"Xóa\">
					<input type=\"hidden\" name=\"DeleteKey\" value=" . $key['key'] . "></td>
				
			</tr>";
									}
								}
								?>
							</tbody>
						</table>
					</div>
					<div id="product_cart"></div>
				</div>

				<div id="money">
					<div class="who">
						<div class="icon"><img id="logo-image" src="/faion/img/Logo/Faion_remove_background.png" alt="Logo"></div>
					</div>
					<div class="sum" id="total">
						<p class="impo">Tổng tiền: </p>
						<div id="cost" value=></div>
					</div>
					<div class="buynow">
						<input type="submit" class="button" value="MUA NGAY" name="confirm-cart"></button>
						<input type="submit" class="button" value="HỦY GIỎ HÀNG" name="delete-cart"></button>
					</div>
			</form>
		</main>
	</body>

<?php
} else {
	echo "HELLO";
	echo "
	<script>
		window.alert('Bạn cần phải đăng nhập mới dùng được giỏ hàng');
		window.location = '/faion/index.php/login/';
	</script>";
}

function getQuantity($id)
{
	$productList = getProductList();
	for ($i = 0; $i < count($productList); $i++) {
		if ($productList[$i]->getId() == $id) {
			return $productList[$i]->getQuantity();
		}
	}
}
?>

<script type="text/javascript">
	function changeTotal() {
		total = 0;
		var iprice = document.getElementsByClassName('price');
		var iquantity = document.getElementsByClassName('quantity');
		for (i = 0; i < iprice.length; i++) {
			total += parseInt(iprice[i].innerHTML) * parseInt(iquantity[i].value);
		}
		document.getElementById('cost').innerHTML = total;
	}
</script>
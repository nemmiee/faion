
 

<!DOCTYPE html>

<html>

<head>
	<title>Giỏ Hàng- FAION</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="../img/Logo/Faion_icon.png" type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
	<link rel="stylesheet" href="../css/style_product.css">
	<link rel="stylesheet" href="../css/style_acc.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/cart.css">
	<script src="../js/script.js" defer></script>
	<script src="../js/cart.js" defer></script>
	<script src="../js/account.js" defer></script>
	<script src="../js/find.js" defer></script>
	<script src="../js/product_js.js" defer></script>
	<script src="/js/product_js.js"></script>
	<script type="text/javascript">
					function changeTotal(){
    total = 0;
    var iprice = document.getElementsByClassName('price');
    var iquantity = document.getElementsByClassName('quantity');
    for(i=0;i<iprice.length;i++){
            total +=parseInt(iprice[i].innerHTML)*parseInt(iquantity[i].value);
    }
	
    document.getElementById('cost').innerHTML=total;
}

				</script>
</head>



<body onload = 'changeTotal()'>

	<main id="content">
			
	<form method="POST" action="/faion/action/actionCart.php">
		<div class="element">
			<div id="cart" class="progress" ><span>Giỏ hàng<span></div>
			
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
	if(isset($_SESSION['cart'])){

		foreach($_SESSION['cart'] as $key){
			echo "
			<tr><form method=\"POST\" action=\"/faion/action/actionCart.php\">
				
				<td>" . $key['name'] . "</a></td>
				<td class=\"size\">" . $key['size'] . "</td>
				<td style = \"text-align:center;\"><input class = \"quantity\" min=\"1\" max=\"10\" onchange=\"changeTotal();\" 
				style =\"text-align:center;width:30%;\"type=\"number\" value =\"" . $key['quantity'] . "\" name=\"quantity[]\"></td>
				<td class=\"price\" style=\"text-align: center;\">" . $key['price'] . "</td>
				<td><input type=\"submit\" name=\"delete\" class =\"button\" value=\"Xóa\">
				<input type=\"hidden\" name=\"key\" value=".$key['key'].">
				</form>
			</tr>
			";
		}
	}
	?>
</tbody>
</table>
			</div>
			<div id="product_cart"></div>
		</div>

		<div id="money">
			<div class="sum" id="total">
				<p class="impo">Tổng tiền: </p>
				<div id="cost" value=> 

				
				</div>
				
			</div>
			<div class="buynow">
				<input type="submit" class="button" value="MUA NGAY" name="confirm-cart"></button>
				<input type="submit" class="button" value="HỦY GIỎ HÀNG" name="delete-cart"></button>
			</div>
				</form>
			<!--waitting-->
		</div>
		<div id="product_show"></div>
		
	</main>

	<footer>
		<div id="footer">
			<div id="top-footer">
				<div class="top-footer-menu">
					<img id="top-footer-menu-img" src="/img/Logo/Faion_remove_background.png" alt="Faion">
					<p><i class="fa-solid fa-location-dot fa-fw top-footer-icon"></i>Địa chỉ: 273 An Dương Vương, P3,
						Quận 5, TP.HCM</p>
					<p><i class="fa-regular fa-envelope fa-fw top-footer-icon"></i>Email: <a
							href="mailto:nthnam.a1.c3tqcap@gmail.com">nthnam.a1.c3tqcap@gmail.com</a></p>
					<p><i class="fa-solid fa-phone fa-fw top-footer-icon"></i>Điện thoại: 038 2358 823</p>
				</div>
				<div class="top-footer-menu">
					<h3>Danh mục</h3>
					<a href="#">Tìm kiếm</a>
					<a href="/File/sizecheck.html">Kiểm tra size áo</a>
					<a href="/File/contact.html">Liên hệ</a>
				</div>
				<div class="top-footer-menu" id="top-footer-menu-category"></div>
				<div class="top-footer-menu">
					<h3>Đăng ký nhận tin</h3>
					<form action="">
						<div id="top-footer-menu-input">
							<input type="email" value="" id="top-footer-email" placeholder="Nhập email của bạn...">
							<button id="top-footer-email-btn" type="submit">Gửi</button>
						</div>
					</form>
					<p>Đăng ký với chúng tôi để nhận email về sản phẩm mới,
						khuyến mại đặc biệt và các sự kiện độc đáo.</p>
				</div>
			</div>
			<div id="bottom-footer">
				<a href="https://www.facebook.com/">
					<div class="bottom-footer-icon"><i class="fa-brands fa-facebook"></i></div>
				</a>
				<a href="https://www.instagram.com/">
					<div class="bottom-footer-icon"><i class="fa-brands fa-instagram"></i></div>
				</a>
				<a href="https://twitter.com/">
					<div class="bottom-footer-icon"><i class="fa-brands fa-twitter"></i></div>
				</a>
				<p>Copyright &#169; 2022 FAION.</p>
			</div>
		</div>
	</footer>
	<div id="backtotop">
		<a href="#header">
			<i class="fa-solid fa-angle-up fa-lg"></i>
		</a>
	</div>
</body>

</html>

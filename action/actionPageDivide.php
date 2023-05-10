<?php
include('../../faion/object/PageDivide.php');   
if (isset($_GET['category']) && isset($_GET['page'])) {
    $category = $_GET['category'];
    $page = $_GET['page'];   //lấy giá trị ajax gửi qua
    $phantrang = new PageDivide($category, $page);  
    $dulieu = $phantrang->select_product();    //lấy thông tin sản phẩm
    $link = $phantrang->divideButton();  //lấy các link phân trang
    echo "<div id=\"products\">" . $dulieu . "</div><div id=\"page\">". $link . "</div>";
}


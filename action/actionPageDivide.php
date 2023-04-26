<?php
//include('../../faion/object/PageDivide.php');   //include file phantrang.class.php vào nhé
//echo $_GET['category'] . $_GET['page'];
// if (isset($_GET['category']) && isset($_GET['page'])) {
    
//     $category = $_GET['category'];
//     settype($category, "string");
//     $page = $_GET['page'];   //lấy giá trị ajax gửi qua
//     settype($page, "int");
//     $phantrang = new PageDivide($category, $page);   //tạo đối tượng phân trang
//     $dulieu = $phantrang->select_product();    //lấy thông tin sản phẩm
//     $link_parination = $phantrang->divideButton();  //lấy các link phân trang
//     echo "<div id=\"products\">" . $dulieu . "</div><div id=\"page\">". $link_parination . "</div>";
// }

include('../../faion/object/PageDivide.php');   //include file phantrang.class.php vào nhé
if (isset($_GET['category']) && isset($_GET['page'])) {
    
    $category = $_GET['category'];
    //settype($category, "string");
    $page = $_GET['page'];   //lấy giá trị ajax gửi qua
    //settype($page, "int");
    $phantrang = new PageDivide($category, $page);   //tạo đối tượng phân trang
    $dulieu = $phantrang->select_product();    //lấy thông tin sản phẩm
    $link = $phantrang->divideButton();  //lấy các link phân trang
    echo "<div id=\"products\">" . $dulieu . "</div><div id=\"page\">". $link . "</div>";
}


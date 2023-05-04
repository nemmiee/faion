<?php
include('../../faion/object/PageDivide.php');

if (isset($_GET['keyword'])) {
    $page = $_GET['page'];
    $keyword = $_GET['keyword'];
    $category = $_GET['category'];
    if (isset($_GET['minPrice']) && !empty($_GET['minPrice'])) {
        $minPrice = $_GET['minPrice'];
    } else {
        $minPrice = NULL;
    }
    if (isset($_GET['maxPrice']) && !empty($_GET['maxPrice'])) {
        $maxPrice = $_GET['maxPrice'];
    } else {
        $maxPrice = NULL;
    }
    $pageDivide = new PageDivide($category, $page, $keyword, $minPrice, $maxPrice);
    $data = $pageDivide->select_product();
    $pageNum = $pageDivide->divideButton();
    if ($pageDivide->totalRow() > 0)
        echo "<div id=\"products\">" . $data . "</div><div id=\"page\">" . $pageNum . "</div>";
    else
        echo "<div id=\"products\"><div class='no-product'><img src='/faion/img/default/product_not_found.jpeg'></div></div>";
}

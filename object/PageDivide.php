<?php
include('../object/ProductDAL.php');
include('../../faion/object/Category.php');
class PageDivide extends ProductDAL
{
    public $total; // Tổng số sản phẩm
    public $start; // Vị trí bắt đầu
    public $allLimit = 12; // Số lượng sản phẩm 1 trang ở trang all
    public $limit = 8; // Số lượng sản phẩm 1 trang ở trang category
    public $currentPage; // Trang hiện tại
    public $page; // Lấy page bên file actionPageDivide.php đưa vào
    public $category;
    public $keyword;
    public $minPrice;
    public $maxPrice;
    public $sql;

    public function __construct($category = NULL, $page = NULL, $keyword = NULL, $minPrice = NULL, $maxPrice = NULL)
    {
        parent::__construct();

        $this->category = $category;
        $this->page = $page;
        $this->keyword = $keyword;
        if ($this->keyword != NULL)
            $this->allLimit = 8;
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;        
        $this->getPage();
    }

    public function getPage()
    {
        if ($this->category == "all") {
            if ($this->page != 1) {
                $this->start = ($this->page - 1) * $this->allLimit;
                $this->currentPage = $this->page;
            } else {
                $this->start = $this->page - 1;
                $this->currentPage = $this->page;
            }
        } else {
            if ($this->page != 1) {
                $this->start = ($this->page - 1) * $this->limit;
                $this->currentPage = $this->page;
            } else {
                $this->start = $this->page - 1;
                $this->currentPage = $this->page;
            }
        }
    }

    public function totalRow()
    {
        if ($this->keyword != NULL) {
            $price = "";
            if ($this->minPrice != NULL && $this->maxPrice != NULL) {
                $price = "AND price BETWEEN $this->minPrice AND $this->maxPrice";
            } else if ($this->minPrice != NULL && $this->maxPrice == NULL) {
                $price = "AND price >= $this->minPrice";
            } else if ($this->minPrice == NULL && $this->maxPrice != NULL) {
                $price = "AND price <= $this->maxPrice";
            } else {
                $price = "";
            }

            if ($this->category == "all") {
                $sql = "SELECT * FROM product WHERE status = 1 AND LOWER(name) LIKE LOWER('%$this->keyword%') " . $price;
                ProductDAL::select($sql);
                if (ProductDAL::select_count() > 0) {
                    $this->total = ceil(ProductDAL::select_count() / $this->allLimit);
                    return $this->total;
                }
            } else {
                $sql = "SELECT * FROM product WHERE status = 1 AND category_id = " . getCategoryId($this->category) . " AND 
                LOWER(name) LIKE LOWER('%$this->keyword%') " . $price;
                ProductDAL::select($sql);
                if (ProductDAL::select_count() > 0) {
                    $this->total = ceil(ProductDAL::select_count() / $this->limit);
                    return $this->total;
                }
            }
        } else {
            if ($this->category == "all") {
                $sql = "SELECT * FROM product WHERE status = 1";
                ProductDAL::select($sql);
                if (ProductDAL::select_count() > 0) {
                    $this->total = ceil(ProductDAL::select_count() / $this->allLimit);
                    return $this->total;
                }
            } else {
                $sql = "SELECT * FROM product WHERE status = 1 AND category_id = " . getCategoryId($this->category);
                ProductDAL::select($sql);
                if (ProductDAL::select_count() > 0) {
                    $this->total = ceil(ProductDAL::select_count() / $this->limit);
                    return $this->total;
                }
            }
        }
    }
    public function select_product()
    {
        if ($this->keyword != NULL) {
            $price = "";
            if ($this->minPrice != NULL && $this->maxPrice != NULL) {
                $price = "AND price BETWEEN $this->minPrice AND $this->maxPrice";
            } else if ($this->minPrice != NULL && $this->maxPrice == NULL) {
                $price = "AND price >= $this->minPrice";
            } else if ($this->minPrice == NULL && $this->maxPrice != NULL) {
                $price = "AND price <= $this->maxPrice";
            } else {
                $price = "";
            }
            if ($this->category == "all") {
                $sql = "SELECT * FROM product WHERE status = 1 AND LOWER(name) LIKE LOWER('%$this->keyword%') $price 
                LIMIT $this->start, $this->allLimit";
                ProductDAL::select($sql);
                $str = "";
                while ($row = mysqli_fetch_assoc(ProductDAL::getResultQuery())) {
                    $str .= "<div class=\"card\"><a href=\"/faion/index.php/products?info=" . $row['id'] . "\">";
                    $str .= "<div class=\"image-container\"><img src=\"" . $row['image'] . "\" alt=\"Image\"></div>";
                    $str .= "<div class=\"container\"><h4>" . $row['name'] . "</h4>";
                    $str .= "<h5>Giá: " . changeMoney($row['price']) . "₫</h5></div>";
                    $str .= "<div class=\"addToCart-container\"><button class=\"addToCart-btn\">Mua ngay</button></div></a></div>";
                }
                return $str;
            } else {
                $sql = "SELECT * FROM product WHERE status = 1 AND category_id = " . getCategoryId($this->category) . " 
                AND LOWER(name) LIKE LOWER('%$this->keyword%') $price LIMIT $this->start, $this->limit";
                ProductDAL::select($sql);
                $str = "";
                while ($row = mysqli_fetch_assoc(ProductDAL::getResultQuery())) {
                    $str .= "<div class=\"card\"><a href=\"/faion/index.php/products?info=" . $row['id'] . "\">";
                    $str .= "<div class=\"image-container\"><img src=\"" . $row['image'] . "\" alt=\"Image\"></div>";
                    $str .= "<div class=\"container\"><h4>" . $row['name'] . "</h4>";
                    $str .= "<h5>Giá: " . changeMoney($row['price']) . "₫</h5></div>";
                    $str .= "<div class=\"addToCart-container\"><button class=\"addToCart-btn\">Mua ngay</button></div></a></div>";
                }
                return $str;
            }
        } else {
            if ($this->category == "all") {
                $sql = "SELECT * FROM product WHERE status = 1 LIMIT $this->start, $this->allLimit";
                ProductDAL::select($sql);
                $str = "";
                while ($row = mysqli_fetch_assoc(ProductDAL::getResultQuery())) {
                    $str .= "<div class=\"card\"><a href=\"/faion/index.php/products?info=" . $row['id'] . "\">";
                    $str .= "<div class=\"image-container\"><img src=\"" . $row['image'] . "\" alt=\"Image\"></div>";
                    $str .= "<div class=\"container\"><h4>" . $row['name'] . "</h4>";
                    $str .= "<h5>Giá: " . changeMoney($row['price']) . "₫</h5></div>";
                    $str .= "<div class=\"addToCart-container\"><button class=\"addToCart-btn\">Mua ngay</button></div></a></div>";
                }
                return $str;
            } else {
                $sql = "SELECT * FROM product WHERE status = 1 AND category_id = " . getCategoryId($this->category) . " LIMIT $this->start, $this->limit";
                ProductDAL::select($sql);
                $str = "";
                while ($row = mysqli_fetch_assoc(ProductDAL::getResultQuery())) {
                    $str .= "<div class=\"card\"><a href=\"/faion/index.php/products?info=" . $row['id'] . "\">";
                    $str .= "<div class=\"image-container\"><img src=\"" . $row['image'] . "\" alt=\"Image\"></div>";
                    $str .= "<div class=\"container\"><h4>" . $row['name'] . "</h4>";
                    $str .= "<h5>Giá: " . changeMoney($row['price']) . "₫</h5></div>";
                    $str .= "<div class=\"addToCart-container\"><button class=\"addToCart-btn\">Mua ngay</button></div></a></div>";
                }
                return $str;
            }
        }
    }

    public function divideButton()
    {
        $link = '';
        if ($this->keyword != NULL) {
            $min = $max = "";
            if ($this->minPrice != NULL)
                $min = ", $this->minPrice";
            else
                $min = ", null";
            if ($this->maxPrice != NULL)
                $max = ", $this->maxPrice";
            else
                $max = ", null";

            for ($i = 1; $i <= $this->totalRow(); $i++) {
                if ($i == $this->currentPage) {
                    $link .= '<a><button class="page-number active" onclick="pageDivideAjax(\'' . $this->category . '\', ' . $this->currentPage . ', \'' . $this->keyword . '\'' . $min . $max . ')">' . $i . '</button></a>';
                } else {
                    $link .= '<a><button class="page-number" onclick="pageDivideAjax(\'' . $this->category . '\', ' . $i . ', \'' . $this->keyword . '\'' . $min . $max . ')">' . $i . '</button></a>';
                }
            }
        } else {
            for ($i = 1; $i <= $this->totalRow(); $i++) {
                if ($i == $this->currentPage) {
                    $link .= '<a><button class="page-number active" onclick="pageDivideAjax(\'' . $this->category . '\', ' . $this->currentPage . ', null, null, null)">' . $i . '</button></a>';
                } else {
                    $link .= '<a><button class="page-number" onclick="pageDivideAjax(\'' . $this->category . '\', ' . $i . ', null, null, null)">' . $i . '</button></a>';
                }
            }
        }
        return $link;
    }
}


function getCategoryId($name)
{
    if ($name == "all")
        return -1;
    else {
        $categoryList = getCategoryList();
        for ($i = 0; $i < count($categoryList); $i++) {
            if (trim(strtolower($categoryList[$i]->getName())) == strtolower($name)) {
                return $categoryList[$i]->getId();
            }
        }
    }
}

function getCategoryList()
{
    include_once('../../faion/connection/Database.php');
    $db = new Database();
    $kq = mysqli_query($db->getConnection(), "SELECT * FROM category");
    $list = array();
    while ($row = mysqli_fetch_assoc($kq)) {
        $category = new Category($row['id'], $row['name']);
        $list[] = $category;
    }
    return $list;
}

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
    // Đảo ngược chuỗi
    $moneyOut = "";
    $count = 0;
    $arr = str_split($temp, 1);
    for ($i = count($arr) - 1; $i >= 0; --$i) {
        $moneyOut .= $arr[$i];
        $count++;
    }
    return $moneyOut;
}

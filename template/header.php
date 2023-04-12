<header>
    <div id="header">
        <div id="res-header-cart">
            <a href="/faion/index.php/cart/">
                <i class="fa-solid fa-cart-shopping fa-lg <?php echo addHeaderActive("cart"); ?>"></i>
            </a>
        </div>
        <div id="logo-container">
            <a href="/faion/index.php/"><img id="logo-image" src="/faion/img/Logo/Faion_remove_background.png" alt="Logo"></a>
        </div>
        <div id="flex_header-title">
            <div class="header-title <?php echo addHeaderActive("main"); ?>"><a href="/faion/index.php/">TRANG CHỦ</a></div>
            <div id="header-product-title" class="header-title <?php echo addHeaderActive("products"); ?>">
                <a href="/faion/index.php/products?category=all&page=1">SẢN PHẨM <i class="fa-sharp fa-solid fa-angle-down fa-xs"></i></a>
                <div id="header-product-dropdown">
                    <?php
                    include('../faion/connection/Database.php');

                    $db = new Database();
                    $menuList = array();
                    mysqli_query($db->getConnection(), "set names 'utf8'");
                    $kq = mysqli_query($db->getConnection(), "SELECT name FROM category");
                    while ($row = mysqli_fetch_array($kq)) {
                        $menuList[] = $row['name'];
                        //array_push($arr, $row["name"]);
                    }
                    echo "<ul>";
                    for ($i = 0; $i < count($menuList); $i++) {
                        echo "<a href='/faion/index.php/products?category=" . strtolower($menuList[$i]) . "&page=1'>
                            <li>" .  $menuList[$i] . "</li></a>";
                    }
                    echo "</ul>";

                    function addHeaderActive($name)
                    {
                        $uri = $_SERVER['REQUEST_URI'];
                        $temp = explode("/", $uri);
                        $page = $temp[count($temp) - 2];
                        $regEx = "/products?[a-zA-Z0-9=&]{1,}/";
                        if (preg_match($regEx, $temp[count($temp) - 1])) {
                            if ($name == "products")
                                return "active";
                        } else {
                            switch ($page) {
                                case "sizeguide":
                                    if ($name == "sizeguide")
                                        return "active";
                                    break;
                                case "contact":
                                    if ($name == "contact")
                                        return "active";
                                    break;
                                case "login":
                                    if ($name == "login")
                                        return "active";
                                    break;
                                case "cart":
                                    if ($name == "cart")
                                        return "active";
                                    break;
                                case "signup":
                                    if ($name == "login")
                                        return "active";
                                    break;
                                case "index.php":
                                    if ($name == "main")
                                        return "active";
                                    break;
                            }
                            return "";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="header-title <?php echo addHeaderActive("sizeguide"); ?>"><a href="/faion/index.php/sizeguide/">SIZE GUIDE</a></div>
            <div class="header-title <?php echo addHeaderActive("contact"); ?>"><a href="/faion/index.php/contact/">LIÊN HỆ</a></div>
            <div id="manage">
            </div>
            <!-- Loggin -->
            <?php
            function cutName($fullName)
            {
                $fullName = trim($fullName);
                $arr = explode(' ', $fullName);
                $name = $arr[count($arr) - 1];
                $first = substr($name, 0, 1);
                $first = strtoupper($first);
                $last = substr($name, 1);
                $last = strtolower($last);
                $name = $first . $last;
                return $name;
            }
            if (isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 1) {
                    echo "<div class=\"user\"><li><button id=\"btnlg\">" . cutName($_SESSION['name']) . "</button>
                    <a href=\"/faion/File/logout.php\" class=\"user-icon\">
                    <i class=\"fa-solid fa-right-from-bracket\"></i></a></li></div>";
                } else {
                    echo "
                    <div class=\"icon\"><a href=\"/faion/index.php/admin/\"><i class=\"fa-solid fa-user-gear fa-lg header-icon\"></i></a></div>
                    <div class=\"user\"><li><button id=\"btnlg\">" . cutName($_SESSION['name']) . "</button>
                    <a href=\"/faion/File/logout.php\" class=\"user-icon\">
                    <i class=\"fa-solid fa-right-from-bracket\"></i></a></li></div>";

                }
            } else {
                echo "
                <div class=\"user\">
                    <a href=\"/faion/index.php/login/\">
                        <i class=\"fa-solid fa-user fa-lg header-icon " . addHeaderActive("login") . "\"></i>
                    </a>
                </div>";
            }
            ?>
            <!-- Search -->
            <div class="search">
                <div id="header-search" onclick="opensearch()">
                    <button id="header-search-btn">
                        <i class="fa-solid fa-magnifying-glass fa-lg header-icon"></i>
                    </button>
                </div>
            </div>
            <!-- Cart -->
            <div class="cart" id="header-cart">
                <a href="/faion/index.php/cart/">
                    <i class="fa-solid fa-cart-shopping fa-lg header-icon <?php echo addHeaderActive("cart"); ?>"></i>
                </a>
            </div>
            <div id="darkmode">
                <i id="darkmode-btn" class="fa-solid fa-circle-half-stroke fa-lg" onclick="changeTheme()"></i>
            </div>
        </div>
        <div id="hamburger-container">
            <div id="hamburger">
                <i class="fa-solid fa-bars fa-lg" id="hamburger-icon"></i>
            </div>
        </div>
    </div>
</header>
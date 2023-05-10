<?php
if (isset($_SESSION['isNotChange'])) {
    echo "<script>alert('Không có sự thay đổi nào!');</script>";
    unset($_SESSION['isNotChange']);
}

$uri = $_SERVER['REQUEST_URI'];
$infoRegEx = '/\binfo\b/';
$customerList = getCustomerList();
$accountList = getAccountList();
$pos = -1;
for ($i = 0; $i < count($customerList); $i++) {
    if ($customerList[$i]->getId() == $_SESSION["id"]) {
        $pos = $i;
        break;
    }
}
?>
<main id='main'>
    <?php include('../faion/admin/adminSidebar.php'); ?>
    <div class='right-content-container' style='height: auto;'>
        <div id="top-sub-header"></div>
        <?php
        if (preg_match('/\binfo\b/', $uri)) {
        ?>
            <div class='content-container'>
                <div class='content'>
                    <form action='/faion/action/actionCustomer.php' method='post' id='changeCustomerForm' onsubmit='return checkCustomer(event)'>
                        <div class='title'>
                            <div class='left' style="text-align: center; width: 100%;">CHỈNH SỬA THÔNG TIN</div>
                        </div>
                        <div class='top'>
                            <div class='container'>
                                <label for='cusname'>Họ và tên:</label>
                                <input type='text' name='name' id='cusname' value='<?php echo $customerList[$pos]->getName(); ?>'>
                            </div>
                            <div class='container'>
                                <label for='cusemail'>Email:</label>
                                <input type='text' name='email' id='cusemail' value='<?php echo $customerList[$pos]->getEmail(); ?>'>
                            </div>
                            <div class='container'>
                                <label for='cusaddress'>Địa chỉ:</label>
                                <input type='text' name='address' id='cusaddress' value='<?php echo $customerList[$pos]->getAddress(); ?>'>
                            </div>
                            <div class='container'>
                                <label for='cusphone'>Số điện thoại:</label>
                                <input type='text' name='phoneNum' id='cusphone' value='<?php echo $customerList[$pos]->getPhoneNum(); ?>'>
                            </div>
                        </div>
                        <div class='bottom'>
                            <input type='text' name='id' value='<?php echo $customerList[$pos]->getId(); ?>' style='display: none;'>
                            <input type='submit' name='customer-info-change-submit' value='CHỈNH SỬA'>
                        </div>
                    </form>
                </div>
            </div>
    </div>
<?php
        } elseif(preg_match('/\baccount\b/',$uri)) {
?>
    <div class='content-container'>
        <div class='content'>
            <form action='/faion/action/actionUser.php' method='post' id='changeUserForm' onsubmit="return checkChangeAccountInfo(event)">
                <div class='title'>
                    <div class='left' style="text-align: center; width: 100%;">ĐỔI THÔNG TIN TÀI KHOẢN</div>
                </div>
                <div class='top'>
                    <div class='max-container'>
                        <label for='username'>Tên tài khoản:</label>
                        <input type='text' name='username' id='username' value='<?php echo $accountList[$pos]->getUsername(); ?>'>
                    </div>
                    <div class='max-container'>
                        <label for='password'>Mật khẩu:</label>
                        <input type='password' name='password' id='password' value='<?php echo $accountList[$pos]->getPassword(); ?>'>
                    </div>    
                    <div class='max-container'>
                        <label for='confirm-password'>Nhập lại mật khẩu:</label>
                        <input type='password' name='confirm-password' id='confirm-password' value='<?php echo $accountList[$pos]->getPassword(); ?>'>
                    </div>   
                </div>
                <div class='bottom'>
                    <input type='text' name='id' value='<?php echo $accountList[$pos]->getId(); ?>' style='display: none;'>
                    <input type='submit' name='user-account-change-submit' value='CHỈNH SỬA'>
                </div>
            </form>
        </div>
        </div>
<?php
      }elseif(preg_match('/\borders\b/',$uri)){
?>
<head>
    <script>
        function thanhToan($i) {
            var result = "<?php ?>"
        }
    </script>
</head>
<div class="left">
    <div class="table-container">
        <table class="table" cellspacing="0">
            <thead>
                <tr>
                    <th class="product-name">Mã đơn hàng</th>
                    <th class="total">Tổng tiền</th>
                    <th class="status">Trạng thái</th>
                    <th class="date">Ngày thêm</th>
                    <th class="glass">&nbsp;</th>
                </tr>
            </thead>
            <tbody id="product-info">
                <?php displayOrder() ?>
            </tbody>
        </table>
    </div>
</div>
<div class="right">
    <div class="table-container">
        <table class="table" cellspacing="0">
            <thead>
                <tr>
                    <th colspan="4" class="name">Thông tin hóa đơn</th>
                </tr>
            </thead>
            <tbody id="product-info">
                <?php if (isset($_GET['id'])) {
                    echo getOrderDetail($_GET['id']);
                }
                ?>
            </tbody>
        </table>
    </div>
   

</div>






<?php
        } 
        function displayOrder()
{

    include('../faion/object/Order.php');
    $db = new Database();
    $kq = mysqli_query($db->getConnection(), "SELECT * FROM `order` od WHERE od.customer_id = ".$_SESSION['id']."");
    $orderArr = array();
    while ($row = mysqli_fetch_assoc($kq)) {
        $order = new Order(
            $row['id'],
            $row['customer_id'],
            $row['total'],
            $row['status'],
            $row['created_at'],
            $row['canceled_at'],
            $row['completed_at'],
        );
        $orderArr[] = $order;
    }
    for ($i = 0; $i < count($orderArr); $i++) {
        if ($orderArr[$i]->getStatus())
            $status = "Đã thanh toán";
        else
            $status = "Chưa thanh toán";

        echo "
        <tr>
            <td class=\"order-id\">" . $orderArr[$i]->getId() . "</a></td>
            <td class=\"total\">" . changeMoney($orderArr[$i]->getTotal()) . "₫</td>
            <td class=\"status\">" . $status . "</td>
            <td class=\"date\">" . $orderArr[$i]->getCreatedDate() . "</td>
            <td class=\"glasss\"><a href=\"/faion/index.php/user/orders/?id=" . $orderArr[$i]->getId() . "\"><i class=\"fa-solid fa-magnifying-glass\" onclick=\"\"></i></a></td>
        </tr>";
    }
    $db->disconnect();
}
function getOrderDetail($id)
{
    include('../faion/object/OrderDetail.php');
    $db = new Database();
    $sql = 'select cs.name customer_name,od.id order_id , pr.id product_id,pr.name product_name,oi.quantity quantity,oi.price price from `order` od
        inner join customer cs on od.customer_id = cs.id
        inner join orderitem oi on od.id = oi.order_id
        inner join product pr on oi.product_id = pr.id
        where od.id = ' . +$id . '';
    $kq = mysqli_query($db->getConnection(), $sql);
    $orderDetailArray = array();
    while ($row = mysqli_fetch_array($kq)) {
        $orderDetail = new orderDetail(
            $row['customer_name'],
            $row['order_id'],
            $row['product_id'],
            $row['product_name'],
            $row['quantity'],
            $row['price']
        );
        $orderDetailArray[] = $orderDetail;
    }

    echo "<tr>
        <td>Tên khách hàng:</td>
        <td>" . $orderDetailArray[0]->getCustomerName() . "</td>
        <td>Mã hóa đơn: </td>
        <td>" . $orderDetailArray[0]->getOrderId() . "</td>
        </tr>
        <tr style='background-color: lightgrey; color:black;font-weight:bold'>
        <td></td>
        <td>Tên sản phẩm</td>
        <td>Số lượng</td>
        <td>Thành tiền</td>
        </tr>";
    for ($i = 0; $i < count($orderDetailArray); $i++) {
        echo "<tr>
            <td></td>
            <td>" . $orderDetailArray[$i]->getProductName() . "</td>
            <td>" . $orderDetailArray[$i]->getQuantity() . "</td>
            <td>" . $orderDetailArray[$i]->getprice() . "</td>
            </tr>";
    }
}

?>
</div>
</main>
<script>
    function checkChangeAccountInfo(e) {

        var username = document.getElementById("username");
        var password = document.getElementById("password");
        var confirmPassword = document.getElementById("confirm-password");

        if (username.value.trim() == "" || username.value.trim() == undefined || username.value.trim() == NaN) {
            alert("Mời nhập tên đăng nhập");
            username.focus();
            e.preventDefault();
            return false;
        } else if (password.value.trim() == "" || password.value.trim() == undefined || password.value.trim() == NaN) {
            alert("Mời nhập mật khẩu");
            password.focus();
            e.preventDefault();
            return false;
        } else if (confirmPassword.value.trim() == "" || confirmPassword.value.trim() == undefined || confirmPassword.trim() == NaN) {
            alert("Mời nhập xác nhận mật khẩu");
            confirmPassword.focus();
            e.preventDefault();
            return false;
        } else if (confirmPassword.value.trim() != password.value.trim() && confirmPassword.value.trim() != "" && password.value.trim() != "") {
            alert("Mật khẩu bạn vừa nhập không trùng khớp");
            confirmPassword.focus();
            e.preventDefault();
            return false;
        }
    }
</script>
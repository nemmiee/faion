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
    <div class="button-container">
        <form method="get" action="/faion/action/actionOrder.php">
            <input type="hidden" value='<?php if (isset($_GET['id'])){echo $_GET['id'];
            }  ?>' name="id">
            <button type="submit" class="delete-btn">Đánh dấu đã thanh toán</button>
        </form>
    </div>

</div>
<?php


function displayOrder()
{

    include('../faion/object/Order.php');
    $db = new Database();
    $kq = mysqli_query($db->getConnection(), "SELECT * FROM `order`");
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
            <td class=\"order-id\"><a href=\"/faion/index.php/admin/products?choice=order&id=" . $orderArr[$i]->getId() . "\">" . $orderArr[$i]->getId() . "</a></td>
            <td class=\"total\">" . changeMoney($orderArr[$i]->getTotal()) . "₫</td>
            <td class=\"status\">" . $status . "</td>
            <td class=\"date\">" . $orderArr[$i]->getCreatedDate() . "</td>
            <td class=\"glasss\"><a href=\"/faion/index.php/admin/orders/orders?id=" . $orderArr[$i]->getId() . "\"><i class=\"fa-solid fa-magnifying-glass\" onclick=\"\"></i></a></td>
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

    if(isset($_GET['message'])){
        if($_GET['message']){
        echo "<script type='text/javascript'>alert('Đã thanh toán');</script>";
    }
    else{
        echo "<script type='text/javascript'>alert('Chưa chọn hóa đơn cần xử lý');</script>";
    }
}

?>
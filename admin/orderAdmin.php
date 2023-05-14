
<div id="top-sub-header">    
    <div class="sort-container">
        <label for="sort">Sắp xếp theo</label>
        <select id="sort">
            <option value="default" selected>Cũ nhất</option>
            <option value="new">Mới nhất</option>
            <option value="priceUp">Tổng tiền tăng dần</option>
            <option value="priceDown">Tổng tiền giảm dần</option>
        </select>
    </div>
    <div class="sort-container">
        <label for="order-status">Lọc theo trạng thái</label>
        <select id="order-status">
            <option value="default" selected>Mặc định</option>
            <option value="none">Chưa xử lý</option>
            <option value="done">Đã xử lý</option>
        </select>
    </div>
</div>
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
            <input type="hidden" value='<?php if (isset($_GET['id'])){echo $_GET['id'];} ?>' name="id">
            <button type="submit" class="delete-btn">Đánh dấu đã xử lý</button>
        </form>
    </div>

</div>

<script>
    var sort = document.getElementById("sort");
    var orderStatus = document.getElementById("order-status");
    sort.addEventListener("change", function() {
        var request = "sortBy=" + sort.value;
        var xml = new XMLHttpRequest();
        xml.open("POST", "/faion/action/actionSortOrderAdmin.php", true);
        xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xml.onreadystatechange = function() {
            if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
                orderStatus.value = "default";
                document.querySelectorAll("#product-info")[0].innerHTML = this.responseText;
            }
        };
        xml.send(request);
    });

    orderStatus.addEventListener("change", function() {
        var request = "status=" + orderStatus.value;
        var xml = new XMLHttpRequest();
        xml.open("POST", "/faion/action/actionSortOrderAdmin.php", true);
        xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                sort.value = "default";
                document.querySelectorAll("#product-info")[0].innerHTML = this.responseText;
            }
        }
        xml.send(request);
    });
</script>

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
            $status = "Đã xử lý";
        else
            $status = "Chưa xử lý";

        echo "
        <tr>
            <td class=\"order-id\"><a>" . $orderArr[$i]->getId() . "</a></td>
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
    $sql = 'select cs.name customer_name,od.id order_id , pr.id product_id,pr.name product_name,oi.quantity quantity,oi.price price,oi.size size from `order` od
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
            $row['price'],
            $row['size']
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
        <td>Tên sản phẩm</td>
        <td>Kích cỡ</td>
        <td>Số lượng</td>
        <td>Thành tiền</td>
        </tr>";
    for ($i = 0; $i < count($orderDetailArray); $i++) {
        echo "<tr>
            
            <td>" . $orderDetailArray[$i]->getProductName() . "</td>
            <td>".$orderDetailArray[$i]->getSize()."</td>
            <td>" . $orderDetailArray[$i]->getQuantity() . "</td>
            <td>" . $orderDetailArray[$i]->getprice() . "</td>
            </tr>";
    }
}

    if(isset($_SESSION["message"])){
        if($_SESSION['message']=="true"){
        echo "<script type='text/javascript'>alert('Xử lý thành công');</script>";
        unset($_SESSION['message']);
    }
    else{
        echo "<script type='text/javascript'>alert('Chưa chọn hóa đơn cần xử lý');</script>";
        unset($_SESSION['message']);
    }
}


?>
<?php
include('../../faion/connection/Database.php');
$id = $_GET['orderId'];
echo $id;
if(!isset($id)){
    echo "<script type='text/javascript'>alert('Chưa chọn hóa đơn cần xử lý');</script>";
}else{
    $conn = new Database();
    $sql = "update `order`  od
    set status = 1
    where od.id =".$id;
    $conn->insert_update_delete($sql);
    echo "<script type='text/javascript'>alert('Đã thanh toán');</script>";
    header('Location:/faion/index.php/admin/orders/');
}
?>
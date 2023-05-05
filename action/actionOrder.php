<?php
include('../../faion/connection/Database.php');
if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $date = date('y-m-d');
    $conn = new Database();
    $sql = "update `order`  od
    set status=1, completed_at=".$date."
    where od.id =".$id;
    $conn->insert_update_delete($sql);  
    header('Location:/faion/index.php/admin/orders/orders?message=1');
}else{
    header('Location:/faion/index.php/admin/orders/orders?message=0');
}

?>
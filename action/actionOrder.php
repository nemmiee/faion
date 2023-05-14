<?php
session_start();
include('../../faion/connection/Database.php');
if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $date = date('y-m-d H:i:s');
    $conn = new Database();
    $sql = "update `order`  od
    set status=1, completed_at='".$date."'
    where od.id =".$id;
    $conn->insert_update_delete($sql);  
    $_SESSION['message'] = "true";
} else{
    $_SESSION['message'] = "false";
}
header('Location:/faion/index.php/admin/orders/');
?>
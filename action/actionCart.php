<?php 
include('../../faion/connection/Database.php');
session_start();
$conn = new Database;
if(isset($_POST['add-cart'])){
    
    if(isset($_POST['id'])){
        
        $id = intval($_POST['id']);
        $quantity = intval($_POST['quantity']);
        
        $size = $_POST['size'];
        $sql = "SELECT * from product where id =".$id."";
        $result = mysqli_query($conn->getConnection(),$sql);
        $row = mysqli_fetch_row($result);
        $key = strval($id);
        $key .=$size;
        if(!isset($_SESSION['cart'])){
            $cart[$key] = array(
                'key'=>$key,
                'product_id' =>$id,
                'name' => $row[2],
                'size' => $size,
        
                'quantity' => $quantity,
                'price' => (float)$row[4] 
            );
        }else{
            $cart = $_SESSION['cart'];
            if(array_key_exists($key,$cart)){

                $cart[$key] = array(
                    'key'=>$key,
                    'product_id' =>$id,
                    'name' => $row[2],
                    'size' => $size,
                    
                    'quantity' => (int)$cart[$key]['quantity']+$quantity,
                    'price' => (float)$row[4]);
                }else{
                
                    $cart[$key] = array(
                        'key'=>$key,
                        'product_id' =>$id,
                        'name' => $row[2],
                        'size' => $size,
                        
                        'quantity' => $quantity,
                        'price' => (float)$row[4]);
                }
            }
        $_SESSION['cart'] = $cart;
    }
    echo "<script>window.alert('Thêm sản phẩm vào giỏ hàng thành công')
    window.location= '/faion/index.php/products?category=all&page=1'
    </script>
    ";
} 
else if(isset($_POST['delete-cart'])){

    unset($_SESSION['cart']);
    echo "deleted";
    echo "<script>window.alert('Hủy giỏ hàng thành công')
    window.location= '/faion/index.php/products?category=all&page=1'
    </script>
    ";

}
else if(isset($_POST['update-cart'])){
    $i = 0;
    $cart = $_SESSION['cart'];
    $quan = $_POST['quantity'];
    foreach($cart as $key){
       
        $key['quantity'] = $quan[$i];
        $i++;
        $cart[$key['key']] = $key;
    }
    $_SESSION['cart']=$cart;
    header('Location:/faion/index.php/cart/');
   
// echo "updated";
}
else if(isset($_POST['confirm-cart'])){
    $i = 0;
    $cart = $_SESSION['cart'];
    $quan = $_POST['quantity'];
    foreach($cart as $key){
       
        $key['quantity'] = $quan[$i];
        $i++;
        $cart[$key['key']] = $key;
    }
    $_SESSION['cart']=$cart;
    $date = date('y-m-d H:i:s');
    $cart = $_SESSION['cart'];
    $total = 0;
    $sql = "SELECT count(1) from `order`";
    $result = mysqli_query($conn->getConnection(),$sql);
    $row = mysqli_fetch_row($result);
    $count = $row[0];
    foreach($cart as $key){
        $total += $key['quantity']*$key['price'];
    }
    $sql = "INSERT INTO `order` values('".($count+1)."','".$_SESSION['id']."','$total','0','$date','','')";
    $conn->insert_update_delete($sql);
    echo $sql;
    foreach($cart as $key){
        $sql = "INSERT INTO `orderitem` values('".($count+1)."','".$key['product_id']."','".$key['quantity']."','".$key['price']."','".$key['size']."')";
        $conn->insert_update_delete($sql);
        $sql = "UPDATE `product` SET quantity = quantity - ".$key['quantity'].",sold = sold+".$key['quantity']." WHERE id = ".$key['product_id']."";
        $conn->insert_update_delete($sql);
    }
    echo "<script>window.alert('Đặt hàng thành công')
    window.location= '/faion/index.php/cart/'
    </script>
    ";
    unset($_SESSION['cart']);
}
else if(isset($_POST['delete'])){
    $key = $_POST['key'];
    unset($_SESSION['cart'][$key]);
    header('Location:/faion/index.php/cart/');
}
?>
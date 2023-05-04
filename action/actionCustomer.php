<?php
if (isset($_POST['customer-change-submit'])) {
    $id = $_POST['id'];
    $pos = -1;
    $customerList = getCustomerList();
    for ($i = 0; $i < count($customerList); $i++) {
        if ($customerList[$i]->getId() == $id) {
            $pos = $i;
            break;
        }
    }

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phoneNum']);

    $count = 0;
    if ($_POST['name'] != $customerList[$pos]->getName()) {
        ++$count;
    }
    if ($_POST['email'] != $customerList[$pos]->getEmail()) {
        ++$count;
    }
    if ($_POST['address'] != $customerList[$pos]->getAddress()) {
        ++$count;
    }
    if ($_POST['phoneNum'] != $customerList[$pos]->getPhoneNum()) {
        ++$count;
    }

    if ($count > 0) {
        // Trường hợp nếu có sự thay đổi thông tin
        for ($i = 0; $i < count($customerList); $i++) {
            if ($customerList[$i]->getEmail() == $email && $customerList[$i]->getId() != $id) {
                echo "<script>alert('Email này đã được sử dụng.');
                window.location = '/faion/index.php/user/info/'; </script>";
                die;
            }
            if ($customerList[$i]->getPhoneNum() == $phoneNum && $customerList[$i]->getId() != $id) {
                echo "<script>alert('Số điện thoại này đã được sử dụng.');
                window.location = '/faion/index.php/user/info/'; </script>";
                die;
            }
        }

        $db = new Database();
        $sql = "UPDATE customer SET name = '$name', email = '$email', address = '$address', 
        phone_number = '$phone' WHERE id = '$id'";
        if ($db->insert_update_delete($sql)) {
            $db->disconnect();
            echo "<script>
                        alert(\"Sửa thông tin khách hàng thành công.\");
                        window.location = '/faion/index.php/admin/customers?id=$id'; 
                    </script>";
        } else {
            $db->disconnect();
            echo "<script>
                    alert(\"Sửa thông tin khách hàng thất bại.\"); 
                    window.location = '/faion/index.php/admin/customers?id=$id'; 
                </script>";
        }

    } else {
        // Trường hợp không có sự thay đổi thông tin
        session_start();
        $_SESSION["isNotChange"] = "true";
        header ("Location:/faion/index.php/admin/customers?id=" . $id);
        die;
    }
} else {
    // User tự đổi thông tin cá nhân của mình
    $id = $_POST['id'];
    $pos = -1;
    $customerList = getCustomerList();
    for ($i = 0; $i < count($customerList); $i++) {
        if ($customerList[$i]->getId() == $id) {
            $pos = $i;
            break;
        }
    }

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phoneNum']);

    $count = 0;
    if ($_POST['name'] != $customerList[$pos]->getName()) {
        ++$count;
    }
    if ($_POST['email'] != $customerList[$pos]->getEmail()) {
        ++$count;
    }
    if ($_POST['address'] != $customerList[$pos]->getAddress()) {
        ++$count;
    }
    if ($_POST['phoneNum'] != $customerList[$pos]->getPhoneNum()) {
        ++$count;
    }

    if ($count > 0) {
        // Trường hợp nếu có sự thay đổi thông tin
        for ($i = 0; $i < count($customerList); $i++) {
            if ($customerList[$i]->getEmail() == $email && $customerList[$i]->getId() != $id) {
                echo "<script>alert('Email này đã được sử dụng.');
                window.location = '/faion/index.php/user/info/'; </script>";
                die;
            }
            if ($customerList[$i]->getPhoneNum() == $phone && $customerList[$i]->getId() != $id) {
                echo "<script>alert('Số điện thoại này đã được sử dụng.');
                window.location = '/faion/index.php/user/info/'; </script>";
                die;
            }
        }

        $db = new Database();
        $sql = "UPDATE customer SET name = '$name', email = '$email', address = '$address', 
        phone_number = '$phone' WHERE id = '$id'";
        if ($db->insert_update_delete($sql)) {
            $db->disconnect();
            echo "<script>
                        alert(\"Sửa thông tin thành công.\");
                        window.location = '/faion/index.php/user/info/'; 
                    </script>";
        } else {
            $db->disconnect();
            echo "<script>
                    alert(\"Sửa thông tin thất bại.\"); 
                    window.location = '/faion/index.php/user/info/'; 
                </script>";
        }

    } else {
        // Trường hợp không có sự thay đổi thông tin
        session_start();
        $_SESSION["isNotChange"] = "true";
        header ("Location:/faion/index.php/user/info/");
        die;
    }
}

function getCustomerList() {
    include ('../../faion/connection/Database.php');
    include ('../../faion/object/Customer.php');
	$db = new Database();
	$kq = mysqli_query($db->getConnection(), "SELECT * FROM customer");
	$list = array();
	while ($row = mysqli_fetch_assoc($kq)) {
		$customer = new Customer(
			$row['id'], 
			$row['name'],
			$row['email'],
			$row['address'],
			$row['phone_number'],
			$row['created_at']
		);
		$list[] = $customer;
	}
	sort($list);
	return $list;
}
?>
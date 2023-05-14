<?php
include ('../../faion/connection/Database.php');
include ('../../faion/object/Order.php');
if (isset($_POST['sortBy']) && !empty($_POST['sortBy'])) {    
    $sortBy = $_POST['sortBy'];
    switch ($sortBy) {
        case "default": {
            echo displayOrderTable(getOrderList());
        } break;
        case "new": {
            echo displayOrderTable(getNewestOrder());
        } break;
        case "priceUp": {
            echo displayOrderTable(sortByPriceUp());
        } break;
        case "priceDown": {
            echo displayOrderTable(sortByPriceDown());
        } break;
    }
} else if (isset($_POST['status']) && !empty($_POST['status'])) {
    $status = $_POST['status'];
    if ($status == "default") {
        echo displayOrderTable(getOrderList());
    } else if ($status == "none") {
        echo displayOrderTable(getOrderFilterByStatus(0));
    } else {
        echo displayOrderTable(getOrderFilterByStatus(1));
    }
}

function getOrderList() {
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
    $db->disconnect();
    return $orderArr;
}

// Hàm hiển thị các dòng thông tin order trong table
function displayOrderTable($orderArr)
{
    $content = "";
    for ($i = 0; $i < count($orderArr); $i++) {
        if ($orderArr[$i]->getStatus())
            $status = "Đã xử lý";
        else
            $status = "Chưa xử lý";

        $content .= "
        <tr>
            <td class=\"order-id\"><a>" . $orderArr[$i]->getId() . "</a></td>
            <td class=\"total\">" . changeMoney($orderArr[$i]->getTotal()) . "₫</td>
            <td class=\"status\">" . $status . "</td>
            <td class=\"date\">" . $orderArr[$i]->getCreatedDate() . "</td>
            <td class=\"glasss\"><a href=\"/faion/index.php/admin/orders/orders?id=" . $orderArr[$i]->getId() . "\"><i class=\"fa-solid fa-magnifying-glass\" onclick=\"\"></i></a></td>
        </tr>";
    }
    return $content;
}

function getNewestOrder() {
    $orderList = getOrderList();
    $max = -1;
    for ($i = 0; $i < count($orderList) - 1; $i++) {
        $max = $i;
        for ($j = $i + 1; $j < count($orderList); $j++) {
            if ($orderList[$max]->getId() < $orderList[$j]->getId()) {
                $max = $j;
            }
        }
        if ($max != $i) {
            $temp = $orderList[$i];
            $orderList[$i] = $orderList[$max];
            $orderList[$max] = $temp;
        }
    }
    return $orderList;
}

function sortByPriceUp() {
    $orderList = getOrderList();
    $min = -1;
    for ($i = 0; $i < count($orderList) - 1; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < count($orderList); $j++) {
            if ($orderList[$min]->getTotal() > $orderList[$j]->getTotal()) {
                $min = $j;
            }
        }
        if ($min != $i) {
            $temp = $orderList[$i];
            $orderList[$i] = $orderList[$min];
            $orderList[$min] = $temp;
        }
    }
    return $orderList;
}

function sortByPriceDown() {
    $orderList = getOrderList();
    $max = -1;
    for ($i = 0; $i < count($orderList) - 1; $i++) {
        $max = $i;
        for ($j = $i + 1; $j < count($orderList); $j++) {
            if ($orderList[$max]->getTotal() < $orderList[$j]->getTotal()) {
                $max = $j;
            }
        }
        if ($max != $i) {
            $temp = $orderList[$i];
            $orderList[$i] = $orderList[$max];
            $orderList[$max] = $temp;
        }
    }
    return $orderList;
}

function getOrderFilterByStatus($status) {
    $orderList = getorderList();
    $list = array();
    for ($i = 0; $i < count($orderList); $i++) {
        if ($orderList[$i]->getStatus() == $status) {
            $list[] = $orderList[$i];
        }
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

function getDMYdate($date)
{
	$arr = explode("-", $date);
	$newArr = array();
	for ($i = count($arr) - 1; $i >= 0; $i--) {
		$newArr[] = $arr[$i];
	}
	$newDate = "";
	for ($i = 0; $i < count($newArr); $i++) {
		$newDate .= $newArr[$i];
		if ($i != count($newArr) - 1)
			$newDate .= "/";
	}
	return $newDate;
}

function getDateCreated($date)
{
    $date = explode(" ", $date);
    return $date[0];
}


?>
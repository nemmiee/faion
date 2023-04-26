<?php 
include ('../../faion/connection/Database.php');
include ('../../faion/object/Account.php');
include ('../../faion/object/Customer.php');
if (isset($_POST['sortBy']) && !empty($_POST['sortBy']) && !isset($_POST['role'])) {
    $sortBy = $_POST['sortBy'];
    switch ($sortBy) {
        case "default": {
            echo displayUserTable(getAccountList());
        } break;
        case "roleUp": {
            echo displayUserTable(sortRoleUp());
        } break;
        case "roleDown": {
            echo displayUserTable (sortRoleDown());
        } break;
    }
} else if (isset($_POST['role']) && !empty($_POST['role'])) {
    $role = $_POST['role'];
    switch ($role) {
        case "default": {
            echo displayUserTable(getAccountList());
        } break;
        case "manager": {
            echo displayUserTable(filterRole(0));
        } break;
        case "admin": {
            echo displayUserTable (filterRole(1));
        } break;
        case "staff": {
            echo displayUserTable(filterRole(2));
        } break;
        case "user": {
            echo displayUserTable (filterRole(3));
        } break;
    }
} else if (isset($_POST['status']) && !empty($_POST['status'])) {
    $status = $_POST['status'];
    switch ($status) {
        case "default": {
            echo displayUserTable(getAccountList());
        } break;
        case "yes": {
            echo displayUserTable(filterStatus(1));
        } break;
        case "no": {
            echo displayUserTable (filterStatus(0));
        } break;
    }
}


function displayUserTable($accountList)
{
    $content = "";
    for ($i = 0; $i < count($accountList); $i++) {
        $customer = getCustomerById($accountList[$i]->getId());
        $content .= "
        <tr>
            <th class=\"checkbox\"><input type=\"checkbox\" class=\"account-checkbox\" value=\"" . $accountList[$i]->getId() . "\"></th>
            <td class=\"username\">
                <a href=\"/faion/index.php/admin/users?id=" . $accountList[$i]->getId() . "\">" . $accountList[$i]->getUsername() . "</a>
            </td>
            <td class=\"email\">" . $customer->getEmail() . "</td>
            <td class=\"role\">" . getRoleName($accountList[$i]->getRole()) . "</td>";
        if ($accountList[$i]->getStatus() == 1) {
            $content .= "<td class=\"status active\">" . getStatusName($accountList[$i]->getStatus()) . "</td>
            <td class=\"lock\">
                <i class=\"fa-solid fa-lock-open fa-fw fa-lg\" onclick=\"displayLock('single', " . 
                $accountList[$i]->getId() . ", " . $accountList[$i]->getStatus() . ")\"></i>
            </td>
        </tr>";
        } else {
            $content .= "<td class=\"status\">" . getStatusName($accountList[$i]->getStatus()) . "</td>
            <td class=\"lock\">
            <i class=\"fa-solid fa-lock fa-fw fa-lg\" onclick=\"displayLock('single', " . 
            $accountList[$i]->getId() . ", " . $accountList[$i]->getStatus() . ")\"></i>
            </td>
        </tr>";
        }
    }
    return $content;
}

function sortRoleUp() {
    $accountList = getAccountList();
    $max = -1;
    for ($i = 0; $i < count($accountList) - 1; $i++) {
        $max = $i;
        for ($j = $i + 1; $j < count($accountList); $j++) {
            if ($accountList[$max]->getRole() < $accountList[$j]->getRole()) {
                $max = $j;
            }
        }
        if ($max != $i) {
            $temp = $accountList[$i];
            $accountList[$i] = $accountList[$max];
            $accountList[$max] = $temp;
        }
    }
    return $accountList;
}

function sortRoleDown() {
    $accountList = getAccountList();
    $min = -1;
    for ($i = 0; $i < count($accountList) - 1; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < count($accountList); $j++) {
            if ($accountList[$min]->getRole() > $accountList[$j]->getRole()) {
                $min = $j;
            }
        }
        if ($min != $i) {
            $temp = $accountList[$i];
            $accountList[$i] = $accountList[$min];
            $accountList[$min] = $temp;
        }
    }
    return $accountList;
}

function filterRole($role) {
    $accountList = getAccountList();
    $filterList = array();
    for ($i = 0; $i < count($accountList); $i++) {
        if ($accountList[$i]->getRole() == $role) 
            $filterList[] = $accountList[$i];        
    }
    return $filterList;
}

function filterStatus($status) {
    $accountList = getAccountList();
    $filterList = array();
    for ($i = 0; $i < count($accountList); $i++) {
        if ($accountList[$i]->getStatus() == $status) 
            array_push($filterList, $accountList[$i]);        
    }
    return $filterList;
}

/*
    Hàm lấy tên của vai trò của người dùng
    $role (int): gồm 3 giá trị: 0, 1, 2
*/
function getRoleName($role)
{
    switch ($role) {
        case 0:
            return "Quản lý - Manager";
        case 1:
            return "Quản trị viên - Admin";
        case 2:
            return "Nhân viên - Staff";
        case 3:
            return "Người dùng - User";
    }
}

/*
    Hàm lấy tên của tình trạng tài khoản
    $status (int): gồm 2 giá trị: 0, 1
*/
function getStatusName($status)
{
    switch ($status) {
        case 0:
            return "Ngừng hoạt động";
        case 1:
            return "Hoạt động";
    }
}

function getCustomerList()
{
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
    $db->disconnect();
	return $list;
}

function getAccountList()
{
	$db = new Database();
	$kq = mysqli_query($db->getConnection(), "SELECT * FROM account");
	$list = array();
	while ($row = mysqli_fetch_assoc($kq)) {
		$account = new Account(
			$row['id'],
			$row['username'],
			$row['password'],
			$row['status'],
			$row['role']
		);
		$list[] = $account;
	}
    $db->disconnect();
	return $list;
}

function getCustomerById($id) {
    $customerList = getCustomerList();
    for ($i = 0; $i < count($customerList); $i++) {
        if ($customerList[$i]->getId() == $id) {
            return $customerList[$i];
        }
    }
    return null;
}
?>


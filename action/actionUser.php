<?php
if (isset($_POST['user-change-submit'])) {
    // Trường hợp chọn thay đổi thông tin
    $id = $_POST['id'];
    $pos = -1;
    $accountList = getAccountList();
    for ($i = 0; $i < count($accountList); $i++) {
        if ($accountList[$i]->getId() == $id) {
            $pos = $i;
            break;
        }
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];
    $status = $_POST['status'];

    $count = 0;
    if ($username != $accountList[$pos]->getUsername()) {
        ++$count;
    }
    if ($password != $accountList[$pos]->getPassword()) {
        ++$count;
    }
    if ($role != $accountList[$pos]->getRole()) {
        ++$count;
    }
    if ($status != $accountList[$pos]->getStatus()) {
        ++$count;
    }

    if ($count > 0) {
        // Trường hợp nếu có sự thay đổi thông tin
        $db = new Database();
        $sql = "UPDATE account SET username = '$username', password = '$password', role = '$role', 
        status = '$status' WHERE id = '$id'";
        if ($db->insert_update_delete($sql)) {
            $db->disconnect();
            echo "<script>
                        alert(\"Sửa thông tin tài khoản thành công.\");
                        window.location = '/faion/index.php/admin/users?id=$id'; 
                    </script>";
        } else {
            $db->disconnect();
            echo "<script>
                    alert(\"Sửa thông tin tài khoản thất bại.\"); 
                    window.location = '/faion/index.php/admin/users?id=$id'; 
                </script>";
        }
    } else {
        // Trường hợp không có sự thay đổi thông tin
        session_start();
        $_SESSION["isNotChange"] = "true";
        header("Location:/faion/index.php/admin/users?id=" . $id);
        die;
    }
} else if (isset($_POST['user-lock-unlock-submit']) && $_POST['id'] != "") {
    // Trường hợp ấn vào icon Lock để khóa hoặc mở khóa
    $id = $_POST['id'];
    $accountList = getAccountList();

    if ($accountList[$id - 1]->getStatus() != 0) {
        // Trường hợp tài khoản chưa bị khóa
        $sql = "UPDATE account SET status = 0 WHERE id='$id'";
        $db = new Database();
        if ($db->insert_update_delete($sql)) {
            $db->disconnect();
            echo "<script>
                    alert(\"Khóa người dùng thành công.\");
                    window.location = '/faion/index.php/admin/users/'; 
                </script>";
        } else {
            $db->disconnect();
            echo "<script>
                    alert(\"Khóa người dùng thất bại.\");
                    window.location = '/faion/index.php/admin/users/';
                </script>";
        }
    } else {
        // Trường hợp tài khoản đã bị khóa
        $sql = "UPDATE account SET status = 1 WHERE id='$id'";
        $db = new Database();
        if ($db->insert_update_delete($sql)) {
            $db->disconnect();
            echo "<script>
                    alert(\"Mở khóa người dùng thành công.\");
                    window.location = '/faion/index.php/admin/users/'; 
                </script>";
        } else {
            $db->disconnect();
            echo "<script>
                    alert(\"Mở khóa người dùng thất bại.\");
                    window.location = '/faion/index.php/admin/users/';
                </script>";
        }
    }
} else if (isset($_POST['user-lock-submit']) && $_POST['id'] != "") {
    // Trường hợp chọn button khóa nhiều tài khoản
    $accountList = getAccountList();
    $arr = explode("-", $_POST['id']);
    $db = new Database();
    for ($i = 0; $i < count($arr); $i++) {
        $sql = "UPDATE account SET status = 0 WHERE id=" . $arr[$i];
        $db->insert_update_delete($sql);
    }
    $db->disconnect();
    echo "<script>
            alert(\"Khóa các người dùng thành công.\");
            window.location = '/faion/index.php/admin/users/'; 
        </script>";
} else if (isset($_POST['user-account-change-submit']) && $_POST['id'] != "") {
    // User tự đổi mật khẩu
    $id = $_POST['id'];
    $pos = -1;
    $accountList = getAccountList();
    for ($i = 0; $i < count($accountList); $i++) {
        if ($accountList[$i]->getId() == $id) {
            $pos = $i;
            break;
        }
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $count = 0;
    if ($username != $accountList[$pos]->getUsername()) {
        ++$count;
    }
    if ($password != $accountList[$pos]->getPassword()) {
        ++$count;
    }

    if ($count > 0) {
        // Trường hợp nếu có sự thay đổi thông tin
        $db = new Database();
        $sql = "UPDATE account SET username = '$username', password = '$password'  WHERE id = '$id'";
        if ($db->insert_update_delete($sql)) {
            $db->disconnect();
            echo "<script>
                        alert(\"Sửa thông tin tài khoản thành công.\");
                        window.location = '/faion/index.php/user/account/'; 
                    </script>";
        } else {
            $db->disconnect();
            echo "<script>
                    alert(\"Sửa thông tin tài khoản thất bại.\"); 
                    window.location = '/faion/index.php/user/account/'; 
                </script>";
        }
    } else {
        // Trường hợp không có sự thay đổi thông tin
        session_start();
        $_SESSION["isNotChange"] = "true";
        header("Location:/faion/index.php/user/account/");
        die;
    }
}

function getAccountList()
{
    include('../../faion/connection/Database.php');
    include('../../faion/object/Account.php');
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
    sort($list);
    return $list;
}

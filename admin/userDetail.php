<?php
if (isset($_SESSION['isNotChange'])) {
    echo "<script>alert('Không có sự thay đổi nào!');</script>";
    unset($_SESSION['isNotChange']);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $customerList = getCustomerList();
    $arr = getAccountList();
    $pos = -1;
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i]->getId() == $id) {
            $account = $arr[$i];
            $pos = $i;
            break;
        }
    }
    echo "
    <div class=\"content-container\">
    <div class=\"content\">
        <form action=\"/faion/action/actionUser.php\" method=\"post\" id=\"changeUserForm\">
            <div class=\"title\">
                <div class=\"left\">Sửa tài khoản người dùng</div>
                <div class=\"right\">
                    <a href=\"/faion/index.php/admin/customers?id=$id\">Đến trang thông tin khách hàng</a>
                </div>
            </div>
            <div class=\"top\">
                <div class=\"max-container\">
                    <label for=\"username\">Tên tài khoản:</label>
                    <input type=\"text\" name=\"username\" id=\"username\" value=\"" . $account->getUsername() . "\">
                </div>
                <div class=\"max-container\">
                    <label for=\"password\">Mật khẩu:</label>
                    <input type=\"text\" name=\"password\" id=\"password\" value=\"" . $account->getPassword() . "\">
                </div>
                <div class=\"half-container\">
                    <div class=\"left\">
                        <label for=\"role\">Quyền hạn:</label>
                        <select name=\"role\" id=\"role\">
                            <option value=\"0\"";
        if ($account->getRole() == 0) echo "selected";
        echo ">Quản lý - Manager</option>
                            <option value=\"1\"";
        if ($account->getRole() == 1) echo "selected";
        echo ">Quản trị viên - Admin</option>
                            <option value=\"2\"";
        if ($account->getRole() == 2) echo "selected";
        echo ">Nhân viên - Staff</option>
                            <option value=\"3\"";
        if ($account->getRole() == 3) echo "selected";
        echo ">Người dùng - User</option>
                        </select>
                    </div>
                    <div class=\"right\">
                        <label for=\"status\">Tình trạng:</label>
                        <select name=\"status\" id=\"status\">
                            <option value=\"1\"";
        if ($account->getStatus() == 1) echo "selected";
        echo ">Hoạt động</option>
                            <option value=\"0\"";
        if ($account->getStatus() == 0) echo "selected";
        echo ">Ngừng hoạt động</option>
                        </select>
                    </div>
                </div>
                <div class=\"half-container\">
                    <div class=\"left\">
                        <label for=\"email\">Email:</label>
                        <input type=\"text\" name=\"\" id=\"email\" value=\"" . $customerList[$pos]->getEmail() . "\" readonly>
                    </div>
                    <div class=\"right\">
                        <label for=\"date\">Ngày đăng ký:</label>
                        <input type=\"text\" name=\"\" id=\"date\" value=\"" . $customerList[$pos]->getCreatedAt() . "\" readonly>
                    </div>
                </div>
            </div>
            <div class=\"bottom\">
                <input type=\"text\" name=\"id\" value=\"" . $account->getId() . "\" style=\"display: none;\">
                <input type=\"submit\" name=\"user-change-submit\" value=\"CHỈNH SỬA\">
            </div>
        </form>
    </div>
    </div>";
}

?>

<script>

</script>
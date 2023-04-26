<div id="top-sub-header">
    <div class="sort-container">
        <label for="sort">Sắp xếp theo</label>
        <select id="sort">
            <option value="default" selected>Mặc định</option>
            <option value="roleDown">Quyền hạn giảm dần</option>
            <option value="roleUp">Quyền hạn tăng dần</option>
        </select>
    </div>
    <div class="sort-container">
        <label for="statusFilter">Lọc theo tình trạng</label>
        <select id="statusFilter">
            <option value="default" selected>Mặc định</option>
            <option value="yes">Hoạt động</option>
            <option value="no">Ngừng hoạt động</option>
        </select>
    </div>
    <div class="sort-container">
        <label for="roleFilter">Lọc theo quyền hạn</label>
        <select id="roleFilter">
            <option value="default" selected>Mặc định</option>
            <option value="manager">Quản lý - Manager</option>
            <option value="admin">Quản trị viên - Admin</option>
            <option value="staff">Nhân viên - Staff</option>
            <option value="user">Người dùng - User</option>
        </select>
    </div>
</div>
<div class="content">
    <div class="table-container">
        <table class="table" cellspacing="0">
            <thead>
                <tr>
                    <th class="checkbox">&nbsp;</th>
                    <th class="username">Tên tài khoản</th>
                    <th class="email">Email</th>
                    <th class="role">Quyền hạn</th>
                    <th class="status">Tình trạng</th>
                    <th class="lock">&nbsp;</th>
                </tr>
            </thead>
            <tbody id="user-info">
                <?php displayUserTable() ?>
            </tbody>
        </table>
    </div>
    <div class="button-container">
        <button class="btn" onclick="displayLock('many', 0, null)">Khóa người dùng đã chọn</button>
    </div>
</div>


<script>
    var sort = document.getElementById("sort");
    var role = document.getElementById("roleFilter");
    var statusFilter = document.getElementById("statusFilter");

    sort.addEventListener("change", function() {
        var request = "sortBy=" + sort.value;
        var xml = new XMLHttpRequest();
        xml.open("POST", "/faion/action/actionSortUserAdmin.php", true);
        xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                role.value = "default";
                statusFilter.value = "default";
                document.getElementById("user-info").innerHTML = this.responseText;
            }
        };
        xml.send(request);
    });

    role.addEventListener("change", function() {
        var request = "role=" + role.value;
        var xml = new XMLHttpRequest();
        xml.open("POST", "/faion/action/actionSortUserAdmin.php", true);
        xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                sort.value = "default";
                statusFilter.value = "default";
                document.getElementById("user-info").innerHTML = this.responseText;
            }
        };
        xml.send(request);
    });

    statusFilter.addEventListener("change", function() {
        var request = "status=" + statusFilter.value;
        var xml = new XMLHttpRequest();
        xml.open("POST", "/faion/action/actionSortUserAdmin.php", true);
        xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                sort.value = "default";
                role.value = "default";
                document.getElementById("user-info").innerHTML = this.responseText;
            }
        };
        xml.send(request);
    });
</script>


<?php
function displayUserTable()
{
    $accountList = getAccountList();
    $customerList = getCustomerList();
    for ($i = 0; $i < count($accountList); $i++) {
        echo "
        <tr>
            <th class=\"checkbox\"><input type=\"checkbox\" class=\"account-checkbox\" value=\"" . $accountList[$i]->getId() . "\"></th>
            <td class=\"username\"><a href=\"/faion/index.php/admin/users?id=" . $accountList[$i]->getId() . "\">" . $accountList[$i]->getUsername() . "</a></td>
            <td class=\"email\">" . $customerList[$i]->getEmail() . "</td>
            <td class=\"role\">" . getRoleName($accountList[$i]->getRole()) . "</td>";
        if ($accountList[$i]->getStatus() == 1) {
            echo "<td class=\"status active\">" . getStatusName($accountList[$i]->getStatus()) . "</td>
            <td class=\"lock\"><i class=\"fa-solid fa-lock-open fa-fw fa-lg\" onclick=\"displayLock('single', " . $accountList[$i]->getId() . ", " . $accountList[$i]->getStatus() . ")\"></i>
            </td>
        </tr>";
        } else {
            echo "<td class=\"status\">" . getStatusName($accountList[$i]->getStatus()) . "</td>
            <td class=\"lock\">
            <i class=\"fa-solid fa-lock fa-fw fa-lg\" onclick=\"displayLock('single', " . $accountList[$i]->getId() . ", " . $accountList[$i]->getStatus() . ")\"></i>
            </td>
        </tr>";
        }
    }
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


?>
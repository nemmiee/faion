<?php
if (isset($_SESSION['isNotChange'])) {
    echo "<script>alert('Không có sự thay đổi nào!');</script>";
    unset($_SESSION['isNotChange']);
}

$uri = $_SERVER['REQUEST_URI'];
$infoRegEx = '/\binfo\b/';
$customerList = getCustomerList();
$accountList = getAccountList();
$pos = -1;
for ($i = 0; $i < count($customerList); $i++) {
    if ($customerList[$i]->getId() == $_SESSION["id"]) {
        $pos = $i;
        break;
    }
}
?>
<main id='main'>
    <?php include('../faion/admin/adminSidebar.php'); ?>
    <div class='right-content-container' style='height: auto;'>
        <div id="top-sub-header"></div>
        <?php
        if (preg_match($infoRegEx, $uri)) {
        ?>
            <div class='content-container'>
                <div class='content'>
                    <form action='/faion/action/actionCustomer.php' method='post' id='changeCustomerForm' onsubmit='return checkCustomer(event)'>
                        <div class='title'>
                            <div class='left' style="text-align: center; width: 100%;">CHỈNH SỬA THÔNG TIN</div>
                        </div>
                        <div class='top'>
                            <div class='container'>
                                <label for='cusname'>Họ và tên:</label>
                                <input type='text' name='name' id='cusname' value='<?php echo $customerList[$pos]->getName(); ?>'>
                            </div>
                            <div class='container'>
                                <label for='cusemail'>Email:</label>
                                <input type='text' name='email' id='cusemail' value='<?php echo $customerList[$pos]->getEmail(); ?>'>
                            </div>
                            <div class='container'>
                                <label for='cusaddress'>Địa chỉ:</label>
                                <input type='text' name='address' id='cusaddress' value='<?php echo $customerList[$pos]->getAddress(); ?>'>
                            </div>
                            <div class='container'>
                                <label for='cusphone'>Số điện thoại:</label>
                                <input type='text' name='phoneNum' id='cusphone' value='<?php echo $customerList[$pos]->getPhoneNum(); ?>'>
                            </div>
                        </div>
                        <div class='bottom'>
                            <input type='text' name='id' value='<?php echo $customerList[$pos]->getId(); ?>' style='display: none;'>
                            <input type='submit' name='customer-info-change-submit' value='CHỈNH SỬA'>
                        </div>
                    </form>
                </div>
            </div>
    </div>
<?php
        } else {
?>
    <div class='content-container'>
        <div class='content'>
            <form action='/faion/action/actionUser.php' method='post' id='changeUserForm' onsubmit="return checkChangeAccountInfo(event)">
                <div class='title'>
                    <div class='left' style="text-align: center; width: 100%;">ĐỔI THÔNG TIN TÀI KHOẢN</div>
                </div>
                <div class='top'>
                    <div class='max-container'>
                        <label for='username'>Tên tài khoản:</label>
                        <input type='text' name='username' id='username' value='<?php echo $accountList[$pos]->getUsername(); ?>'>
                    </div>
                    <div class='max-container'>
                        <label for='password'>Mật khẩu:</label>
                        <input type='password' name='password' id='password' value='<?php echo $accountList[$pos]->getPassword(); ?>'>
                    </div>    
                    <div class='max-container'>
                        <label for='confirm-password'>Nhập lại mật khẩu:</label>
                        <input type='password' name='confirm-password' id='confirm-password' value='<?php echo $accountList[$pos]->getPassword(); ?>'>
                    </div>   
                </div>
                <div class='bottom'>
                    <input type='text' name='id' value='<?php echo $accountList[$pos]->getId(); ?>' style='display: none;'>
                    <input type='submit' name='user-account-change-submit' value='CHỈNH SỬA'>
                </div>
            </form>
        </div>
    </div>";
<?php
        }
?>
</div>
</main>
<script>
    function checkChangeAccountInfo(e) {

        var username = document.getElementById("username");
        var password = document.getElementById("password");
        var confirmPassword = document.getElementById("confirm-password");

        if (username.value == "" || username.value == undefined || username.value == NaN) {
            //alertMessage("fail", "Mời nhập tên đăng nhập!");
            alert("Mời nhập tên đăng nhập");
            username.focus();
            e.preventDefault();
            return false;
        } else if (password.value == "" || password.value == undefined || password.value == NaN) {
            //alertMessage("fail", "Mời nhập mật khẩu!");
            alert("Mời nhập mật khẩu");
            password.focus();
            e.preventDefault();
            return false;
        } else if (confirmPassword.value == "" || confirmPassword.value == undefined || confirmPassword == NaN) {
            //alertMessage("fail", "Mời nhập xác nhận mật khẩu!");
            alert("Mời nhập xác nhận mật khẩu");
            confirmPassword.focus();
            e.preventDefault();
            return false;
        } else if (confirmPassword.value != password.value && confirmPassword.value != "" && password.value != "") {
            //alertMessage("fail", "Mật khẩu bạn vừa nhập không trùng khớp!");
            alert("Mật khẩu bạn vừa nhập không trùng khớp");
            confirmPassword.focus();
            e.preventDefault();
            return false;
        }
    }
</script>
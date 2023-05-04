<main>
    <div id="mainDKContent-theme">
        <div class="heading-account">
            <div class="header-page">Tạo tài khoản</div>
        </div>
        <div class="content-account">
            <div class="userbox">
                <form id="sign-up-form" name="sign-up-form" method="post" action="">
                    <div class="input-control">
                        <label for="fullname">Họ và tên:</label>
                        <input type="text" placeholder="Họ và tên" id="fullname" name="fullname" class="input-box" value="<?php
                                                                                                                            if (isset($_POST['fullname']) && $_POST['fullname'] != "")
                                                                                                                                echo $_POST['fullname'];
                                                                                                                            ?>">
                        <div class="error"></div>
                    </div>
                    <div class="input-control">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" placeholder="Địa chỉ" id="address" name="address" class="input-box" value="<?php
                                                                                                                        if (isset($_POST['address']) && $_POST['address'] != "")
                                                                                                                            echo $_POST['address'];
                                                                                                                        ?>">
                        <div class="error"></div>
                    </div>
                    <div class="input-control">
                        <label for="phonenum">Số điện thoại:</label>
                        <input type="text" placeholder="Số điện thoại" id="phonenum" name="phonenum" class="input-box" value="<?php
                                                                                                                                if (isset($_POST['phonenum']) && $_POST['phonenum'] != "")
                                                                                                                                    echo $_POST['phonenum'];
                                                                                                                                ?>">
                        <div class="error"></div>
                    </div>
                    <div class="input-control">
                        <label for="email">Email:</label>
                        <input type="text" placeholder="Email" id="email" name="email" class="input-box" value="<?php
                                                                                                                if (isset($_POST['email']) && $_POST['email'] != "")
                                                                                                                    echo $_POST['email'];
                                                                                                                ?>">
                        <div class="error"></div>
                    </div>
                    <div class="input-control">
                        <label for="username">Tên đăng nhập:</label>
                        <input type="text" placeholder="Tên đăng nhập" id="username" name="username" class="input-box" value="<?php
                                                                                                                                if (isset($_POST['username']) && $_POST['username'] != "")
                                                                                                                                    echo $_POST['username'];
                                                                                                                                ?>">
                        <div class="error"></div>
                    </div>
                    <div class="input-control">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" placeholder="Mật khẩu" id="password" name="password" class="input-box" value="<?php
                                                                                                                                if (isset($_POST['password']) && $_POST['password'] != "")
                                                                                                                                    echo $_POST['password'];
                                                                                                                                ?>">
                        <div class="error"></div>
                    </div>
                    <div class="input-control">
                        <label for="confirmPassword">Nhập lại mật khẩu:</label>
                        <input type="password" placeholder="Nhập lại mật khẩu" id="confirmPassword" name="confirmPassword" class="input-box" value="<?php
                                                                                                                                                    if (isset($_POST['confirmPassword']) && $_POST['confirmPassword'] != "")
                                                                                                                                                        echo $_POST['confirmPassword'];
                                                                                                                                                    ?>">
                        <div class="error"></div>
                    </div>
                    <div id="signup-btn-container">
                        <button type="submit" id="signup-btn" name="signup-btn" onclick="checkSignUp(event)">Đăng Ký</button>
                    </div>
                </form>
                <div class="sign-in-link">
                    <a href="/faion/index.php/login/">
                        <i class="fa-solid fa-arrow-left"></i>
                        Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function checkSignUp(e) {
        var fullnameRegEx = /[0-9@#$%^&*]{1,}/;
        //var usernameRegEx = /KH[a-zA-Z]{7}[0-9]{5}/;
        var emailRegEx = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        var phoneRegEx = /^0[0-9]{8,9}$/;

        var fullname = document.getElementById("fullname");
        var username = document.getElementById("username");
        var address = document.getElementById("address");
        var email = document.getElementById("email");
        var phoneNum = document.getElementById("phonenum");
        var password = document.getElementById("password");
        var confirmPassword = document.getElementById("confirmPassword");

        if (fullname.value.trim() == "" || fullname.value.trim() == undefined || fullname.value.trim() == NaN) {
            alert("Mời nhập họ và tên");
            fullname.focus();
            e.preventDefault();
            return false;
        } else if (fullnameRegEx.test(fullname.value.trim()) == true && fullname.value.trim() != "") {
            alert("Họ và tên không hợp lệ");
            fullname.focus();
            e.preventDefault();
            return false;
        } else if (address.value.trim() == "" || address.value.trim() == undefined || address.value.trim() == NaN) {
            alert("Mời nhập địa chỉ");
            address.focus();
            e.preventDefault();
            return false;
        } else if (phoneNum.value.trim() == "" || phoneNum.value.trim() == undefined || phoneNum.value.trim() == NaN) {
            alert("Mời nhập số điện thoại");
            phoneNum.focus();
            e.preventDefault();
            return false;
        } else if (!phoneRegEx.test(phoneNum.value.trim()) && phoneNum.value.trim() != "") {
            alert("Số điện thoại không đúng định dạng");
            phoneNum.focus();
            e.preventDefault();
            return false;
        } else if (email.value.trim() == "" || email.value.trim() == undefined || email.value.trim() == NaN) {
            alert("Mời nhập email");
            email.focus();
            e.preventDefault();
            return false;
        } else if (!emailRegEx.test(email.value.trim()) && email.value.trim() != "") {
            alert("Email không đúng");
            email.focus();
            e.preventDefault();
            return false;
        } else if (username.value.trim() == "" || username.value.trim() == undefined || username.value.trim() == NaN) {
            alert("Mời nhập tên đăng nhập");
            username.focus();
            e.preventDefault();
            return false;
        } else if (password.value.trim() == "" || password.value.trim() == undefined || password.value.trim() == NaN) {
            alert("Mời nhập mật khẩu");
            password.focus();
            e.preventDefault();
            return false;
        } else if (confirmPassword.value.trim() == "" || confirmPassword.value.trim() == undefined || confirmPassword.value.trim() == NaN) {
            alert("Mời nhập xác nhận mật khẩu");
            confirmPassword.focus();
            e.preventDefault();
            return false;
        } else if (confirmPassword.value.trim() != password.value.trim() && confirmPassword.value.trim() != "" && password.value.trim() != "") {
            alert("Mật khẩu nhập lại không trùng khớp");
            confirmPassword.focus();
            e.preventDefault();
            return false;
        }
    }
</script>

<?php
function createAccountId()
{
    $db = new Database();
    $kq = mysqli_query($db->getConnection(), "SELECT id FROM account");
    $arr = array();
    $id = 0;
    while ($row = mysqli_fetch_assoc($kq)) {
        $arr[] = $row['id'];
    }
    if (count($arr) == 0) {
        $id = 1;
    } else if (count($arr) == 1) {
        $id = 2;
    } else {
        sort($arr);
        for ($i = 0; $i < count($arr) - 1; $i++) {
            if ($arr[$i + 1] - $arr[$i] > 1) {
                $id = $arr[$i] + 1;
                break;
            }
            if ($i == count($arr) - 2) {
                $id = $arr[$i + 1] + 1;
                break;
            }
        }
    }
    $db->disconnect();
    return $id;
}


if (
    isset($_POST['fullname']) && isset($_POST['address']) && isset($_POST['phonenum'])
    && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword'])
) {
    $fullname = trim($_POST['fullname']);
    $address = trim($_POST['address']);
    $phoneNum = trim($_POST['phonenum']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $date = date("Y-m-d");

    $customerList = getCustomerList();
    $isExistEmail = false;
    $isExistPhoneNum = false;
    for ($i = 0; $i < count($customerList); $i++) {
        if ($customerList[$i]->getEmail() == $email) {
            $isExistEmail = true;
        }
        if ($customerList[$i]->getPhoneNum() == $phoneNum) {
            $isExistPhoneNum = true;
        }
    }

    if ($isExistPhoneNum && !$isExistEmail) {
        echo "<script>alert(\"Số điện thoại này đã được sử dụng.\");
                document.getElementById(\"phonenum\").focus();
            </script>";
    } else if (!$isExistPhoneNum && $isExistEmail) {
        echo "<script>alert(\"Email này đã được sử dụng.\");
                document.getElementById(\"email\").focus();
            </script>";
    } else if ($isExistEmail && $isExistPhoneNum) {
        echo "<script>alert(\"Số điện thoại và email này đã được sử dụng.\"); 
                    document.getElementById(\"phonenum\").focus();
                </script>";
    } else {
        $accountQuery = "INSERT INTO account (id, username, password, status, role) VALUES (" . createAccountId() . ", '$username', '$password', 1, 3)";
        $customerQuery = "INSERT INTO customer (id, name, email, address, phone_number, created_at) VALUES (" . createAccountId() . ", '$fullname', '$email', '$address', '$phoneNum', '$date')";
        if ($db->insert_update_delete($customerQuery) && $db->insert_update_delete($accountQuery)) {
            echo "
            <script>
                alert(\"Đăng ký thành công\");
                window.location = '/faion/index.php/login/'; 
            </script>";
        } else {
            echo "<script>alertMessage(\"fail\", \"Đăng ký không thành công\"); </script>";
        }
    }
}

?>
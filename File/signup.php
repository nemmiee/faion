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
                        <input type="text" placeholder="Họ và tên" id="fullname" name="fullname" class="input-box" value="">
                        <div class="error"></div>
                    </div>
                    <div class="input-control">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" placeholder="Địa chỉ" id="address" name="address" class="input-box" value="">
                        <div class="error"></div>
                    </div>
                    <div class="input-control">
                        <label for="phonenum">Số điện thoại:</label>
                        <input type="text" placeholder="Số điện thoại" id="phonenum" name="phonenum" class="input-box" value="">
                        <div class="error"></div>
                    </div>
                    <div class="input-control">
                        <label for="email">Email:</label>
                        <input type="text" placeholder="Email" id="email" name="email" class="input-box">
                        <div class="error"></div>
                    </div>
                    <div class="input-control">
                        <label for="username">Tên đăng nhập:</label>
                        <input type="text" placeholder="Tên đăng nhập" id="username" name="username" class="input-box" value="">
                        <div class="error"></div>
                    </div>
                    <div class="input-control">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" placeholder="Mật khẩu" id="password" name="password" class="input-box" value="">
                        <div class="error"></div>
                    </div>
                    <div class="input-control">
                        <label for="confirmPassword">Nhập lại mật khẩu:</label>
                        <input type="password" placeholder="Nhập lại mật khẩu" id="confirmPassword" name="confirmPassword" class="input-box" value="">
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
        var phoneRegEx = /0[0-9]{8,9}/;

        var fullname = document.getElementById("fullname");
        var username = document.getElementById("username");
        var address = document.getElementById("address");
        var email = document.getElementById("email");
        var phoneNum = document.getElementById("phonenum");
        var password = document.getElementById("password");
        var confirmPassword = document.getElementById("confirmPassword");

        if (fullname.value == "" || fullname.value == undefined || fullname.value == NaN) {
            //alertMessage("fail", "Mời nhập họ và tên!");
            alert("Mời nhập họ và tên");
            fullname.focus();
            e.preventDefault();
            return false;
        } else if (fullnameRegEx.test(fullname.value) == true && fullname.value != "") {
            //alertMessage("fail", "Họ và tên không hợp lệ!");
            alert("Họ và tên không hợp lệ");
            fullname.focus();
            e.preventDefault();
            return false;
        } else if (address.value == "" || address.value == undefined || address.value == NaN) {
            //alertMessage("fail", "Mời nhập địa chỉ!");
             alert("Mời nhập địa chỉ");
            address.focus();
            e.preventDefault();
            return false;
        } else if (phoneNum.value == "" || phoneNum.value == undefined || phoneNum.value == NaN) {
            //alertMessage("fail", "Mời nhập số điện thoại!");
            alert("Mời nhập số điện thoại");
            phoneNum.focus();
            e.preventDefault();
            return false;
        } else if (!phoneRegEx.test(phoneNum.value) && phoneNum.value != "") {
            //alertMessage("fail", "Số điện thoại không đúng định dạng!");
            alert("Số điện thoại không đúng");
            phoneNum.focus();
            e.preventDefault();
            return false;
        } else if (email.value == "" || email.value == undefined || email.value == NaN) {
            //alertMessage("fail", "Mời nhập email");
             alert("Mời nhập email");
            email.focus();
            e.preventDefault();
            return false;
        } else if (!emailRegEx.test(email.value) && email.value != "") {
            //alertMessage("fail", "Email không đúng!");
            alert("Email không đúng");
            email.focus();
            e.preventDefault();
            return false;
        } else if (username.value == "" || username.value == undefined || username.value == NaN) {
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

<?php
function createAccountId()
{
    $db = new Database();
    mysqli_query($db->getConnection(), "set names 'utf8'");
    $kq = mysqli_query($db->getConnection(), "SELECT id FROM account");
    $arr = array();
    $id = 0;
    while ($row = mysqli_fetch_array($kq)) {
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
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phoneNum = $_POST['phonenum'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $date = date("Y-m-d");

    $accountQuery = "INSERT INTO account (id, username, password, role) VALUES (" . createAccountId() . ", '$username', '$password', 1)";
    $customerQuery = "INSERT INTO customer (id, name, email, address, phone_number, created_at) VALUES (" . createAccountId() . ", '$fullname', '$email', '$address', '$phoneNum', '$date')";
    if ($db->insert_update_delete($customerQuery) && $db->insert_update_delete($accountQuery)) {
        echo "<script>
            alert(\"Đăng ký thành công\");
            window.location = '/faion/index.php/login/'; 
        </script>";
    } else {
        echo "<script>alertMessage(\"fail\", \"Đăng ký không thành công\"); </script>";
    }
}

?>
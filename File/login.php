<?php
include('../faion/template/sidebar.php');
?>

<main>
    <div id="mainContent-theme">
        <div id="login-title-container">
            <div class="login-theme">
                <img src="/faion/img/sizechecks/account_theme.jpg" alt="">
            </div>
        </div>
        <div id="login-account-container">
            <div id="logo-account">
                <img src="/faion/img/Logo/Faion_icon.png" alt="">
            </div>
            <div class="userbox">
                <form id="create-customer" name="signup" method="post">
                    <div id="tenDNlogin" class="userbox-inner">
                        <input type="text" placeholder="Tên đăng nhập" id="username" name="username" class="input-box" value="<?php
                                                                                                                                if (isset($_POST['username'])) {
                                                                                                                                    echo $_POST['username'];
                                                                                                                                }
                                                                                                                                ?>" autofocus>
                    </div>
                    <div id="passwordlogin" class="userbox-inner">
                        <input type="password" placeholder="Mật khẩu" id="Passwordlogin" name="password" class="input-box" value="<?php
                                                                                                                                    if (isset($_POST['password'])) {
                                                                                                                                        echo $_POST['password'];
                                                                                                                                    }
                                                                                                                                    ?>">
                        <button type="button" id="viewPass"><i class="fa-solid fa-eye-slash"></i></button>
                    </div>
                    <div id="loginerror">Sai tài khoản hoặc mật khẩu</div>
                    <div id="signin-btn-container">
                        <button type="submit" id="signin-btn">Đăng Nhập</button>
                    </div>
                </form>
                <div id="login-inner">
                    <div id="sign-up-link">Bạn chưa có tài khoản? <a href="/faion/index.php/signup/">Đăng ký</a></div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function checkLoginForm(e) {
        var username = document.getElementById("username");
        var password = document.getElementById("Passwordlogin");
        if (username.value == "" || username.value == undefined || username.value == NaN) {
            e.preventDefault();
            alertMessage("fail", "Mời nhập tên đăng nhập!");
            //username.focus();
            return false;
        } else if (password.value == "" || password.value == undefined || password.value == NaN) {
            e.preventDefault();
            alertMessage("fail", "Mời nhập mật khẩu!", "Passwordlogin");
            //password.focus();
            return false;
        }
    }

    // Hiển thị thông báo
    function alertMessage(type, message) {
        document.getElementById("alert-theme").classList.add("alertActive");
        var alert = document.getElementById("alert-container");
        var alertIcon = document.querySelectorAll(".alert-icon")[0];
        var typeMessage = document.querySelectorAll(".type-message")[0];
        var msg = document.querySelectorAll(".message")[0];
        var button = document.getElementById("confirm-btn");
        if (type == "success") {
            alert.classList.add("active");
            alertIcon.innerHTML = "<i class=\"fa-solid fa-check\" style=\"color: #A5DC86;\"></i>";
            alertIcon.style.border = "3px solid #EDF8E7";
            typeMessage.innerText = "Success"
            msg.innerText = message;

        } else {
            alert.classList.add("active");
            alertIcon.innerHTML = "<i class=\"fa-solid fa-xmark\" style=\"color: #F37777;\"></i>";
            alertIcon.style.border = "3px solid #F27474";
            typeMessage.innerText = "Error!"
            msg.innerText = message;
        }
        button.focus();
        setTimeout(closeAlert, 3000);
    }

    // Đóng thông báo
    function closeAlert() {
        var message = document.getElementById("alert-container").querySelectorAll(".message")[0].innerText;
        switch (message) {
            case "Bạn cần phải đăng nhập để thêm sản phẩm vào giỏ hàng":
                window.location.replace("/faion/index.php/login/");
                break;
            case "Đăng ký thành công":
                //window.location.replace("/faion/index.php/login/"); 
                break;
            default:
                document.getElementById("alert-container").classList.remove("active");
                document.getElementById("alert-theme").classList.remove("alertActive");
        }
    }

    // Đóng thông báo khi nhấn Enter
    var btn = document.getElementById("confirm-btn");
    btn.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            btn.click();
        }
    });

    // Xem mật khẩu khi ấn vào con mắt
    const viewPass = document.getElementById('viewPass');
    viewPass.addEventListener('click', function(e) {
        e.preventDefault();
        var password = document.getElementById("Passwordlogin");
        if (password.type == 'password') {
            password.type = 'text';
            viewPass.innerHTML = '<i class="fa-solid fa-eye"></i>';
        } else {
            password.type = 'password';
            viewPass.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
        }
    });


    document.getElementById("signin-btn").addEventListener("click", function(event) {
        event.preventDefault();
        var username = document.getElementById("username");
        var password = document.getElementById("Passwordlogin");
        if (username.value == "" || username.value == undefined || username.value == NaN) {
            event.preventDefault();
            alertMessage("fail", "Mời nhập tên đăng nhập!");
            //username.focus();
            return false;
        } else if (password.value == "" || password.value == undefined || password.value == NaN) {
            event.preventDefault();
            alertMessage("fail", "Mời nhập mật khẩu!");
            //password.focus();
            return false;
        }
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/faion/action/actionLogin.php", true);
        xhr.onreadystatechange = function() {
            if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
                //console.log(this.responseText);
                if (this.responseText == "success")
                    window.location = "/faion/index.php/";
                else if (this.responseText == "fail")
                    alertMessage('fail', "Tên đăng nhập hoặc mật khẩu không hợp lệ!");
                else
                    alertMessage('fail', "Tài khoản này đã bị khóa!");
            }
        };
        var form = document.getElementById("create-customer");
        var formData = new FormData(form);
        xhr.send(formData);
    });
</script>
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
                <form id="create-customer" name="signup" method="post" action="" onsubmit="return checkLoginForm(event)">
                    <div id="tenDNlogin" class="userbox-inner">
                        <input type="text" placeholder="Tên đăng nhập" id="username" name="username" class="input-box" value="<?php
                                                                                                                                if (isset($_POST['username'])) {
                                                                                                                                    echo $_POST['username'];
                                                                                                                                }
                                                                                                                                ?>">
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
                        <button type="submit" id="signin-btn" name="login">Đăng Nhập</button>
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
    viewPass.addEventListener('click', function (e) {
		e.preventDefault();
		var password = document.getElementById("Passwordlogin");
		if (password.type == 'password') {
			password.type = 'text';
			viewPass.innerHTML = '<i class="fa-solid fa-eye"></i>';
		}
		else {
			password.type = 'password';
			viewPass.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
		}
	}); 
</script>

<?php
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $db = new Database();
    $username = $_POST['username'];
    $password = $_POST['password'];
    //"SELECT tk.MaTK, kh.HoTen FROM taikhoan tk, khachhang kh WHERE tk.TenDN = '" . $_POST["txtTenDangNhap"] . "' and tk.MatKhau = '" . $_POST["txtPass"] . "'  AND tk.TenDN = kh.maKH"
    // $result = mysqli_query($db->getConnection(), "SELECT * FROM taikhoan WHERE TenDN='" . $_POST["txtTenDangNhap"] . "' and MatKhau = '" . $_POST["txtPass"] . "'");
    //$result = mysqli_query($db->getConnection(), "SELECT tk.MaTK, kh.HoTen, tk.Quyen FROM taikhoan tk, khachhang kh WHERE tk.TenDN = '" . $_POST["txtTenDangNhap"] . "' and tk.MatKhau = '" . $_POST["txtPass"] . "'  AND tk.TenDN = kh.maKH");
    $result = mysqli_query($db->getConnection(), "SELECT ac.id, ct.name, ac.role FROM account ac, customer ct WHERE ac.id = ct.id and ac.username = '" . $_POST['username'] . "' and ac.password = '" . $_POST['password'] . "'");
    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] = $row['name'];
        $_SESSION["role"] = $row['role'];
    } else {
        $message = "Tên đăng nhập hoặc mật khẩu không hợp lệ!";
        echo "<script>
        alertMessage(\"fail\", \"" . $message . "\");
        </script>";
    }
}
if (isset($_SESSION["id"]) && isset($_SESSION["name"])) {
    header("Location:/faion/index.php/");
}
?>

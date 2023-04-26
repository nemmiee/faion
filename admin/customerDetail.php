<?php
if (isset($_SESSION['isNotChange'])) {
    echo "<script>alert('Không có sự thay đổi nào!');</script>";
    unset($_SESSION['isNotChange']);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $arr = getCustomerList();
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i]->getId() == $id) {
            $customer = $arr[$i];
            break;
        }
    }
    echo "
        <div class=\"content-container\">
            <div class=\"content\">
                <form action=\"/faion/action/actionCustomer.php\" method=\"post\" id=\"changeCustomerForm\" onsubmit=\"return checkCustomer(event)\">
                    <div class=\"title\">
                        <div class=\"left\">Chỉnh sửa thông tin khách hàng</div>
                        <div class=\"right\">
                            <a href=\"/faion/index.php/admin/users?id=$id\">Đến trang tài khoản người dùng</a>
                        </div>
                    </div>
                    <div class=\"top\">
                        <div class=\"container\">
                            <label for=\"cusname\">Họ và tên:</label>
                            <input type=\"text\" name=\"name\" id=\"cusname\" value=\"" . $customer->getName() . "\">
                        </div>
                        <div class=\"container\">
                            <label for=\"cusemail\">Email:</label>
                            <input type=\"text\" name=\"email\" id=\"cusemail\" value=\"" . $customer->getEmail() . "\">
                        </div>
                        <div class=\"container\">
                            <label for=\"cusaddress\">Địa chỉ:</label>
                            <input type=\"text\" name=\"address\" id=\"cusaddress\" value=\"" . $customer->getAddress() . "\">
                        </div>
                        <div class=\"container\">
                            <label for=\"cusphone\">Số điện thoại:</label>
                            <input type=\"text\" name=\"phoneNum\" id=\"cusphone\" value=\"" . $customer->getPhoneNum() . "\">
                        </div>
                        <div class=\"container\">
                            <label for=\"cusdate\">Ngày tạo:</label>
                            <input type=\"text\" name=\"date\" id=\"cusdate\" value=\"" . getDMYdate($customer->getCreatedAt()) . "\" readonly>
                        </div>    
                    </div>
                    <div class=\"bottom\">
                        <input type=\"text\" name=\"id\" value=\"" . $customer->getId() . "\" style=\"display: none;\">
                        <input type=\"submit\" name=\"customer-change-submit\" value=\"CHỈNH SỬA KHÁCH HÀNG\">
                    </div>
                </form>
            </div>
        </div>
        </div>";
}

?>

<script>
    function checkCustomer(e) {
        var fullnameRegEx = /[0-9@#$%^&*]{1,}/;
        var emailRegEx = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        var phoneRegEx = /^0\d{8,9}$/;

        var fullname = document.getElementById("cusname");
        var email = document.getElementById("cusemail");
        var address = document.getElementById("cusaddress");
        var phoneNum = document.getElementById("cusphone");

        if (fullname.value == "" || fullname.value == undefined || fullname.value == NaN) {
            //alertMessage("fail", "Mời nhập họ và tên!");
            alert("Tên khách hàng không được bỏ trống!");
            fullname.focus();
            e.preventDefault();
            return false;
        } else if (fullnameRegEx.test(fullname.value) == true && fullname.value != "") {
            //alertMessage("fail", "Họ và tên không hợp lệ!");
            alert("Họ và tên không hợp lệ!");
            fullname.focus();
            e.preventDefault();
            return false;
        } else if (email.value == "" || email.value == undefined || email.value == NaN) {
            //alertMessage("fail", "Mời nhập email");
            alert("Email khách hàng không được để trống!");
            email.focus();
            e.preventDefault();
            return false;
        } else if (!emailRegEx.test(email.value) && email.value != "") {
            //alertMessage("fail", "Email không đúng!");
            alert("Email không đúng định dạng!");
            email.focus();
            e.preventDefault();
            return false;
        } else if (address.value == "" || address.value == undefined || address.value == NaN) {
            //alertMessage("fail", "Mời nhập địa chỉ!");
            alert("Địa chỉ khách hàng không được bỏ trống!");
            address.focus();
            e.preventDefault();
            return false;
        } else if (phoneNum.value == "" || phoneNum.value == undefined || phoneNum.value == NaN) {
            //alertMessage("fail", "Mời nhập số điện thoại!");
            alert("Số điện thoại khách hàng không được để trống!");
            phoneNum.focus();
            e.preventDefault();
            return false;
        } else if (!phoneRegEx.test(phoneNum.value) && phoneNum.value != "") {
            //alertMessage("fail", "Số điện thoại không đúng định dạng!");
            alert("Số điện thoại không đúng định dạng!");
            phoneNum.focus();
            e.preventDefault();
            return false;
        }
    }    
</script>
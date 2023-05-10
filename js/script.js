/* #----------------# */
/* |                | */
/* |    JS CHUNG    | */
/* |                | */
/* #----------------# */

function alertMessage(type, message) {
    document.getElementById("alert-theme").classList.add("alertActive");
    var alert = document.getElementById("alert-container");
    var alertIcon = document.querySelectorAll(".alert-icon")[0];
    var typeMessage = document.querySelectorAll(".type-message")[0];
    var msg = document.querySelectorAll(".message")[0];
    var button = document.getElementById("confirm-btn");
    switch (type) {
        case "success":
            alert.classList.add("active");
            alertIcon.innerHTML = "<i class=\"fa-solid fa-check\" style=\"color: #A5DC86;\"></i>";
            alertIcon.style.border = "3px solid #EDF8E7";
            typeMessage.innerText = "Success"
            msg.innerText = message;
            break;
        case "fail":
            alert.classList.add("active");
            alertIcon.innerHTML = "<i class=\"fa-solid fa-xmark\" style=\"color: #F37777;\"></i>";
            alertIcon.style.border = "3px solid #F27474";
            typeMessage.innerText = "Error!"
            msg.innerText = message;
            break;
        case "warning":
            alert.classList.add("active");
            alertIcon.innerHTML = "<i class=\"fa-solid fa-exclamation\" style=\"color: #F8BB86;\"></i>";
            alertIcon.style.border = "3px solid #FACEA8";
            typeMessage.innerText = "Warning!"
            msg.innerText = message;
            break;
        case "info":
            alert.classList.add("active");
            alertIcon.innerHTML = "<i class=\"fa-solid fa-info\" style=\"color: #3FC3EE;\"></i>";
            alertIcon.style.border = "3px solid #9DE0F6";
            typeMessage.innerText = "Info!"
            msg.innerText = message;
            break;
        case "question":
            alert.classList.add("active");
            alertIcon.innerHTML = "<i class=\"fa-solid fa-question\" style=\"color: #87ADBD;\"></i>";
            alertIcon.style.border = "3px solid #C9DAE1";
            typeMessage.innerText = "Question!"
            msg.innerText = message;
            break;
    }
    button.focus();
    setTimeout(closeAlert, 2000);
}

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

var btn = document.getElementById("confirm-btn");
btn.addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
        btn.click();
    }
});


/* Hiển thị Menu 3 gạch khi responsive */
let showSidebar = document.getElementById("hamburger-icon");
showSidebar.addEventListener("click", function () {
    document.getElementById("sidebar-container").classList.remove("hide");
    document.getElementById("sidebar-container").classList.add("hienThi");
});

/* Tắt Menu 3 gạch khi nhấn nút X */
let turnOffSideBar = document.getElementById("turnoff-btn");
turnOffSideBar.addEventListener("click", function () {
    document.getElementById("sidebar-container").classList.remove("hienThi");
    document.getElementById("sidebar-container").classList.add("hide");
});

/* Tắt sidebar khi bấm vào nền */
// let turnOffSideBarByBody = document.getElementById("sidebar-container");
// turnOffSideBarByBody.addEventListener("click", function() {
//     document.getElementById("sidebar-container").classList.remove("hienThi");
//     document.getElementById("sidebar-container").classList.add("hide");   
// });

/* sizecheck.html */
function toggleShopSidebarMenu() {
    document.getElementById("menu-items").classList.toggle("hide");
}
// end


/* Hiển thị nút scroll to top và thanh header khi scroll chuột xuống 250px */
const fixedHeader = document.querySelector("#header");
const backtotop = document.querySelector("#backtotop");
backtotop.addEventListener("click", function () {
    window.scrollTo({ top: 0, left: 0, behavior: "smooth" });
});
window.addEventListener("scroll", function () {
    if (window.pageYOffset > 250) {
        backtotop.classList.add("backtotop-active");
        fixedHeader.classList.add("fixed");
    } else {
        backtotop.classList.remove("backtotop-active");
        fixedHeader.classList.remove("fixed");
    }
});

// Nút search trên thanh header
let headerInnerSearchBtn = document.getElementById("header-inner-search-btn");
headerInnerSearchBtn.addEventListener("click", function (event) {
    var keyword = document.getElementById("keyword").value.trim();
    if (keyword == "" || keyword == undefined) {
        event.preventDefault();
    } else {
        sessionStorage.setItem("firstSearch", "on");
        var url = new URL("/faion/index.php/search?", window.location.href);
        url.searchParams.append("keyword", keyword);
        url.searchParams.append("page", 1);
        url.searchParams.append("category", "all");
        event.preventDefault();
        window.location.replace(url);
    }
});

function changeMoneyToNum(money) {
    var arr = money.split(".");
    var num = '';
    for (var i = 0; i < arr.length; i++) {
        num += arr[i];
    }
    return num;
}

if (sessionStorage.getItem("firstSearch") == "on") {
    sessionStorage.setItem("firstSearch", "off");
    var url = window.location.search;
    var keyword = url.split("?")[1];
    keyword = keyword.split("&")[0];
    keyword = keyword.split("=")[1];
    var request = "keyword=" + keyword + "&page=1&category=all";
    var url = '/faion/index.php/search?' + request;
    var xml = new XMLHttpRequest();
    xml.open("GET", "/faion/action/searchProduct.php?" + request, true);
    xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("maincontent").innerHTML = this.responseText;
            history.pushState(null, '', url);
        }
    };
    xml.send();
}

// Phân trang ajax
function pageDivideAjax(category, page, keyword, minPrice, maxPrice) {
    console.log(keyword);
    if (keyword != null) {
        // Phân trang bên trang tìm kiếm
        var request = "keyword=" + keyword + "&page=" + page +
            "&category=" + category;
        if (minPrice != null && maxPrice != null)
            request += "&minPrice=" + minPrice + "&maxPrice=" + maxPrice;
        else if (minPrice != null && maxPrice == null)
            request += "&minPrice=" + minPrice;
        else if (minPrice == null && maxPrice != null)
            request += "&maxPrice=" + maxPrice;

        var url = '/faion/index.php/search?' + request;
        var xml = new XMLHttpRequest();
        xml.open("GET", "/faion/action/searchProduct.php?" + request, true);
        xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("maincontent").innerHTML = this.responseText;
                history.pushState(null, '', url);
            }
        };
        xml.send();
    } else {
        // Phân trang bên trang sản phẩm
        var request = "category=" + category + "&page=" + page;
        var url = '/faion/index.php/products?' + request;
        var xml = new XMLHttpRequest();
        xml.open("GET", "/faion/action/actionPageDivide.php?" + request, true);
        xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("maincontent").innerHTML = this.responseText;
                history.pushState(null, '', url);
            }
        };
        xml.send();
    }
}

function openHeaderSearch() {
    document.getElementById('search-container').classList.toggle('active');
    document.getElementById('keyword').focus();
}
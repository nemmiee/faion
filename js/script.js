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


let currentTheme = localStorage.getItem("theme");
if (currentTheme == "dark") {
    let pos = window.location.pathname.lastIndexOf('/');
    let path = window.location.pathname.substring(pos + 1);
    path = path.split(".")[0];
    document.getElementById("darkmode-btn").classList.toggle("fa-flip-horizontal");
    // Header
    document.getElementById("header").classList.toggle("darkmode");
    // Footer
    document.getElementById("footer").classList.toggle("darkmode");

    if (path == "index") {
        document.getElementById("content").classList.toggle("darkmode");
        document.getElementById("top-shopnow-container").classList.toggle("darkmode");
        document.getElementById("bottom-shopnow-container").classList.toggle("darkmode");
        document.getElementById("main-content").classList.toggle("darkmode");
    }
    else if (path == "products") {
        document.querySelector(".shop-page-title-container").classList.toggle("darkmode");
        document.getElementById("menu-container").classList.toggle("darkmode");
        document.getElementById("maincontent").classList.toggle("darkmode");
    }
    else if (path == "sizeguide") {
        document.querySelector(".shop-page-title-container").classList.toggle("darkmode");
        document.getElementById("main").classList.toggle("darkmode");
    }
    else if (path == "contact") {
        document.querySelector(".shop-page-title-container").classList.toggle("darkmode");
        document.getElementById("main").classList.toggle("darkmode");
    }
    else if (path == "login") {
        document.getElementById("mainContent-theme").classList.toggle("darkmode");
    }
    else if (path == "signup") {
        document.getElementById("mainContent-theme").classList.toggle("darkmode");

    }
    else {

    }
}

function changeTheme() {
    let theme;
    if (!document.getElementById("header").classList.contains("darkmode")) {
        theme = "dark";
        document.getElementById("darkmode-btn").classList.toggle("fa-flip-horizontal");
        document.getElementById("sidebar-darkmode-btn").classList.toggle("fa-flip-horizontal");
        // Header
        document.getElementById("header").classList.toggle("darkmode");
        // Footer
        document.getElementById("footer").classList.toggle("darkmode");

        if (path == "index") {
            document.getElementById("content").classList.toggle("darkmode");
            document.getElementById("top-shopnow-container").classList.toggle("darkmode");
            document.getElementById("bottom-shopnow-container").classList.toggle("darkmode");
            document.getElementById("main-content").classList.toggle("darkmode");
        }
        else if (path == "products") {
            document.querySelector(".shop-page-title-container").classList.toggle("darkmode");
            document.getElementById("menu-container").classList.toggle("darkmode");
            document.getElementById("maincontent").classList.toggle("darkmode");

        }
        else if (path == "sizecheck") {
            document.querySelector(".shop-page-title-container").classList.toggle("darkmode");
            document.getElementById("main").classList.toggle("darkmode");
        }
        else if (path == "contact") {
            document.querySelector(".shop-page-title-container").classList.toggle("darkmode");
            document.getElementById("main").classList.toggle("darkmode");
        }
        else if (path == "signin") {
            document.getElementById("mainContent-theme").classList.toggle("darkmode");
        }
        else if (path == "signup") {
            document.getElementById("mainContent-theme").classList.toggle("darkmode");

        }
        else {

        }
    }
    else {
        theme = "light";
        document.getElementById("darkmode-btn").classList.toggle("fa-flip-horizontal");
        document.getElementById("sidebar-darkmode-btn").classList.toggle("fa-flip-horizontal");
        // Header
        document.getElementById("header").classList.toggle("darkmode");
        // Footer
        document.getElementById("footer").classList.toggle("darkmode");

        if (path == "index") {
            document.getElementById("content").classList.toggle("darkmode");
            document.getElementById("top-shopnow-container").classList.toggle("darkmode");
            document.getElementById("bottom-shopnow-container").classList.toggle("darkmode");
            document.getElementById("main-content").classList.toggle("darkmode");

        }
        else if (path == "products") {
            document.querySelector(".shop-page-title-container").classList.toggle("darkmode");
            document.getElementById("menu-container").classList.toggle("darkmode");
            document.getElementById("maincontent").classList.toggle("darkmode");
        }
        else if (path == "sizecheck") {
            document.querySelector(".shop-page-title-container").classList.toggle("darkmode");
            document.getElementById("main").classList.toggle("darkmode");
        }
        else if (path == "contact") {
            document.querySelector(".shop-page-title-container").classList.toggle("darkmode");
            document.getElementById("main").classList.toggle("darkmode");
        }
        else if (path == "signin") {
            document.getElementById("mainContent-theme").classList.toggle("darkmode");
        }
        else if (path == "signup") {
            document.getElementById("mainContent-theme").classList.toggle("darkmode");

        }
        else {

        }
    }
    localStorage.setItem("theme", theme);
}


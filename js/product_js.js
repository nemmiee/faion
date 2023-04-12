/* #-------------------# */
/* |                   | */
/* | JS TRANG SẢN PHẨM | */
/* |                   | */
/* #-------------------# */
/* Check tai khoan trước khi mua hàng */
// let addToCartBtn = document.getElementsByClassName('addToCart-btn');
// for (var i = 0; i < addToCartBtn.length; ++i) {
//     addToCartBtn[i].addEventListener("click", checkuser);
// }

function checkUser() {
    if (sessionStorage.getItem('id') === null) {
        alert("vui lòng đăng nhập khi mua hàng.");
        location.replace("../faion/index.php/login/");
    }
}

/* Tạo sản phẩm mặc định */
function createProduct() {
    if (localStorage.getItem('product') === null) {
        var productList = [
            { productId: 10001, productName: "Blue Cyan Tornado", category: "Shirt", price: 300000, image: "/img/products/10001.jpg", },
            { productId: 10002, productName: "Light Purple Cheese", category: "Shirt", price: 250000, image: "/img/products/10002.jpg", },
            { productId: 10003, productName: "Rabbit Bag Brown", category: "Shirt", price: 270000, image: "/img/products/10003.jpg", },
            { productId: 10004, productName: "Hoodie Blue", category: "Hoodie", price: 520000, image: "/img/products/10004.jpg", },
            { productId: 10005, productName: "Hoodie Neon Yellow", category: "Hoodie", price: 550000, image: "/img/products/10005.jpg", },
            { productId: 10006, productName: "Jacket Black", category: "Jacket", price: 460000, image: "/img/products/10006.jpg", },
            { productId: 10007, productName: "Jacket Dark Green", category: "Jacket", price: 430000, image: "/img/products/10007.jpg", },
            { productId: 10008, productName: "Jacket Varsity", category: "Jacket", price: 480000, image: "/img/products/10008.jpg", },
            { productId: 10009, productName: "Sweater Beige", category: "Sweater", price: 470000, image: "/img/products/10009.jpg", },
            { productId: 10010, productName: "Jacket Multi Color Monogram ", category: "Jacket", price: 460000, image: "/img/products/10010.jpg", },
            { productId: 10011, productName: "Core Logo Tee Navy", category: "Shirt", price: 500000, image: "/img/products/10011.jpg", },
            { productId: 10012, productName: "Jacket Classic Brown", category: "Jacket", price: 500000, image: "/img/products/10012.jpg", },
            { productId: 10013, productName: "Gnarly Hollow USA Tie Dye", category: "Shirt", price: 500000, image: "/img/products/10013.jpg", },
            { productId: 10014, productName: "Jacket Simple White Cardigan", category: "Jacket", price: 500000, image: "/img/products/10014.jpg", },
            { productId: 10015, productName: "Hoodie Simple Light Green", category: "Hoodie", price: 500000, image: "/img/products/10015.jpg", },
            { productId: 10016, productName: "Jacket Caro Black White", category: "Jacket", price: 500000, image: "/img/products/10016.jpg", },
            { productId: 10017, productName: "Hoodie Simple Yellow", category: "Hoodie", price: 500000, image: "/img/products/10017.jpg", },
            { productId: 10018, productName: "Jacket Classic Blue", category: "Jacket", price: 500000, image: "/img/products/10018.jpg", },
            { productId: 10019, productName: "Jacket Classic Tie Dye", category: "Jacket", price: 500000, image: "/img/products/10019.jpg", },
            { productId: 10020, productName: "Jacket Simple Chocolate", category: "Jacket", price: 500000, image: "/img/products/10020.jpg", },
            { productId: 10021, productName: "Jacket Simple Cyan", category: "Jacket", price: 500000, image: "/img/products/10021.jpg", },
            { productId: 10022, productName: "Sweater Original Yellow", category: "Sweater", price: 500000, image: "/img/products/10022.jpg", },
            { productId: 10023, productName: "Hoodie Simple White", category: "Hoodie", price: 500000, image: "/img/products/10023.jpg", },
            { productId: 10024, productName: "Hoodie State Blue", category: "Hoodie", price: 500000, image: "/img/products/10024.jpg", },
            { productId: 10025, productName: "Sweater Simple Sky Blue", category: "Sweater", price: 500000, image: "/img/products/10025.jpg", },
            { productId: 10026, productName: "Sweater Simple Tomato", category: "Sweater", price: 500000, image: "/img/products/10026.jpg", },
            { productId: 10027, productName: "Sweater Original Snow", category: "Sweater", price: 500000, image: "/img/products/10027.jpg", },
            { productId: 10028, productName: "Sweater Model Kant", category: "Sweater", price: 500000, image: "/img/products/10028.jpg", },
            { productId: 10029, productName: "Sweater Model Bbuff", category: "Sweater", price: 500000, image: "/img/products/10029.jpg", },
            { productId: 10030, productName: "Sweater Original Light Pink", category: "Sweater", price: 500000, image: "/img/products/10030.jpg", },
            { productId: 10031, productName: "Sweater Model Galaxy", category: "Sweater", price: 500000, image: "/img/products/10031.jpg", },
            { productId: 10032, productName: "Sweater Model Little Fly", category: "Sweater", price: 500000, image: "/img/products/10032.jpg", },
            { productId: 10033, productName: "Sweater Extra Original", category: "Sweater", price: 500000, image: "/img/products/10033.jpg", },
            { productId: 10034, productName: "Sweater Simple Darkness", category: "Sweater", price: 500000, image: "/img/products/10034.jpg", },
            { productId: 10035, productName: "Sweater Simple Forest", category: "Sweater", price: 500000, image: "/img/products/10035.jpg", },
            { productId: 10036, productName: "Simple Turtleneck Ground", category: "Shirt", price: 500000, image: "/img/products/10036.jpg", },
            { productId: 10037, productName: "Simple Turtleneck Darkness", category: "Shirt", price: 500000, image: "/img/products/10037.jpg", },
            { productId: 10038, productName: "White Baseball Style", category: "Shirt", price: 500000, image: "/img/products/10038.jpg", },
            { productId: 10039, productName: "The Dark Space", category: "Shirt", price: 500000, image: "/img/products/10039.jpg", },
            { productId: 10040, productName: "Mono Vietnam Style", category: "Shirt", price: 500000, image: "/img/products/10040.jpg", },
            { productId: 10041, productName: "Smile Cream White", category: "Shirt", price: 500000, image: "/img/products/10041.jpg", },
            { productId: 10042, productName: "Saigon Tour", category: "Shirt", price: 500000, image: "/img/products/10042.jpg", },
            { productId: 10043, productName: "Stunned Face Icon", category: "Shirt", price: 500000, image: "/img/products/10043.jpg", },
            { productId: 10044, productName: "Player Basic Blue", category: "Shirt", price: 500000, image: "/img/products/10044.jpg", },
            { productId: 10045, productName: "Simple Matcha Green", category: "Shirt", price: 500000, image: "/img/products/10045.jpg", },
            { productId: 10046, productName: "Jigsaw Light Sunny", category: "Shirt", price: 500000, image: "/img/products/10046.jpg", },
        ];
        localStorage.setItem('product', JSON.stringify(productList));
    }
}


/* Hiển thị chi tiết sản phẩm */
let size = "";
function showProductInfo(productId) {
    document.querySelector("#product-info-container").classList.toggle("hienThi");
    var productList = JSON.parse(localStorage.getItem('product'));
    for (var i = 0; i < productList.length; ++i) {
        if (productList[i].productId === productId) {
            document.getElementById("product-info-img").setAttribute("src", productList[i].image);
            document.getElementById("product-name").innerText = productList[i].productName;
            document.getElementById("product-price").innerText = "Giá: " + productList[i].price + "đ";
            document.getElementById("quantity").value = 1;
            document.querySelector('#product-info .product-info-right button.addToCart-btn').setAttribute('onClick', 'addToCart(' + productId + ')');
        }
    }
    document.getElementById("sizeM").style.backgroundColor = "white";
    document.getElementById("sizeL").style.backgroundColor = "white";
    document.getElementById("sizeXL").style.backgroundColor = "white";
    size = '';
}

function closeProductInfo() {
    document.getElementById("product-info-container").classList.toggle("hienThi");
}

function quantityDown() {
    if (document.getElementById("quantity").value > 1)
        --document.getElementById("quantity").value;
}

function quantityUp() {
    ++document.getElementById("quantity").value;
}
/* Thêm sản phẩm vào giỏ hàng */

var pos = window.location.pathname.lastIndexOf('/');
var path = window.location.pathname.substring(pos + 1);
path = path.split(".")[0];
if (path === "products") {
    const fixedMenuItems = document.getElementById("menu-items");
    window.addEventListener("scroll", function () {
        if (this.window.pageYOffset > 251 && this.document.body.offsetWidth > 768) {
            fixedMenuItems.classList.add("fixed1");
        }
        else {
            fixedMenuItems.classList.remove("fixed1");
        }
        if (this.window.pageYOffset > 250 && this.document.body.offsetWidth < 768) {
            fixedMenuItems.classList.add("fixed");
        }
        else {
            fixedMenuItems.classList.remove("fixed");
        }
    });
}

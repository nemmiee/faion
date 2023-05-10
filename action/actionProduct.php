<?php
if (isset($_POST['add-product-submit'])) {
    $name = "";
    $category = "";
    $price = 0;
    $status = 1;
    $quantity = 0;
    $description = "";
    $image = "";
    $date = date("Y-m-d");

    if (
        isset($_POST['name']) && isset($_POST['category']) && isset($_POST['price'])
        && isset($_POST['status']) && isset($_POST['quantity'])
    ) {
        $productList = array();
        $productList = getProductList();
        $name = trim($_POST['name']);
        $category = trim($_POST['category']);
        $price = trim($_POST['price']);
        $status = trim($_POST['status']);
        $feature = trim($_POST['feature']);
        $quantity = trim($_POST['quantity']);

        if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
            //Thư mục bạn lưu file upload
            $target_dir = "../../faion/img/products/";
            //Đường dẫn lưu file trên server
            $target_file   = $target_dir . basename($_FILES["image"]["name"]);
            $allowUpload   = true;
            //Lấy phần mở rộng của file (txt, jpg, png,...)
            $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
            //Những loại file được phép upload
            $allowtypes    = array('jpg', 'png', 'jpeg');
            //Kích thước file lớn nhất được upload (bytes)
            $maxfilesize   = 10000000; //10MB

            //1. Kiểm tra file có bị lỗi không?
            if ($_FILES["image"]["error"] != 0) {
                // echo "<script>alert('Ảnh upload bị lỗi hoặc chưa có file nào được chọn!');
                // window.location = '/faion/index.php/admin/products?choice=product'; </script>";                

            }

            //2. Kiểm tra loại file upload có được phép không?
            if (!in_array($fileType, $allowtypes)) {
                echo "<script>alert('Chỉ cho phép upload file có định dạng .png hoặc .jpg hoặc .jpeg');
                window.location = '/faion/index.php/admin/products?choice=product'; </script>";
                die;
                $allowUpload = false;
            }

            //3. Kiểm tra kích thước file upload có vượt quá giới hạn cho phép
            if ($_FILES["image"]["size"] > $maxfilesize) {
                echo "<script>alert('Kích thước của ảnh phải nhỏ hơn $maxfilesize bytes!');
                window.location = '/faion/index.php/admin/products?choice=product'; </script>";
                die;
                $allowUpload = false;
            }

            //4. Kiểm tra file đã tồn tại trên server chưa?
            if (file_exists($target_file)) {
                echo "<script>alert('Tên file đã tồn tại trong server!');
                window.location = '/faion/index.php/admin/products?choice=product'; </script>";
                die;
                $allowUpload = false;
            }

            if ($allowUpload) {
                //Lưu file vào thư mục được chỉ định trên server
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "<script> document.getElementById('pimage').src = $target_file; </script>;";
                    $image = $target_file;
                } else {
                    echo "<script>alert('Đã xảy ra lỗi trong quá trình upload file!');</script>";
                    $image = "/faion/img/default/cant-upload-img.jpg";
                }
            }
        } else {
            $image = "/faion/img/default/no-image.png";
        }
        if (isset($_POST['description']) && $_POST['description'] != "") {
            $description = $_POST['description'];
        } else {
            $description = NULL;
        }
        $db = new Database();

        $query = "INSERT INTO product (category_id, name, description, price, image, discount, quantity, sold, status, feature, created_at) 
                            VALUES ('$category', '$name', '$description', '$price', '$image', NULL, '$quantity', 0, '$status', '$feature', '$date')";

        if ($db->insert_update_delete($query)) {
            $db->disconnect();
            echo "<script>
                alert(\"Thêm sản phẩm thành công\");
                window.location = '/faion/index.php/admin/products/'; 
            </script>";
        } else {
            $db->disconnect();
            echo "<script>window.location = '/faion/index.php/admin/products?choice=product'; 
            alertMessage(\"fail\", \"Thêm sản phẩm không thành công\"); </script>";
        }
    }
} else if (isset($_POST['product-change-submit'])) {
    $productList = getProductList();
    $pos = -1;
    for ($i = 0; $i < count($productList); $i++) {
        if ($productList[$i]->getId() == $_POST['id']) {
            $pos = $i;
            break;
        }
    }
    $id = $productList[$pos]->getId();

    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $price = trim($_POST['price']);
    $status = trim($_POST['status']);
    $quantity = trim($_POST['quantity']);
    $feature = trim($_POST['feature']);
    $description = "";
    $image = "";

    $url = explode("/", $productList[$pos]->getImage());
    $url = $url[count($url) - 1];
    $url = "../../faion/img/products/" . $url;

    if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
        unlink($url);
        //Thư mục bạn lưu file upload
        $target_dir = "../../faion/img/products/";
        //Đường dẫn lưu file trên server
        $target_file   = $target_dir . basename($_FILES["image"]["name"]);
        $allowUpload   = true;
        //Lấy phần mở rộng của file (txt, jpg, png,...)
        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
        //Những loại file được phép upload
        $allowtypes    = array('jpg', 'png', 'jpeg');
        //Kích thước file lớn nhất được upload (bytes)
        $maxfilesize   = 10000000; //10MB

        //1. Kiểm tra file có bị lỗi không?
        if ($_FILES["image"]['error'] != 0) {
        }

        //2. Kiểm tra loại file upload có được phép không?
        if (!in_array($fileType, $allowtypes)) {
            echo "<script>alertMessage('fail', 'Chỉ cho phép upload file có định dạng .png hoặc .jpg hoặc .jpeg');</script>";
            $allowUpload = false;
        }

        //3. Kiểm tra kích thước file upload có vượt quá giới hạn cho phép
        if ($_FILES["image"]["size"] > $maxfilesize) {
            echo "<script>alertMessage('fail', 'Kích thước của ảnh phải nhỏ hơn $maxfilesize bytes!');</script>";
            $allowUpload = false;
        }

        //4. Kiểm tra file đã tồn tại trên server chưa?
        if (file_exists($target_file)) {
            echo "<script>alertMessage('fail', 'Tên file đã tồn tại trong server!');</script>";
            $allowUpload = false;
        }

        if ($allowUpload) {
            //Lưu file vào thư mục được chỉ định trên server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "<script> document.getElementById('pimage').src = $target_file; </script>;";
                $image = $target_file;
            } else {
                echo "<script>alertMessage('fail', 'Đã xảy ra lỗi trong quá trình upload file!');</script>";
                $image = "/faion/img/default/no-image.png";
            }
        }
    } else {
        $image = $productList[$pos]->getImage();
    }
    if (isset($_POST['description'])) {
        $description = $_POST['description'];
    } else {
        $description = $productList[$pos]->getDescription();
    }

    $db = new Database();

    $query = "UPDATE product SET name = '$name', description = '$description', category_id = '$category', 
    price = '$price', image = '$image', quantity = '$quantity', status = '$status', feature = '$feature' WHERE id = '$id'";
    if ($db->insert_update_delete($query)) {
        $db->disconnect();
        echo "<script>
            alert(\"Sửa sản phẩm thành công.\");
            window.location = '/faion/index.php/admin/products?choice=product&id=$id'; 
        </script>";
    } else {
        $db->disconnect();
        echo "<script>
            alert(\"Sửa sản phẩm thất bại.\"); 
            window.location = '/faion/index.php/admin/products?choice=product'; 
            </script>";
    }
} else if (isset($_POST['category-submit'])) {
    $name = "";
    $categoryList = array();
    $categoryList = getCategoryList();
    for ($i = 0; $i < count($categoryList); $i++) {
        if ($categoryList[$i]->getName() == $_POST['name']) {
            echo "
            <script> 
                alert(\"Đã tồn tại tên thể loại.\");
                window.location = '/faion/index.php/admin/products/';
            </script>";
            die;
        }
    }
    $name = trim($_POST['name']);
    $sql = "INSERT INTO category (name) VALUES ('$name')";
    $db = new Database();

    if ($db->insert_update_delete($sql)) {
        $db->disconnect();
        echo "<script>
            alert(\"Thêm thể loại thành công.\");
            window.location = '/faion/index.php/admin/products/'; 
        </script>";
    } else {
        $db->disconnect();
        echo "<script>window.location = '/faion/index.php/admin/products/'; 
        alertMessage(\"fail\", \"Thêm thể loại không thành công.\"); </script>";
    }
} else if (isset($_POST['delete-product-submit']) && $_POST['productId'] != "") {
    $regEx = "/[-]{1,}/";
    $id = $_POST['productId'];
    $productList = getProductList();
    for ($i = 0; $i < count($productList); $i++) {
        if ($productList[$i]->getId() == $id) {
            $url = $productList[$i]->getImage();
            break;
        }
    }
    if (!preg_match($regEx, $id)) {
        $sql = "DELETE FROM product WHERE id='$id'";
        $db = new Database();
        if ($db->insert_update_delete($sql)) {
            unlink($url);
            $db->disconnect();
            echo "
            <script>
                alert(\"Xóa sản phẩm thành công.\");
                window.location = '/faion/index.php/admin/products/'; 
            </script>";
        } else {
            $db->disconnect();
            echo "
            <script>
                alert(\"Xóa sản phẩm thất bại.\");
                window.location = '/faion/index.php/admin/products/';
            </script>";
        }
    } else {
        $arr = explode("-", $id);
        include('../../faion/connection/Database.php');
        $db = new Database();
        $count = 0;
        $isError = false;
        for ($i = 0; $i < count($arr); $i++) {
            $sql = "DELETE FROM product WHERE id=" . $arr[$i];
            if ($db->insert_update_delete($sql)) {
                ++$count;
            } else {
                $isError = true;
            }
        }
        if (!$isError) {
            unlink($url);
            $db->disconnect();
            echo "
            <script>
                alert(\"Xóa sản phẩm thành công.\");
                window.location = '/faion/index.php/admin/products/'; 
            </script>";
        } else {
            $db->disconnect();
            echo "
            <script>
                alert(\"Đã xóa '$count' trong tổng số " . count($arr) . " được chọn.\");
                window.location = '/faion/index.php/admin/products/';
            </script>";
        }
    }
} else if (isset($_POST['delete-category-submit']) && $_POST['categoryId'] != "") {
    $id = $_POST['categoryId'];
    $sql = "DELETE FROM category WHERE id='$id'";
    $insertSQL = "UPDATE product SET category_id = 0 WHERE category_id = '$id'";
    include('../../faion/connection/Database.php');
    $db = new Database();
    if ($db->insert_update_delete($insertSQL)) {
        if ($db->insert_update_delete($sql)) {
            $db->disconnect();
            echo "
            <script>
                alert(\"Xóa thể loại thành công.\");
                window.location = '/faion/index.php/admin/products/'; 
            </script>";
        }
    } else {
        $db->disconnect();
        echo "
        <script>
            alert(\"Xóa thể loại thất bại.\");
            window.location = '/faion/index.php/admin/products/';
        </script>";
    }
}

function getProductList()
{
    include('../../faion/connection/Database.php');
    include('../../faion/object/Product.php');
    $db = new Database();

    $kq = mysqli_query($db->getConnection(), "SELECT * FROM product");
    $productArr = array();
    while ($row = mysqli_fetch_assoc($kq)) {
        $product = new Product(
            $row['id'],
            $row['category_id'],
            $row['name'],
            $row['description'],
            $row['price'],
            $row['image'],
            $row['discount'],
            $row['quantity'],
            $row['sold'],
            $row['status'],
            $row['feature'],
            $row['created_at']
        );
        $productArr[] = $product;
    }
    sort($productArr);
    return $productArr;
}

function getCategoryList()
{
    include('../../faion/connection/Database.php');
    include('../../faion/object/Category.php');
    $db = new Database();

    $kq = mysqli_query($db->getConnection(), "SELECT * FROM category");
    $list = array();
    while ($row = mysqli_fetch_assoc($kq)) {
        $category = new Category($row['id'], $row['name']);
        $list[] = $category;
    }
    sort($list);
    return $list;
}

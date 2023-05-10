-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 10, 2023 lúc 11:24 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `faion`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `status`, `role`) VALUES
(1, 'hoainam', 'nam123', 1, 0),
(2, 'chinh123', 'chinh123', 0, 3),
(3, 'halinh', 'linh123', 0, 3),
(4, 'trungtin', 'tin123', 1, 3),
(5, 'huubinh', 'binh123', 1, 1),
(6, 'vandan', 'vandan123', 1, 3),
(7, 'tangkhuong', 'khuong123', 1, 3),
(8, 'myduyen', 'duyen123', 1, 2),
(9, 'trungdong', 'dong123', 0, 3),
(10, 'kimngoc', 'ngoc123', 1, 3),
(11, 'thanhloi', 'loi123', 1, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cartitem`
--

CREATE TABLE `cartitem` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(0, 'Default'),
(5, 'Shirt'),
(6, 'Hoodie'),
(7, 'Sweater'),
(8, 'Jacket');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `address`, `phone_number`, `created_at`) VALUES
(1, 'Nguyễn Trương Hoài Nam', 'hoainam@gmail.com', '20/62 Cô Bắc, Phú Nhuận, Hồ Chí Minh', '0382358823', '2023-04-09'),
(2, 'Trần Trung Chính', 'trungchinh@gmail.com', 'Quận 7, Hồ Chí Minh', '0764565223', '2023-04-12'),
(3, 'Hồ Hà Linh', 'halinh@gmail.com', 'Quận 5, Hồ Chí Minh', '039125874', '2023-04-14'),
(4, 'Lê Trung Tín', 'trungtin@gmail.com', 'Bình Tây, Ninh Hòa, Khánh Hòa', '0857339511', '2023-04-14'),
(5, 'Nguyễn Hữu Bình', 'huubinh@gmail.com', 'Bình Tây, Ninh Hòa, Khánh Hòa', '0984123286', '2023-04-19'),
(6, 'Trần Văn Đan', 'vandan@gmail.com', 'Quận 10, Hồ Chí Minh', '0829752713', '2023-04-19'),
(7, 'Mông Tăng Khương', 'tangkhuong@gmail.com', 'Ninh Thủy, Ninh Hòa, Khánh Hòa', '0989921421', '2023-04-19'),
(8, 'Trần Thị Mỹ Duyên', 'myduyen@gmail.com', 'Ninh Tịnh, Ninh Hòa, Khánh Hòa', '0233874659', '2023-04-19'),
(9, 'Nguyễn Trung Đông', 'trungdong@gmail.com', 'Quận Gò Vấp, Hồ Chí Minh', '0937561236', '2023-04-19'),
(10, 'Đoàn Trần Kim Ngọc', 'kimngoc@gmail.com', 'Quận 7, Hồ Chí Minh', '0869543889', '2023-04-20'),
(11, 'Mai Thành Lợi', 'thanhloi@gmail.com', 'Quận 12, Hồ Chí Minh', '0288954410', '2023-05-04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `canceled_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `customer_id`, `total`, `status`, `created_at`, `canceled_at`, `completed_at`) VALUES
(1, 7, '788000.00', '0', '2023-05-10 11:07:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 10, '750000.00', '1', '2023-05-10 11:09:41', '0000-00-00 00:00:00', '2023-05-10 11:14:06'),
(3, 10, '1110000.00', '1', '2023-05-10 11:10:01', '0000-00-00 00:00:00', '2023-05-10 11:13:38'),
(4, 10, '3168000.00', '1', '2023-05-10 11:10:22', '0000-00-00 00:00:00', '2023-05-10 11:15:29'),
(5, 10, '282000.00', '0', '2023-05-10 11:10:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderitem`
--

CREATE TABLE `orderitem` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(13,2) NOT NULL,
  `size` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orderitem`
--

INSERT INTO `orderitem` (`order_id`, `product_id`, `quantity`, `price`, `size`) VALUES
(1, 67, 2, '394000.00', 'L'),
(1, 61, 0, '510000.00', 'XL'),
(2, 46, 2, '375000.00', 'L'),
(2, 74, 0, '397000.00', 'M'),
(3, 17, 3, '370000.00', 'L'),
(4, 19, 6, '528000.00', 'S'),
(5, 57, 1, '282000.00', 'M'),
(5, 75, 0, '110000.00', 'L');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` float NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `discount` int(10) DEFAULT NULL,
  `quantity` int(8) NOT NULL,
  `sold` int(8) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `feature` tinyint(1) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `price`, `image`, `discount`, `quantity`, `sold`, `status`, `feature`, `created_at`) VALUES
(1, 5, 'Blue Cyan Tornado', 'CYAN TORNADO\r\nMATERIAL: TICI SPANDEX\r\nSIZE: M / L / XL\r\n_________________________\r\nSize và form áo được đo theo chuẩn của người Việt Nam\r\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg\r\nBảng size nhằm mục đích hướng dẫn và khích thước có tỉ lệ dung size ± 0.5cm\r\nNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn\r\n_________________________\r\n\r\nCÁCH BẢO QUẢN\r\n Không đổ bột giặt trực tiếp lên áo\r\n Không giặt chung với sản phẩm khác màu\r\n Không sử dụng bột giặt có chất tẩy quá mạnh\r\n Giặt bằng nước có nhiệt độ không quá 30 độ \r\n1. Các trường hợp hỗ trợ đổi hàng\r\n- Hàng không đúng chủng loại, mẫu mã trong đơn hàng đã đặt\r\n- Không đủ số lượng như trong đơn hàng\r\n- Trường hợp có lỗi xuất phát từ khâu sản xuất\r\n- Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ ảnh hưởng trực tiếp đến sản phẩm\r\n- Áp dụng 01 lần đổi/ 01 đơn hàng\r\n- Áp dụng với các đơn hàng trên toàn hệ thống của Hard Mode® (Website, FB & IG, TMĐT & cửa hàng)\r\n2. Điều kiện đổi hàng\r\n- Trong 07 ngày kể từ lúc lúc nhận bưu phẩm thành công\r\n- Sản phẩm còn đầy đủ hóa đơn, tag treo, túi đựng áo nguyên vẹn\r\n- Sản phẩm không có dấu hiệu đã sử dụng, mùi lạ hoặc tác động từ phía khách hàng\r\n- Bạn vui lòng gửi cho chúng mình clip đóng gói hàng đổi trả của bạn, nhân viên tư vấn sẽ xác nhận và tiến hành lên đơn đổi trả cho bạn.\r\n3. Cách thức quay video unbox\r\n- Clip rõ nét từ cảnh kiểm tra bề mặt gói hàng, lúc mở đến kiểm tra hàng.\r\n- Clip không cắt ghép, không chỉnh sửa.\r\n- Clip quay rõ thông tin trên bưu phẩm: Tên người nhận, mã đơn, địa chỉ, số điện thoại.', 126000, '/faion/img/products/10001.jpg', NULL, 200, 36, 0, 1, '2023-04-06'),
(2, 5, 'Light Purple Cheese', 'CHEESE TEE\r\nMATERIAL: TICI SPANDEX\r\nSIZE: M / L / XL\r\n_________________________\r\nSize và form áo được đo theo chuẩn của người Việt Nam\r\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg\r\nBảng size nhằm mục đích hướng dẫn và khích thước có tỉ lệ dung size ± 0.5cm\r\nNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn\r\n_________________________\r\n\r\nCÁCH BẢO QUẢN\r\n Không đổ bột giặt trực tiếp lên áo\r\n Không giặt chung với sản phẩm khác màu\r\n Không sử dụng bột giặt có chất tẩy quá mạnh\r\n Giặt bằng nước có nhiệt độ không quá 30 độ \r\n1. Các trường hợp hỗ trợ đổi hàng\r\n- Hàng không đúng chủng loại, mẫu mã trong đơn hàng đã đặt\r\n- Không đủ số lượng như trong đơn hàng\r\n- Trường hợp có lỗi xuất phát từ khâu sản xuất\r\n- Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ ảnh hưởng trực tiếp đến sản phẩm\r\n- Áp dụng 01 lần đổi/ 01 đơn hàng\r\n- Áp dụng với các đơn hàng trên toàn hệ thống của Hard Mode® (Website, FB & IG, TMĐT & cửa hàng)\r\n2. Điều kiện đổi hàng\r\n- Trong 07 ngày kể từ lúc lúc nhận bưu phẩm thành công\r\n- Sản phẩm còn đầy đủ hóa đơn, tag treo, túi đựng áo nguyên vẹn\r\n- Sản phẩm không có dấu hiệu đã sử dụng, mùi lạ hoặc tác động từ phía khách hàng\r\n- Bạn vui lòng gửi cho chúng mình clip đóng gói hàng đổi trả của bạn, nhân viên tư vấn sẽ xác nhận và tiến hành lên đơn đổi trả cho bạn.\r\n3. Cách thức quay video unbox\r\n- Clip rõ nét từ cảnh kiểm tra bề mặt gói hàng, lúc mở đến kiểm tra hàng.\r\n- Clip không cắt ghép, không chỉnh sửa.\r\n- Clip quay rõ thông tin trên bưu phẩm: Tên người nhận, mã đơn, địa chỉ, số điện thoại.', 254000, '/faion/img/products/10002.jpg', NULL, 156, 43, 1, 1, '2023-04-07'),
(3, 5, 'Rabbit Bag Brown', 'RABBIT BAG TEE\r\nMATERIAL: TICI SPANDEX\r\nSIZE: M / L / XL\r\n_________________________\r\n\r\nSize và form áo được đo theo chuẩn của người Việt Nam\r\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg\r\n\r\nBảng size nhằm mục đích hướng dẫn và khích thước có tỉ lệ dung size ± 0.5cm\r\nNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn\r\n_________________________\r\n\r\nCÁCH BẢO QUẢN\r\n Không đổ bột giặt trực tiếp lên áo\r\n Không giặt chung với sản phẩm khác màu\r\n Không sử dụng bột giặt có chất tẩy quá mạnh\r\n Giặt bằng nước có nhiệt độ không quá 30 độ C\r\n\r\n\r\n1. Các trường hợp hỗ trợ đổi hàng\r\n- Hàng không đúng chủng loại, mẫu mã trong đơn hàng đã đặt\r\n- Không đủ số lượng như trong đơn hàng\r\n- Trường hợp có lỗi xuất phát từ khâu sản xuất \r\n- Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ ảnh hưởng trực tiếp đến sản phẩm\r\n- Áp dụng 01 lần đổi/ 01 đơn hàng \r\n- Áp dụng với các đơn hàng trên toàn hệ thống của Hard Mode® (Website, FB & IG, TMĐT & cửa hàng).\r\n\r\n2. Điều kiện đổi hàng\r\n\r\n- Trong 07 ngày kể từ lúc lúc nhận bưu phẩm thành công\r\n- Sản phẩm còn đầy đủ hóa đơn, tag treo, túi đựng áo nguyên vẹn\r\n- Sản phẩm không có dấu hiệu đã sử dụng, mùi lạ hoặc tác động từ phía khách hàng\r\n- Bạn vui lòng gửi cho chúng mình clip đóng gói hàng đổi trả của bạn, nhân viên tư vấn sẽ xác nhận và tiến hành lên đơn đổi trả cho bạn.\r\n\r\n3. Cách thức quay video unbox\r\n- Clip rõ nét từ cảnh kiểm tra bề mặt gói hàng, lúc mở đến kiểm tra hàng.\r\n- Clip không cắt ghép, không chỉnh sửa.\r\n- Clip quay rõ thông tin trên bưu phẩm: Tên người nhận, mã đơn, địa chỉ, số điện thoại.', 275000, '/faion/img/products/10003.jpg', NULL, 95, 5, 1, 0, '2023-04-07'),
(4, 6, 'Hoodie Blue', 'CHEESE TEE\r\nMATERIAL: TICI SPANDEX\r\nSIZE: M / L / XL\r\n_________________________\r\nSize và form áo được đo theo chuẩn của người Việt Nam\r\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg\r\nBảng size nhằm mục đích hướng dẫn và khích thước có tỉ lệ dung size ± 0.5cm\r\nNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn\r\n_________________________\r\n\r\nCÁCH BẢO QUẢN\r\n Không đổ bột giặt trực tiếp lên áo\r\n Không giặt chung với sản phẩm khác màu\r\n Không sử dụng bột giặt có chất tẩy quá mạnh\r\n Giặt bằng nước có nhiệt độ không quá 30 độ \r\n1. Các trường hợp hỗ trợ đổi hàng\r\n- Hàng không đúng chủng loại, mẫu mã trong đơn hàng đã đặt\r\n- Không đủ số lượng như trong đơn hàng\r\n- Trường hợp có lỗi xuất phát từ khâu sản xuất\r\n- Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ ảnh hưởng trực tiếp đến sản phẩm\r\n- Áp dụng 01 lần đổi/ 01 đơn hàng\r\n- Áp dụng với các đơn hàng trên toàn hệ thống của Hard Mode® (Website, FB & IG, TMĐT & cửa hàng)\r\n2. Điều kiện đổi hàng\r\n- Trong 07 ngày kể từ lúc lúc nhận bưu phẩm thành công\r\n- Sản phẩm còn đầy đủ hóa đơn, tag treo, túi đựng áo nguyên vẹn\r\n- Sản phẩm không có dấu hiệu đã sử dụng, mùi lạ hoặc tác động từ phía khách hàng\r\n- Bạn vui lòng gửi cho chúng mình clip đóng gói hàng đổi trả của bạn, nhân viên tư vấn sẽ xác nhận và tiến hành lên đơn đổi trả cho bạn.\r\n3. Cách thức quay video unbox\r\n- Clip rõ nét từ cảnh kiểm tra bề mặt gói hàng, lúc mở đến kiểm tra hàng.\r\n- Clip không cắt ghép, không chỉnh sửa.\r\n- Clip quay rõ thông tin trên bưu phẩm: Tên người nhận, mã đơn, địa chỉ, số điện thoại.', 410000, '/faion/img/products/10004.jpg', NULL, 52, 13, 1, 0, '2023-04-07'),
(5, 6, 'Hoddie Neon Yellow', 'FLYING HEART TEE Size và form áo được đo theo chuẩn của người Việt Nam Nên chọn size lớn hơn nếu bạn thích mặc thoải mái Size M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg Size L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg Size XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg Bảng size nhằm mục đích hướng dẫn và khích thước có tỉ lệ dung size ± 0.5cm Nếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn CÁCH BẢO QUẢN Không đổ bột giặt trực tiếp lên áo Không giặt chung với sản phẩm khác màu Không sử dụng bột giặt có chất tẩy quá mạnh Giặt bằng nước có nhiệt độ không quá 30 độ C 1. Các trường hợp hỗ trợ đổi hàng - Hàng không đúng chủng loại, mẫu mã trong đơn hàng đã đặt - Không đủ số lượng như trong đơn hàng - Trường hợp có lỗi xuất phát từ khâu sản xuất - Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ ảnh hưởng trực tiếp đến sản phẩm - Áp dụng 01 lần đổi/ 01 đơn hàng - Áp dụng với các đơn hàng trên toàn hệ thống của Hard Mode® (Website, FB & IG, TMĐT & cửa hàng). 2. Điều kiện đổi hàng - Trong 07 ngày kể từ lúc lúc nhận bưu phẩm thành công - Sản phẩm còn đầy đủ hóa đơn, tag treo, túi đựng áo nguyên vẹn - Sản phẩm không có dấu hiệu đã sử dụng, mùi lạ hoặc tác động từ phía khách hàng - Bạn vui lòng gửi cho chúng mình clip đóng gói hàng đổi trả của bạn, nhân viên tư vấn sẽ xác nhận và tiến hành lên đơn đổi trả cho bạn. 3. Cách thức quay video unbox - Clip rõ nét từ cảnh kiểm tra bề mặt gói hàng, lúc mở đến kiểm tra hàng. - Clip không cắt ghép, không chỉnh sửa. - Clip quay rõ thông tin trên bưu phẩm: Tên người nhận, mã đơn, địa chỉ, số điện thoại.', 542000, '/faion/img/products/10005.jpg', NULL, 100, 32, 1, 0, '2023-04-07'),
(6, 8, 'Jacket Black', 'CHEESE TEE\r\nMATERIAL: TICI SPANDEX\r\nSIZE: M / L / XL\r\n_________________________\r\nSize và form áo được đo theo chuẩn của người Việt Nam\r\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg\r\nBảng size nhằm mục đích hướng dẫn và khích thước có tỉ lệ dung size ± 0.5cm\r\nNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn\r\n_________________________\r\n\r\nCÁCH BẢO QUẢN\r\n Không đổ bột giặt trực tiếp lên áo\r\n Không giặt chung với sản phẩm khác màu\r\n Không sử dụng bột giặt có chất tẩy quá mạnh\r\n Giặt bằng nước có nhiệt độ không quá 30 độ \r\n1. Các trường hợp hỗ trợ đổi hàng\r\n- Hàng không đúng chủng loại, mẫu mã trong đơn hàng đã đặt\r\n- Không đủ số lượng như trong đơn hàng\r\n- Trường hợp có lỗi xuất phát từ khâu sản xuất\r\n- Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ ảnh hưởng trực tiếp đến sản phẩm\r\n- Áp dụng 01 lần đổi/ 01 đơn hàng\r\n- Áp dụng với các đơn hàng trên toàn hệ thống của Hard Mode® (Website, FB & IG, TMĐT & cửa hàng)\r\n2. Điều kiện đổi hàng\r\n- Trong 07 ngày kể từ lúc lúc nhận bưu phẩm thành công\r\n- Sản phẩm còn đầy đủ hóa đơn, tag treo, túi đựng áo nguyên vẹn\r\n- Sản phẩm không có dấu hiệu đã sử dụng, mùi lạ hoặc tác động từ phía khách hàng\r\n- Bạn vui lòng gửi cho chúng mình clip đóng gói hàng đổi trả của bạn, nhân viên tư vấn sẽ xác nhận và tiến hành lên đơn đổi trả cho bạn.\r\n3. Cách thức quay video unbox\r\n- Clip rõ nét từ cảnh kiểm tra bề mặt gói hàng, lúc mở đến kiểm tra hàng.\r\n- Clip không cắt ghép, không chỉnh sửa.\r\n- Clip quay rõ thông tin trên bưu phẩm: Tên người nhận, mã đơn, địa chỉ, số điện thoại.', 460000, '/faion/img/products/10006.jpg', NULL, 124, 82, 1, 1, '2023-04-07'),
(16, 8, 'Jacket Dark Green', 'CHEESE TEE\r\nMATERIAL: TICI SPANDEX\r\nSIZE: M / L / XL\r\n_________________________\r\nSize và form áo được đo theo chuẩn của người Việt Nam\r\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg\r\nBảng size nhằm mục đích hướng dẫn và khích thước có tỉ lệ dung size ± 0.5cm\r\nNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn\r\n_________________________\r\n\r\nCÁCH BẢO QUẢN\r\n Không đổ bột giặt trực tiếp lên áo\r\n Không giặt chung với sản phẩm khác màu\r\n Không sử dụng bột giặt có chất tẩy quá mạnh\r\n Giặt bằng nước có nhiệt độ không quá 30 độ \r\n1. Các trường hợp hỗ trợ đổi hàng\r\n- Hàng không đúng chủng loại, mẫu mã trong đơn hàng đã đặt\r\n- Không đủ số lượng như trong đơn hàng\r\n- Trường hợp có lỗi xuất phát từ khâu sản xuất\r\n- Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ ảnh hưởng trực tiếp đến sản phẩm\r\n- Áp dụng 01 lần đổi/ 01 đơn hàng\r\n- Áp dụng với các đơn hàng trên toàn hệ thống của Hard Mode® (Website, FB & IG, TMĐT & cửa hàng)\r\n2. Điều kiện đổi hàng\r\n- Trong 07 ngày kể từ lúc lúc nhận bưu phẩm thành công\r\n- Sản phẩm còn đầy đủ hóa đơn, tag treo, túi đựng áo nguyên vẹn\r\n- Sản phẩm không có dấu hiệu đã sử dụng, mùi lạ hoặc tác động từ phía khách hàng\r\n- Bạn vui lòng gửi cho chúng mình clip đóng gói hàng đổi trả của bạn, nhân viên tư vấn sẽ xác nhận và tiến hành lên đơn đổi trả cho bạn.\r\n3. Cách thức quay video unbox\r\n- Clip rõ nét từ cảnh kiểm tra bề mặt gói hàng, lúc mở đến kiểm tra hàng.\r\n- Clip không cắt ghép, không chỉnh sửa.\r\n- Clip quay rõ thông tin trên bưu phẩm: Tên người nhận, mã đơn, địa chỉ, số điện thoại.', 430000, '../../faion/img/products/10007.jpg', NULL, 48, 40, 1, 1, '2023-04-17'),
(17, 8, 'Jacket Varsity', '', 370000, '../../faion/img/products/10008.jpg', NULL, 79, 3, 1, 1, '2023-04-17'),
(18, 7, 'Sweater Beige', '', 310000, '../../faion/img/products/10009.jpg', NULL, 25, 5, 1, 0, '2023-04-17'),
(19, 8, 'Jacket Multi Color Monogram', '', 528000, '../../faion/img/products/10010.jpg', NULL, 37, 6, 1, 0, '2023-04-17'),
(45, 5, 'Core Logo Tee Navy', '', 86000, '../../faion/img/products/10011.jpg', NULL, 112, 56, 1, 0, '2023-04-19'),
(46, 8, 'Jacket Classic Brown', '', 375000, '../../faion/img/products/10012.jpg', NULL, 17, 2, 1, 0, '2023-04-19'),
(51, 5, 'Gnarly Hollow USA Tie Dye', '', 99000, '../../faion/img/products/10013.jpg', NULL, 82, 33, 1, 0, '2023-04-19'),
(55, 8, 'Jacket Simple White Cardigan', '', 428000, '../../faion/img/products/10014.jpg', NULL, 77, 0, 1, 1, '2023-04-19'),
(56, 6, 'Hoodie Simple Light Green', '', 339000, '../../faion/img/products/10015.jpg', NULL, 26, 1, 1, 0, '2023-04-19'),
(57, 8, 'Jacket Caro Black White', '', 282000, '../../faion/img/products/10016.jpg', NULL, 99, 72, 1, 0, '2023-04-19'),
(58, 6, 'Hoodie Simple Yellow', '', 193000, '../../faion/img/products/10017.jpg', NULL, 58, 0, 1, 0, '2023-04-19'),
(59, 8, 'Jacket Classic Blue ', '', 285000, '../../faion/img/products/10018.jpg', NULL, 71, 17, 1, 0, '2023-04-19'),
(60, 8, 'Jacket Classic Tie Dye', '', 277000, '../../faion/img/products/10019.jpg', NULL, 33, 0, 1, 0, '2023-04-19'),
(61, 8, 'Jacket Simple Chocolate', '', 510000, '../../faion/img/products/10020.jpg', NULL, 84, 0, 1, 0, '2023-04-19'),
(62, 8, 'Jacket Simple Cyan', '', 330000, '../../faion/img/products/10021.jpg', NULL, 49, 27, 1, 0, '2023-04-19'),
(63, 7, 'Sweater Original Yellow', '', 481000, '../../faion/img/products/10022.jpg', NULL, 51, 0, 1, 0, '2023-04-19'),
(64, 6, 'Hoodie Simple White', '', 297000, '../../faion/img/products/10023.jpg', NULL, 73, 11, 1, 0, '2023-04-19'),
(65, 6, 'Hoodie State Purple', '', 323000, '../../faion/img/products/10024.jpg', NULL, 47, 8, 1, 0, '2023-04-19'),
(66, 7, 'Sweater Simple Sky Blue', '', 530000, '../../faion/img/products/10025.jpg', NULL, 66, 10, 1, 1, '2023-04-19'),
(67, 7, 'Sweater Simple Tomato', '', 394000, '../../faion/img/products/10026.jpg', NULL, 23, 2, 1, 0, '2023-04-19'),
(68, 7, 'Sweater Original Snow', '', 670000, '../../faion/img/products/10027.jpg', NULL, 79, 0, 1, 1, '2023-04-19'),
(69, 7, 'Sweater Model Kant', '', 561000, '../../faion/img/products/10028.jpg', NULL, 42, 0, 1, 0, '2023-04-19'),
(74, 7, 'Sweater Model Bbuff', '', 397000, '../../faion/img/products/10029.jpg', NULL, 66, 0, 1, 0, '2023-04-21'),
(75, 5, 'Simple Turtleneck Darkness', '', 110000, '../../faion/img/products/10037.jpg', NULL, 124, 72, 1, 0, '2023-04-21'),
(76, 5, 'Stunned Face Icon', '', 149000, '../../faion/img/products/10043.jpg', NULL, 160, 88, 1, 1, '2023-04-21'),
(77, 5, 'Mono Vietnam Style', '', 94000, '../../faion/img/products/10040.jpg', NULL, 182, 131, 1, 1, '2023-04-21'),
(78, 0, 'Test Default Category', '', 124214, '../../faion/img/products/10038.jpg', NULL, 14124, 0, 1, 0, '2023-04-26'),
(79, 5, 'Test', '', 333333, '../../faion/img/default/no-image.png', NULL, 1, 0, 0, 0, '2023-05-09');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `orderitem`
--
ALTER TABLE `orderitem`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`,`product_id`) USING BTREE;

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`id`) REFERENCES `customer` (`id`);

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Các ràng buộc cho bảng `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitem_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `cartitem_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Các ràng buộc cho bảng `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 19, 2023 lúc 08:44 AM
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
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `role`) VALUES
(1, 'hoainam', 'nam123', 0),
(2, 'chinh123', 'chinh123', 1),
(3, 'halinh', 'linh123', 1),
(4, 'trungtin', 'tin123', 1);

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
(1, 'Nguyễn Trương Hoài Nam', 'hoainam@gmail.com', 'Phú Nhuận', '0382358823', '2023-04-09'),
(2, 'Ho Trung Chinh', 'trungchinh@gmail.com', 'Viet Nam', '0123456789', '2023-04-12'),
(3, 'Ha Linh', 'halinh@gmail.com', 'Khanh Hoa', '039125874', '2023-04-14'),
(4, 'trung tIN', 'trungtin@gmail.com', 'Khanh Hoa', '0943218585', '2023-04-14');

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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderitem`
--

CREATE TABLE `orderitem` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(13,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `price`, `image`, `discount`, `quantity`, `sold`, `status`, `created_at`) VALUES
(1, 0, 'Blue Cyan Tornado', NULL, 300000, '/faion/img/products/10001.jpg', NULL, 200, 0, 1, '2023-04-06 19:29:55'),
(2, 5, 'Light Purple Cheese', 'CHEESE TEE<br>\r\nMATERIAL: TICI SPANDEX<br>\r\nSIZE: M / L / XL<br>\r\n_________________________<br><br>\r\n\r\nSize và form áo được đo theo chuẩn của người Việt Nam\r\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg<br>\r\n\r\nBảng size nhằm mục đích hướng dẫn và khích thước có tỉ lệ dung size ± 0.5cm\r\nNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn<br>\r\n_________________________<br><br>\r\n\r\nCÁCH BẢO QUẢN<br>\r\n Không đổ bột giặt trực tiếp lên áo<br>\r\n Không giặt chung với sản phẩm khác màu<br>\r\n Không sử dụng bột giặt có chất tẩy quá mạnh<br>\r\n Giặt bằng nước có nhiệt độ không quá 30 độ C<br><br>\r\n\r\n\r\n1. Các trường hợp hỗ trợ đổi hàng<br>\r\n- Hàng không đúng chủng loại, mẫu mã trong đơn hàng đã đặt<br>\r\n- Không đủ số lượng như trong đơn hàng<br>\r\n- Trường hợp có lỗi xuất phát từ khâu sản xuất <br>\r\n- Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ ảnh hưởng trực tiếp đến sản phẩm<br>\r\n- Áp dụng 01 lần đổi/ 01 đơn hàng <br>\r\n- Áp dụng với các đơn hàng trên toàn hệ thống của Hard Mode® (Website, FB & IG, TMĐT & cửa hàng).<br><br>\r\n\r\n2. Điều kiện đổi hàng<br>\r\n\r\n- Trong 07 ngày kể từ lúc lúc nhận bưu phẩm thành công<br>\r\n- Sản phẩm còn đầy đủ hóa đơn, tag treo, túi đựng áo nguyên vẹn<br>\r\n- Sản phẩm không có dấu hiệu đã sử dụng, mùi lạ hoặc tác động từ phía khách hàng<br>\r\n- Bạn vui lòng gửi cho chúng mình clip đóng gói hàng đổi trả của bạn, nhân viên tư vấn sẽ xác nhận và tiến hành lên đơn đổi trả cho bạn.<br><br>\r\n\r\n3. Cách thức quay video unbox<br>\r\n- Clip rõ nét từ cảnh kiểm tra bề mặt gói hàng, lúc mở đến kiểm tra hàng.<br>\r\n- Clip không cắt ghép, không chỉnh sửa.<br>\r\n- Clip quay rõ thông tin trên bưu phẩm: Tên người nhận, mã đơn, địa chỉ, số điện thoại.', 254000, '/faion/img/products/10002.jpg', NULL, 158, 2, 1, '2023-04-07 19:48:25'),
(3, 5, 'Rabbit Bag Brown', 'RABBIT BAG TEE\r\nMATERIAL: TICI SPANDEX\r\nSIZE: M / L / XL\r\n_________________________\r\n\r\nSize và form áo được đo theo chuẩn của người Việt Nam\r\nNên chọn size lớn hơn nếu bạn thích mặc thoải mái\r\nSize M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg\r\nSize L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg\r\nSize XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg\r\n\r\nBảng size nhằm mục đích hướng dẫn và khích thước có tỉ lệ dung size ± 0.5cm\r\nNếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn\r\n_________________________\r\n\r\nCÁCH BẢO QUẢN\r\n Không đổ bột giặt trực tiếp lên áo\r\n Không giặt chung với sản phẩm khác màu\r\n Không sử dụng bột giặt có chất tẩy quá mạnh\r\n Giặt bằng nước có nhiệt độ không quá 30 độ C\r\n\r\n\r\n1. Các trường hợp hỗ trợ đổi hàng\r\n- Hàng không đúng chủng loại, mẫu mã trong đơn hàng đã đặt\r\n- Không đủ số lượng như trong đơn hàng\r\n- Trường hợp có lỗi xuất phát từ khâu sản xuất \r\n- Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ ảnh hưởng trực tiếp đến sản phẩm\r\n- Áp dụng 01 lần đổi/ 01 đơn hàng \r\n- Áp dụng với các đơn hàng trên toàn hệ thống của Hard Mode® (Website, FB & IG, TMĐT & cửa hàng).\r\n\r\n2. Điều kiện đổi hàng\r\n\r\n- Trong 07 ngày kể từ lúc lúc nhận bưu phẩm thành công\r\n- Sản phẩm còn đầy đủ hóa đơn, tag treo, túi đựng áo nguyên vẹn\r\n- Sản phẩm không có dấu hiệu đã sử dụng, mùi lạ hoặc tác động từ phía khách hàng\r\n- Bạn vui lòng gửi cho chúng mình clip đóng gói hàng đổi trả của bạn, nhân viên tư vấn sẽ xác nhận và tiến hành lên đơn đổi trả cho bạn.\r\n\r\n3. Cách thức quay video unbox\r\n- Clip rõ nét từ cảnh kiểm tra bề mặt gói hàng, lúc mở đến kiểm tra hàng.\r\n- Clip không cắt ghép, không chỉnh sửa.\r\n- Clip quay rõ thông tin trên bưu phẩm: Tên người nhận, mã đơn, địa chỉ, số điện thoại.', 275000, '/faion/img/products/10003.jpg', NULL, 95, 5, 1, '2023-04-07 19:48:25'),
(4, 6, 'Hoodie Blue', NULL, 410000, '/faion/img/products/10004.jpg', NULL, 52, 13, 1, '2023-04-07 19:51:26'),
(5, 6, 'Hoddie Neon Yellow', 'FLYING HEART TEE Size và form áo được đo theo chuẩn của người Việt Nam Nên chọn size lớn hơn nếu bạn thích mặc thoải mái Size M: Chiều cao từ 1m50 – 1m65, cân nặng dưới 60kg Size L: Chiều cao từ 1m65 – 1m72, cân nặng dưới 65kg Size XL: Chiều cao từ 1m70 – 1m77, cân nặng dưới 80kg Bảng size nhằm mục đích hướng dẫn và khích thước có tỉ lệ dung size ± 0.5cm Nếu bạn không chắc chắn về số đo của mình, hãy liên hệ chúng mình để được tư vấn kĩ hơn CÁCH BẢO QUẢN Không đổ bột giặt trực tiếp lên áo Không giặt chung với sản phẩm khác màu Không sử dụng bột giặt có chất tẩy quá mạnh Giặt bằng nước có nhiệt độ không quá 30 độ C 1. Các trường hợp hỗ trợ đổi hàng - Hàng không đúng chủng loại, mẫu mã trong đơn hàng đã đặt - Không đủ số lượng như trong đơn hàng - Trường hợp có lỗi xuất phát từ khâu sản xuất - Tình trạng bên ngoài bị ảnh hưởng như rách bao bì, bong tróc, bể vỡ ảnh hưởng trực tiếp đến sản phẩm - Áp dụng 01 lần đổi/ 01 đơn hàng - Áp dụng với các đơn hàng trên toàn hệ thống của Hard Mode® (Website, FB & IG, TMĐT & cửa hàng). 2. Điều kiện đổi hàng - Trong 07 ngày kể từ lúc lúc nhận bưu phẩm thành công - Sản phẩm còn đầy đủ hóa đơn, tag treo, túi đựng áo nguyên vẹn - Sản phẩm không có dấu hiệu đã sử dụng, mùi lạ hoặc tác động từ phía khách hàng - Bạn vui lòng gửi cho chúng mình clip đóng gói hàng đổi trả của bạn, nhân viên tư vấn sẽ xác nhận và tiến hành lên đơn đổi trả cho bạn. 3. Cách thức quay video unbox - Clip rõ nét từ cảnh kiểm tra bề mặt gói hàng, lúc mở đến kiểm tra hàng. - Clip không cắt ghép, không chỉnh sửa. - Clip quay rõ thông tin trên bưu phẩm: Tên người nhận, mã đơn, địa chỉ, số điện thoại.', 542000, '/faion/img/products/10005.jpg', NULL, 100, 0, 1, '2023-04-07 19:51:26'),
(6, 8, 'Jacket Black', NULL, 460000, '/faion/img/products/10006.jpg', NULL, 124, 41, 1, '2023-04-07 19:54:01'),
(16, 8, 'Jacket Dark Green', NULL, 430000, '../../faion/img/products/10007.jpg', NULL, 48, 0, 1, '2023-04-17 00:00:00'),
(17, 8, 'Jacket Varsity', '', 370000, '../../faion/img/products/10008.jpg', NULL, 82, 0, 1, '2023-04-17 00:00:00'),
(18, 7, 'Sweater Beige', '', 310000, '../../faion/img/products/10009.jpg', NULL, 25, 0, 1, '2023-04-17 00:00:00'),
(19, 8, 'Jacket Multi Color Monogram', '', 528000, '../../faion/img/products/10010.jpg', NULL, 43, 0, 1, '2023-04-17 00:00:00'),
(45, 5, 'Core Logo Tee Navy', '', 86000, '../../faion/img/products/10011.jpg', NULL, 113, 0, 1, '2023-04-19 00:00:00'),
(46, 8, 'Jacket Classic Brown', '', 375000, '../../faion/img/products/10012.jpg', NULL, 19, 0, 1, '2023-04-19 00:00:00'),
(51, 5, 'Gnarly Hollow USA Tie Dye', '', 99000, '../../faion/img/products/10013.jpg', NULL, 82, 0, 1, '2023-04-19 00:00:00'),
(55, 8, 'Jacket Simple White Cardigan', '', 428000, '../../faion/img/products/10014.jpg', NULL, 77, 0, 1, '2023-04-19 00:00:00'),
(56, 6, 'Hoodie Simple Light Green', '', 339000, '../../faion/img/products/10015.jpg', NULL, 27, 0, 1, '2023-04-19 00:00:00'),
(57, 8, 'Jacket Caro Black White', '', 282000, '../../faion/img/products/10016.jpg', NULL, 100, 0, 1, '2023-04-19 00:00:00'),
(58, 6, 'Hoodie Simple Yellow', '', 193000, '../../faion/img/products/10017.jpg', NULL, 58, 0, 1, '2023-04-19 00:00:00'),
(59, 8, 'Jacket Classic Blue ', '', 285000, '../../faion/img/products/10018.jpg', NULL, 71, 0, 1, '2023-04-19 00:00:00'),
(60, 8, 'Jacket Classic Tie Dye', '', 277000, '../../faion/img/products/10019.jpg', NULL, 33, 0, 1, '2023-04-19 00:00:00'),
(61, 8, 'Jacket Simple Chocolate', '', 510000, '../../faion/img/products/10020.jpg', NULL, 84, 0, 1, '2023-04-19 00:00:00'),
(62, 8, 'Jacket Simple Cyan', '', 330000, '../../faion/img/products/10021.jpg', NULL, 49, 0, 1, '2023-04-19 00:00:00'),
(63, 7, 'Sweater Original Yellow', '', 481000, '../../faion/img/products/10022.jpg', NULL, 51, 0, 1, '2023-04-19 00:00:00'),
(64, 6, 'Hoodie Simple White', '', 297000, '../../faion/img/products/10023.jpg', NULL, 73, 0, 1, '2023-04-19 00:00:00'),
(65, 6, 'Hoodie State Purple', '', 323000, '../../faion/img/products/10024.jpg', NULL, 47, 0, 1, '2023-04-19 00:00:00'),
(66, 7, 'Sweater Simple Sky Blue', '', 530000, '../../faion/img/products/10025.jpg', NULL, 66, 0, 1, '2023-04-19 00:00:00'),
(67, 7, 'Sweater Simple Tomato', '', 394000, '../../faion/img/products/10026.jpg', NULL, 25, 0, 1, '2023-04-19 00:00:00'),
(68, 7, 'Sweater Original Snow', '', 670000, '../../faion/img/products/10027.jpg', NULL, 79, 0, 1, '2023-04-19 00:00:00'),
(69, 7, 'Sweater Model Kant', '', 561000, '../../faion/img/products/10028.jpg', NULL, 42, 0, 1, '2023-04-19 00:00:00'),
(72, 7, 'Test1', '', 12312, '../../faion/img/products/10046.jpg', NULL, 124214, 0, 1, '2023-04-19 00:00:00');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

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

<?php
	$tenmaychume = 'localhost';    // Địa chỉ máy chủ MySQL
	$tentaikhoan = 'root';         // Tên tài khoản MySQL
	$matkhau = '';                 // Mật khẩu MySQL (nếu dùng XAMPP, thường mặc định là trống)
	$dbname = 'iottest';               // Tên cơ sở dữ liệu
	
	// Tạo kết nối đến MySQL
	$connection = mysqli_connect($tenmaychume, $tentaikhoan, $matkhau);
	
	// Kiểm tra kết nối
	if (!$connection) {
		die("Kết nối thất bại: " . mysqli_connect_error());
	}
	
	// Chọn cơ sở dữ liệu
	if (!mysqli_select_db($connection, $dbname)) {
		die("Không thể chọn cơ sở dữ liệu: " . mysqli_error($connection));
	}
?>	